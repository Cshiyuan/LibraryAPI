<?php
/**
 * Created by PhpStorm.
 * User: Shyuan
 * Date: 2016/10/13
 * Time: 14:41
 */
class Model_Group
{
    public function createGroup($UID,$GROUPNAME,$GROUPDESCRIPTION)
    {
        $group = DI()->notorm->group;
        $data = array('group_leader' => $UID,'group_name'=>$GROUPNAME,'group_description'=>$GROUPDESCRIPTION);
        $group->insert($data);
        $id = $group->insert_id(); //必须是同一个实例，方能获取到新插入的行ID，且表必须设置了自增

        //同时插入到联系表
        $userAndGroup = DI()->notorm->userandgroup;
        $relation = array('UID' => $UID, 'GID' => $id);
        $userAndGroup->insert($relation);

        return $id;   //返回的是创建的GID的主键
    }

    public function getGroupByGID($GID)
    {
        return DI()->notorm->group->select('GID,group_name,group_leader,group_description')->where('GID = ?', $GID)->fetch();
    }

    public function getGroupByUID($UID)
    {
        $sql = 'select * from mf_userandgroup left join mf_group on mf_group.GID=mf_userandgroup.GID where mf_userandgroup.UID = :id';
        $params = array(':id' => $UID);
        $data = DI()->notorm->group->queryAll($sql,$params);  //根据UID查询到相应的Misson
        return $data;
    }

    public function addUserToGroup($UID, $GID)
    {
        $userandgroup = DI()->notorm->userandgroup;
        $data = array('UID' => $UID,'GID' => $GID);
        $userandgroup->insert($data);
        $id = $userandgroup->insert_id(); //必须是同一个实例，方能获取到新插入的行ID，且表必须设置了自增
        return $id;
    }


    public function addUserToGroupByEmail($GID, $email)
    {
//        $rs = null;
        $userandgroup = DI()->notorm->user;
        $UID = $userandgroup->select('UID')->where('email = ?',$email)->fetch();

        if($UID == null)
            return null;
//        var_dump($UID['UID']);

        return $this->addUserToGroup($UID['UID'],$GID);
    }


    public function deleteUserFormGroup($UID, $GID)
    {
        $where = array('UID' => $UID,'GID' => $GID);

        if(DI()->notorm->userandgroup->where($where)->delete() == 1)
            return '删除成功';
        else
            return null;
    }

    public function addAssignMissionToUser($UID, $GID, $mission_name, $mission_time,
                                           $mission_deadline, $mission_description)
    {
        $mission = DI()->notorm->mission;
        $data = array('UID' => $UID,'GID' => $GID, 'mission_name' => $mission_name,
                      'mission_time' => $mission_time, 'mission_deadline'=>$mission_deadline,
                      'mission_description' => $mission_description);
        $mission->insert($data);
        $id = $mission->insert_id(); //必须是同一个实例，方能获取到新插入的行ID，且表必须设置了自增
        return $id;
    }

    public function addVote($GID, $Themename, $Options)
    {

        $Theme = DI()->notorm->theme;
        $data = array('GID' => $GID,'ThemeName'=>$Themename);
        $Theme->insert($data);
        $TID = $Theme->insert_id(); //必须是同一个实例，方能获取到新插入的行ID，且表必须设置了自增

        //获取了TID
        for ($i = 0; $i < count($Options); $i++){
            $option= $Options[$i];
            $optionData = array('TID' => $TID, 'OptionName' => $option);
            DI()->notorm->option->insert($optionData);
        }

        return $TID;
    }

    public function getVoteThemeByGID($GID)
    {
        return DI()->notorm->theme->select('*')->where('GID = ?', $GID)->fetch();
    }

    public function getVoteOptionsByTID($TID)
    {
        return DI()->notorm->option->select('*')->where('TID = ?', $TID)->fetchAll();
    }

    public function userVoteToOption($UID, $OID)
    {
        $where = array('UID' => $UID,'OID' => $OID);

//        if(DI()->notorm->userandgroup->where($where)->delete() == 1)
        $isVoted = DI()->notorm->userandoption->select('ChoiceBool')->where($where)->count('ChoiceBool');
//        var_dump($isVoted);
        if($isVoted)
        {
            return '已经投过票啦。';
        }
        else  //没有投票
        {
            DI()->notorm->userandoption->insert($where); //插入

            $VoteNumberArray = DI()->notorm->option->select('VoteNumber')->where('OID = ?', $OID)->fetch();

            $VoteNumber = $VoteNumberArray['VoteNumber'];

            $VoteNumber++;
            $data = array('VoteNumber' => $VoteNumber);
            $rs = DI()->notorm->option->where('OID', $OID)->update($data);
            if ($rs == null)
                return '投票失败';
            else
                return $rs;
        }
    }

    public function getUsersByGID($GID)
    {
        $rs = array();
        $userandgroup = DI()->notorm->userandgroup;
        $UIDS = $userandgroup->select('UID')->where('GID = ?',$GID)->fetchAll();
        for($i = 0; $i <count($UIDS) ;$i++)
        {
//            var_dump($UIDS[$i]['UID']);
           $userInformation =  DI()->notorm->user->select('UID,username,email,introduction')->where('UID = ?', $UIDS[$i]['UID'])->fetch();
//            var_dump($userInformation);
            $rs[$i] = $userInformation;
        }
        return $rs;
    }


}