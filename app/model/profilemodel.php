<?php

namespace MVC\MODEL;

use MVC\MODEL\AbstractModel;
use MVC\MODEL\UserModel;

class ProfileModel extends AbstractModel
{
    public $profile_id;
    public $first_name;
    public $last_name;
    public $image;
    public $dob;
    public $UserId;
    
    public static $primaryKey = "profile_id";
    public static $tableName  = "app_users_profile";

    public static $tableSchema = [
        "first_name" => PARENT::DATATYPE_STR,
        "last_name"  => PARENT::DATATYPE_STR,
        "image"      => PARENT::DATATYPE_STR,
        "dob"        => PARENT::DATATYPE_STR,
        "UserId"     => PARENT::DATATYPE_INT,
    ];

    public static function getUserprofile( UsersModel $user )
    {
        $userProfile =  self::getbycolumn( [ "UserId" => $user->UserId ] );
        if( false !== $userProfile ){
            return array_shift( $userProfile );
        }
    }

}