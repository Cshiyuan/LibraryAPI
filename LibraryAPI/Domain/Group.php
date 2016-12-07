<?php
/**
 * Created by PhpStorm.
 * User: Shyuan
 * Date: 2016/10/13
 * Time: 14:41
 */
class Domain_Group
{
    public function createGroup($UID, $GROUPNAME, $GROUPDESCRIPTION)
    {
        $model = new Model_Group();
        $rs = $model->createGroup($UID, $GROUPNAME, $GROUPDESCRIPTION);
        return $rs;
    }

    public function getGroupByGID($GID)
    {
        $model = new Model_Group();
        $rs = $model->getGroupByGID($GID);
        return $rs;
    }

    public function getGroupByUID($UID)
    {
        $model = new Model_Group();
        $rs = $model->getGroupByUID($UID);
        return $rs;
    }

    public function addUserToGroup($UID, $GID)
    {
        $model = new Model_Group();
        $rs = $model->addUserToGroup($UID, $GID);
        return $rs;
    }

    public function deleteUserFormGroup($UID, $GID)
    {
        $model = new Model_Group();
        $rs = $model->deleteUserFormGroup($UID, $GID);
        return $rs;
    }

    public function addAssignMissionToUser($UID, $GID, $mission_name, $mission_time,
                                           $mission_deadline, $mission_description)
    {
        $model = new Model_Group();
        $rs = $model->addAssignMissionToUser($UID, $GID, $mission_name, $mission_time,
            $mission_deadline, $mission_description);
        return $rs;
    }

    public function addVote($GID, $Themename, $Options)
    {
        $model = new Model_Group();
        $rs = $model->addVote($GID, $Themename, $Options);
        return $rs;
    }

    public function getVoteThemeByGID($GID)
    {
        $model = new Model_Group();
        $rs = $model->getVoteThemeByGID($GID);
        return $rs;
    }

    public function getVoteOptionsByTID($TID)
    {
        $model = new Model_Group();
        $rs = $model->getVoteOptionsByTID($TID);
        return $rs;
    }

    public function userVoteToOption($UID, $OID)
    {
        $model = new Model_Group();
        $rs = $model->userVoteToOption($UID, $OID);
        return $rs;
    }

    public function getUsersByGID($GID)
    {
        $model = new Model_Group();
        $rs = $model->getUsersByGID($GID);
        return $rs;
    }

    public function addUserToGroupByEmail($GID, $email)
    {
        $model = new Model_Group();
        $rs = $model->addUserToGroupByEmail($GID, $email);
        return $rs;
    }

}