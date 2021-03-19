<?php


namespace MVC\MODEL;

//import abstract employee
use MVC\MODEL\AbstractModel;
class GroupName extends AbstractModel {


    public $id;
    public $group_name;
    public static $tableName = 'app_group';
    static $tableSchema = array(
        'group_name' => PARENT::DATATYPE_STR,
    );


}