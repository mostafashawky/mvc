<?php 

namespace MVC\MODEL;

use MVC\MODEL\AbstractModel;

class GroupPrivilegeModel extends AbstractModel
{
    public $group_id;
    public $privilege_id;
    public static $tableName   = 'app_group_privileges';
    public static $tableSchema = [
        'group_id'     => parent::DATATYPE_INT,
        'privilege_id' => parent::DATATYPE_INT,
    ];


}
