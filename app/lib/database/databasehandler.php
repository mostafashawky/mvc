<?php
namespace MVC\LIB\DATABASE;

include_once APP_PATH . 'config' . DS .'configdatabase.php';

// Database Class Hanlder Use The Singelton Pattern To Deal With Database 
class DatabaseHandler
{
    private static $_instance;
    
    // Prevent Instantiate And Clone Object
    private function __construct(){}
    private function __clone(){}

    public static function getInstance()
    {
        global $options;
        if( self::$_instance == null ){
            try {
                self::$_instance = new \PDO( PDODRIVER . 'host=' . HOST . ';dbname='. DBNAME , USER,  PASSWORD, $options  );
            } catch( \PDOException $e){
                echo $e->getMessage();
            }
        }
        return self::$_instance;
    } 
}