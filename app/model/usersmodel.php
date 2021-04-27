<?php

namespace MVC\MODEL;

use MVC\MODEL\AbstractModel;
use MVC\MODEL\ProfileModel;
class UsersModel extends AbstractModel
{
    // Object Property
    public $UserId;
    public $username;
    public $password;
    public $email;
    public $phone;
    public $register_data;
    public $status;
    public $last_login;
    public $group_id;

    // Identifier Database Table
    public static $tableName  = "app_users";
    public static $primaryKey = "UserId";

    // Table Schema Form Inserting New Data
    public static $tableSchema = [
        "username"      => PARENT::DATATYPE_STR,
        "password"      => PARENT::DATATYPE_STR,
        "email"         => PARENT::DATATYPE_STR,
        "phone"         => PARENT::DATATYPE_INT,
        "register_data" => PARENT::DATATYPE_STR, 
        "status"        => PARENT::DATATYPE_INT,
        "last_login"    => PARENT::DATATYPE_STR,
        "group_id"      => PARENT::DATATYPE_INT,
          
    ];
    // Check User Exist Method
    public static function CheckuserExist( $user )
    {
        if( is_object($user) ){
            $data = self::getbycolumn(["username"=>$user->username]);
            return !empty( $data ) ? $data : false; 
        }
    }

    // Get All Data With New sql
    public static function getUsers( UsersModel $user )
    {
        // Get All User With There Group Name And Exclude The Login User 
        $sql = "select app_users.*, app_users_groups.group_name from app_users ";
        $sql.= "inner join app_users_groups on app_users.group_id = app_users_groups.group_id where ".self::$primaryKey." != {$user->UserId}";

        // Users Data
        $users = self::get($sql);
        return $users;
    }

    // Check User Authentication Loginin
    public static function authentication( $username, $password, $session )
    {                            
        $sql = "select app_users.*, app_users_groups.group_name from ".self::$tableName." inner join app_users_groups on app_users.group_id = app_users_groups.group_id where ";                                                                                                              
        $user = UsersModel::get( $sql, [ "username" => $username , "password" => $password ] );
         
        // Extract The User Object   
         $user = !empty($user) ? array_shift( $user ) : false;

         
         // Check If User Exist In Database    
        if( $user != false ) { // User Exist In Database

            // Check If User Not Disabled By Administration
            if( $user->status == 2) { // Two Mean The This User Is Disabled
                // Return 2 To Controller To Take Action
                return 2;
            }
            
            // Reset The Login In User Object
            $user->last_login = date("Y-m-d g:m:s");

            // Get User Profile
            $userProfile = ProfileModel::getUserprofile( $user );
            $user->profile = $userProfile;

            
            // Make New User Session
            $session->user = $user;
        
            // Update User Data In Database
            return $user->save();

            // Return True => Success Login
        } else {
            // Return Value One To Controller => Wrong Username , Password
            return 1;
        }

    }
    

}