<?php

/**
 * Created by PhpStorm.
 * User: bb
 * Date: 2016/12/7
 * Time: 21:50
 */
//class Api_Group extends PhalApi_Api
class Api_Book extends PhalApi_Api
{

    


    public function getRules()
    {

        return array(
            'getBookInfoByBookName' => array(
                'BookName' => array('name' => 'BookName', 'require' => true),
            ),
        );
    }
}