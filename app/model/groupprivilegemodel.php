<?php
/* 
** Privilege Moduel
** Provides The Controller With Logic Data
** Deal With Table Privilege In Databae
*/

namespace MVC\MODEL;

use MVC\MODEL\AbstractModel;

class GroupPrivilegeModel extends AbstractModel
{
    public $id;
    public $group_id;
    public $privilege_id;
    public static $primaryKey = 'id';
    public static $tableName   = 'app_group_privileges';
    public static $tableSchema = [
        'group_id' => parent::DATATYPE_STR,
        'privilege_id'  => parent::DATATYPE_STR,
    ];
    
}