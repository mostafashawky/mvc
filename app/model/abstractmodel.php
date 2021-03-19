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
    public static function getbypk( DATABASE $database, $pk )
    {

        $sql = "SELECT * FROM employee WHERE id = :".static::$primaryKey."";
        $stat = $database->connect->prepare( $sql );
        $stat->bindParam( ":".static::$primaryKey."", $pk );
        $allData = $stat->execute() ? array_shift( $stat->fetchAll( \PDO::FETCH_CLASS, get_called_class() ) ) : false;
        return $allData;

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
        //make loop through table schema to bind params
        foreach( static::$tableSchema as $column  => $data_type ){
            //check if the datatype equal decimal
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
    public function insertemployee( DATABASE $database )
    {

        $sql = "INSERT INTO employee SET ".self::createParams()."";
        $stat = $database->connect->prepare( $sql );
        self::bindParams( $stat );
        return $stat->execute();
    }
    public function update( DATABASE $database )
    {
        $sql  = "UPDATE ".static::$tableSchema." SET ".self::createParams()." WHERE id = ".$this->id."";
        $stat = $database->connect->prepare( $sql );
        self::bindParams($stat );
        return $stat->execute();
    }
    public static function delete( DATABASE $database, $id )
    {
        
        $sql = "DELETE FROM ".static::$tableName." WHERE id =:id";
        $stat = $database->connect->prepare( $sql );
        $stat->bindParam( ':id', $id );
        return $stat->execute();
    }
    public function save( DATABASE $database )
    {
        return $this->id == "" ? $this->insertemployee( $database ) : $this->update( $database );
    }

}