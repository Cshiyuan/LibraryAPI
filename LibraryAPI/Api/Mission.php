<?php

/**
 * Created by PhpStorm.
 * User: Shyuan
 * Date: 2016/10/12
 * Time: 23:34
 */
class Api_Mission extends PhalApi_Api
{
    /**
     * 通过UID查询相应的Mission
     * @desc 通过UID查询用户的Mission
     */
    public function getMissionByUID()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());  //初始化$rs
        $domain = new Domain_Mission();
        $result = $domain->getMissionByUID($this->UID); //交由domain注册并返回注册信息

//        $rs['code'] = $result['code'];
//        $rs['msg']  = $result['msg'];
//        $rs['info'] = $result['info'];
        $rs['info'] = $result;
        return $rs;

    }

    /**
     * 通过MID查询相应的Mission
     * @desc 通过MID查询Mission
     */
    public function getMissionByMID()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());  //初始化$rs
        $domain = new Domain_Mission();
        $result = $domain->getMissionByMID($this->MID); //交由domain注册并返回注册信息
        $rs['info'] = $result;

        //没有找到相应的Mission
        if ($result == null) {
            $rs['code'] = 400;
            $rs['msg'] = '没有找到相应的Mission';
        }
        return $rs;
    }

    /**
     * 通过MID修改相应的Mission的Time
     * @desc 通过MID查询Mission
     */
    public function changeMissionTime()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());  //初始化$rs
        $domain = new Domain_Mission();
        $result = $domain->changeMissionTime($this->MID, $this->TIME); //交由domain注册并返回注册信息

        if ($result == 1) {
            $rs['code'] = 200;
            $rs['msg'] = 'success';
        }
        if ($result == 0) {
            $rs['code'] = 200;
            $rs['msg'] = 'error';
        }
        $rs['info'] = $result;
        return $rs;
    }

    public function getRules()
    {
        return array(
            'getMissionByUID' => array(
                'UID' => array('name' => 'UID', 'type' => 'int', 'min' => 1, 'require' => true),
                // 'username' => array('name' => 'username')
            ),
            'getMissionByMID' => array(
                'MID' => array('name' => 'MID', 'type' => 'int', 'min' => 1, 'require' => true),
            ),
            'changeMissionTime' => array(
                'MID' => array('name' => 'MID', 'type' => 'int', 'min' => 1, 'require' => true),
                'TIME' => array('name' => 'TIME', 'type' => 'int', 'min' => 0, 'require' => true),
            )
        );
    }


}