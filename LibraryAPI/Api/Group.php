<?php
/**
 * Created by PhpStorm.
 * User: Shyuan
 * Date: 2016/10/13
 * Time: 14:40
 */
class Api_Group extends PhalApi_Api
{
    /**
     * 创建Group
     * @desc 用于创建Group
     */
    public function createGroupByUID()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());  //初始化$rs
        $domain = new Domain_Group();
        $result = $domain->createGroup($this->UID, $this->groupName, $this->groupDescription); //交由domain注册并返回注册信息
        $rs['code'] = 200;
        $rs['msg'] = '创建成功';
        $rs['info'] = $result;
        return $rs;

    }

    /**
     * 查询Group
     * @desc 用GID来查询Group
     */
    public function getGroupByGID()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());  //初始化$rs
        $domain = new Domain_Group();
        $result = $domain->getGroupByGID($this->GID); //交由domain注册并返回注册信息

//        $rs['code'] = $result['code'];
//        $rs['msg']  = $result['msg'];
//        $rs['info'] = $result['info']
////没有找到相应的Mission
        if ($result == null) {
            $rs['code'] = 400;
            $rs['msg'] = 'Group';
        } else {
            $rs['code'] = 200;
            $rs['msg'] = '查询成功';
            $rs['info'] = $result;
        }
        return $rs;
    }

    /**
     * 查询Group
     * @desc 用UID来查询用户下的Group
     */
    public function getGroupByUID()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());  //初始化$rs
        $domain = new Domain_Group();
        $result = $domain->getGroupByUID($this->UID); //交由domain注册并返回注册信息

        if ($result == null) {
            $rs['code'] = 400;
            $rs['msg'] = 'Group';
        } else {
            $rs['code'] = 200;
            $rs['msg'] = '查询成功';
            $rs['info'] = $result;
        }
        return $rs;
    }

    /**
     * 向小组添加成员
     * @desc 向小组添加成员，通过UID和GID
     */
    public function addUserToGroup()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());  //初始化$rs
        $domain = new Domain_Group();
        $result = $domain->addUserToGroup($this->UID, $this->GID); //交由domain注册并返回注册信息

        if ($result == null) {
            $rs['code'] = 400;
            $rs['msg'] = 'Group';
        } else {
            $rs['code'] = 200;
            $rs['msg'] = '添加成功';
            $rs['info'] = $result;
        }
        return $rs;
    }

    /**
     * 从小组删除成员
     * @desc 从小组删除成员，通过UID和GID
     */
    public function deleteUserFormGroup()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());  //初始化$rs
        $domain = new Domain_Group();
        $result = $domain->deleteUserFormGroup($this->UID, $this->GID); //交由domain注册并返回注册信息

        if ($result == null) {
            $rs['code'] = 400;
            $rs['msg'] = 'Group';
        } else {
            $rs['code'] = 200;
            $rs['msg'] = '删除成功';
            $rs['info'] = $result;
        }
        return $rs;
    }

    /**
     * 向小组成员布置任务
     * @desc 给用户名为UID的用户布置任务
     */
    public function addAssignMissionToUser()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());  //初始化$rs
        $domain = new Domain_Group();
        $result = $domain->addAssignMissionToUser($this->UID, $this->GID,
            $this->mission_name, $this->mission_time,
            $this->mission_deadline, $this->mission_description);

        if ($result == null) {
            $rs['code'] = 400;
            $rs['msg'] = 'Group';
        } else {
            $rs['code'] = 200;
            $rs['msg'] = '添加成功';
            $rs['info'] = $result;
        }
        return $rs;
    }

    /**
     * 在小组里发布投票
     * @desc 在小组里发布投票
     */
    public function addVote()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());  //初始化$rs
        $domain = new Domain_Group();
        $result = $domain->addVote($this->GID, $this->ThemeName, $this->Options);

        if ($result == null) {
            $rs['code'] = 400;
            $rs['msg'] = 'Group';
        } else {
            $rs['code'] = 200;
            $rs['msg'] = '添加成功';
            $rs['info'] = $result;
        }
        return $rs;
    }

    /**
     * 获取小组所有的投票主题
     * @desc 通过GID获取小组所有的投票主题
     */
    public function getVoteThemeByGID()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());  //初始化$rs
        $domain = new Domain_Group();
        $result = $domain->getVoteThemeByGID($this->GID);
        if ($result == null) {
            $rs['code'] = 400;
            $rs['msg'] = 'Vote';
        } else {
            $rs['code'] = 200;
            $rs['msg'] = '查询成功';
            $rs['info'] = $result;
        }
        return $rs;
    }

    /**
     * 获取投票的所有投票选项
     * @desc 通过TID获取投票的所有投票选项
     */
    public function getVoteOptionsByTID()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());  //初始化$rs
        $domain = new Domain_Group();
        $result = $domain->getVoteOptionsByTID($this->TID);
        if ($result == null) {
            $rs['code'] = 400;
            $rs['msg'] = 'Vote';
        } else {
            $rs['code'] = 200;
            $rs['msg'] = '查询成功';
            $rs['info'] = $result;
        }
        return $rs;
    }

    /**
     * 用户进行投票
     * @desc 通过UID和OID进行投票
     */
    public function userVoteToOption()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());  //初始化$rs
        $domain = new Domain_Group();
        $result = $domain->userVoteToOption($this->UID, $this->OID);
        if ($result == null) {
            $rs['code'] = 400;
            $rs['msg'] = 'Vote';
        } else {
            $rs['code'] = 200;
            $rs['msg'] = '查询成功';
            $rs['info'] = $result;
        }
        return $rs;
    }

    /**
     * 通过GID查找小组里的组员
     * @desc 通过GID查找小组里的组员
     */
    public function getUsersByGID()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());  //初始化$rs
        $domain = new Domain_Group();
        $result = $domain->getUsersByGID($this->GID);
        if ($result == null) {
            $rs['code'] = 400;
            $rs['msg'] = 'Vote';
        } else {
            $rs['code'] = 200;
            $rs['msg'] = '查询成功';
            $rs['info'] = $result;
        }
        return $rs;
    }

    /**
     * 通过Email向小组里的添加组员
     * @desc 通过Email向小组里的添加组员
     */
    public function addUserToGroupByEmail()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());  //初始化$rs
        $domain = new Domain_Group();
        $result = $domain->addUserToGroupByEmail($this->GID, $this->email);
        if ($result == null) {
            $rs['code'] = 400;
            $rs['msg'] = 'addUser';
        } else {
            $rs['code'] = 200;
            $rs['msg'] = '添加成功';
            $rs['info'] = $result;
        }
        return $rs;
    }



    public function getRules()
    {
        return array(
            'createGroupByUID' => array(
                'UID' => array('name' => 'UID', 'type' => 'int', 'min' => 1, 'require' => true),
                'groupName' => array('name' => 'groupName', 'require' => true),
                'groupDescription' => array('name' => 'groupDescription', 'require' => true),
                // 'username' => array('name' => 'username')
            ),
            'getGroupByGID' => array(
                'GID' => array('name' => 'GID', 'type' => 'int', 'min' => 1, 'require' => true),
            ),
            'getGroupByUID' => array(
                'UID' => array('name' => 'UID', 'type' => 'int', 'min' => 1, 'require' => true),
            ),
            'addUserToGroup' => array(
                'UID' => array('name' => 'UID', 'type' => 'int', 'min' => 1, 'require' => true),
                'GID' => array('name' => 'GID', 'type' => 'int', 'min' => 1, 'require' => true),
            ),
            'addUserToGroupByEmail' => array(
                'GID' => array('name' => 'GID', 'type' => 'int', 'min' => 1, 'require' => true),
                'email' => array('name' => 'email','require' => true),
            ),
            'deleteUserFormGroup' => array(
                'UID' => array('name' => 'UID', 'type' => 'int', 'min' => 1, 'require' => true),
                'GID' => array('name' => 'GID', 'type' => 'int', 'min' => 1, 'require' => true),
            ),
            'addAssignMissionToUser' => array(
                'UID' => array('name' => 'UID', 'type' => 'int', 'min' => 1, 'require' => true),
                'GID' => array('name' => 'GID', 'type' => 'int', 'min' => 1, 'require' => true),
                'mission_name' => array('name' => 'mission_name', 'require' => true),
                'mission_time' => array('name' => 'mission_time', 'type' => 'int', 'min' => 0, 'require' => true),
                'mission_deadline' => array('name' => 'mission_deadline', 'type' => 'date', 'require' => true),
                'mission_description' => array('name' => 'mission_description', 'require' => true),
            ),
            'addVote' => array(
                'GID' => array('name' => 'GID', 'type' => 'int', 'min' => 1, 'require' => true),
                'ThemeName' => array('name' => 'ThemeName','require' => true),
                'Options' => array('name' => 'Options', 'type' => 'array', 'format' => 'explode', 'separator' => ',', 'require' => true),
            ),
            'getVoteThemeByGID' => array(
                'GID' => array('name' => 'GID', 'type' => 'int', 'min' => 1, 'require' => true),
            ),
            'getVoteOptionsByTID' => array(
                'TID' => array('name' => 'TID', 'type' => 'int', 'min' => 1, 'require' => true),
            ),
            'userVoteToOption' => array(
                'UID' => array('name' => 'UID', 'type' => 'int', 'min' => 1, 'require' => true),
                'OID' => array('name' => 'OID', 'type' => 'int', 'min' => 1, 'require' => true),
            ),
            'getUsersByGID' => array(
                'GID' => array('name' => 'GID', 'type' => 'int', 'min' => 1, 'require' => true),
            ),

        );
    }


}