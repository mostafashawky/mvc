<?php

namespace MVC\LIB;

use PDOException;

class DATABASE
{
    private $_connect;
    public function __construct( $dbs, $username, $password, $option )
    {
        try {
            $connect = new \PDO( $dbs, $username, $password, $option );
            $this->_connect = $connect;
        }
        catch( PDOException $e){
            echo $e->getMessage();
            exit;
        }
    } 
    public function databaseConnection()
    {
        return $this->_connect;
    }   
}