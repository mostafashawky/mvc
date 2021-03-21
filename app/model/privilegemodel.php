<?php
/* 
** Privilege Moduel
** Provides The Controller With Logic Data
** Deal With Table Privilege In Databae
*/

namespace MVC\MODEL;

use MVC\MODEL\AbstractModel;

class PrivilegeModel extends AbstractModel
{
    public $privilege_id;
    public $privilege_name;
    public $privilege_url;
    public static $primaryKey = 'privilege_id';
    public static $tableName = 'app_users_privileges';
    public static $tableSchema = [
        'privilege_name' => parent::DATATYPE_STR,
        'privilege_url'  => parent::DATATYPE_STR,
    ];
    
}