<?php

namespace MVC\MODEL;

class AbstractModel
{
    const DATATYPE_STR   = \PDO::PARAM_STR;
    const DATATYPE_INT   = \PDO::PARAM_INT;
    const DATATYPE_DEC   = 3;


    // method to get the employees from database
    public static function getAll(  $database )
    {
       $sql = "SELECT * FROM ".static::$tableName."";
       $stat = $database->databaseConnection()->prepare( $sql );
       $data = $stat->execute() ? $stat->fetchAll( \PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE,get_called_class() ) : false;
       return $data;
    }
    //method to get the employee information from database
    public static function getbypk(  $database, $pk )
    {

        $sql = "SELECT * FROM ".static::$tableName." WHERE ".static::$primaryKey." = :".static::$primaryKey."";
        $stat = $database->databaseConnection()->prepare( $sql );
        $stat->bindParam( ":".static::$primaryKey."", $pk );
        $data = $stat->execute() ? $stat->fetchAll( \PDO::FETCH_CLASS, get_called_class() ) : false;
        
        // Check If The Fetched Object Not Empty 
        if( !empty( $data ) ){
            return array_shift( $data );
        }
        return false;
    }
    private function createParams()
    {
        // make loop through table schema
        $params = '';
        foreach( static::$tableSchema as $column => $data_type ){
            $params .= "$column=:$column,";
        }
        return trim( $params, ',' );

    }
    private function bindParams( \PDOStatement &$stat )
    {
        // Loop Through Table Schema To Bind Params
        foreach( static::$tableSchema as $column  => $data_type ){
            // Check If The Datatype Equal Decimal
            if( $data_type === 3 ) {
                $filterSalary = filter_var(
                                       $this->$column,
                                       FILTER_SANITIZE_NUMBER_FLOAT,
                                       FILTER_FLAG_ALLOW_FRACTION  );
                $stat->bindParam( ":$column", $filterSalary );
            } else {
                $stat->bindParam( ":$column", $this->$column );
            }

        }
    }
    public function insertData( $database , $pk = false )
    {
        // If Pk Paramater Is True Then We Need To Get Last Insert Id
        $sql = "INSERT INTO ". static::$tableName ." SET ".self::createParams()."";
        $stat = $database->databaseConnection()->prepare( $sql );
        self::bindParams( $stat );
        if( $stat->execute() ){
            if( $pk == true ) {
                // After Execute The Insert Data Into Database Then Get The Last Insert Id
                $this->{static::$primaryKey} =  $database->databaseConnection()->lastInsertId();
                return true;
            } 
            return true;
           
        } 
        return false;
    }
    public function updateData( $database )
    {
        $sql  = "UPDATE ".static::$tableName." SET ".self::createParams()." WHERE ".static::$primaryKey." = ".$this->{static::$primaryKey}."";
        $stat = $database->databaseConnection()->prepare( $sql );
        self::bindParams($stat );
        return $stat->execute();
    }
    public  function deleteData(  $database )
    {
        
        $sql = "DELETE FROM ".static::$tableName." WHERE ".static::$primaryKey." =:".static::$primaryKey."";
        $stat = $database->databaseconnection()->prepare( $sql );
        $stat->bindParam( ":".static::$primaryKey, $this->{static::$primaryKey} );
        return $stat->execute();
    }
    public function save(  $database, $pk = false )
    {
        return $this->{static::$primaryKey} == "" ? $this->insertData( $database, $pk ) : $this->updateData( $database );
    }

}