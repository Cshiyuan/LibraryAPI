<?php
/**
 * Created by PhpStorm.
 * User: Shyuan
 * Date: 2016/10/12
 * Time: 23:35
 */
class Domain_Mission
{
    public function getMissionByUID($UID)
    {
        $model = new Model_Mission();
        $rs = $model->getMissionByUID($UID);
        return $rs;
    }

    public function getMissionByMID($MID)
    {
        $model = new Model_Mission();
        $rs = $model->getMissionByMID($MID);

        return $rs;
    }

    public function changeMissionTime($MID,$TIME)
    {
        $model = new Model_Mission();
        $rs = $model->changeMissionTime($MID,$TIME);

        return $rs;
    }

}