<?php

namespace MVC\MODEL;

//import abstract employee
use MVC\MODEL\AbstractModel;
class GroupModel extends AbstractModel {

    public $group_id;
    public $group_name;
    public static $tableName   = 'app_users_groups';
    public static $primaryKey  = 'group_id';
    public static $tableSchema = [
        'group_name' => PARENT::DATATYPE_STR,
    ];


}