<?php

namespace MVC\MODEL;

use MVC\LIB\DATABASE\DatabaseHandler;

class AbstractModel
{
    const DATATYPE_STR   = \PDO::PARAM_STR;
    const DATATYPE_INT   = \PDO::PARAM_INT;
    const DATATYPE_DEC   = 3;

    // Get Data With Provided Sql Statement
    public static function get( $sql, $options = [] )
    {
        if( !empty( $options ) ){

            $columns   = array_keys( $options );
            $values    = array_values( $options );
            
            // Loop Through Column To Generate Sql Statement
            for( $i = 0; $i < count( $columns ); $i++ ) {
                $sql .= $columns[ $i ]. "=:".$columns[ $i ] . " and ";
            }

            // Subtract Sql Statemnt
            $sql =  substr( $sql , 0 , strrpos( $sql , "and" ));
    
            $stat = DatabaseHandler::getInstance()->prepare( $sql );

            // Loop Through Column And Values To Bind Paramter 
            for( $i = 0; $i < count( $columns ); $i++ ){
                $stat->bindParam( ":".$columns[$i], $values[$i]  );
            }

    
            if( $stat->execute() ){
                // Fetch Data
                $data = $stat->fetchAll( \PDO::FETCH_CLASS, get_called_class() );
                return !empty( $data ) ? $data : false;
            }
            return false;

        } else {
            $stat = DatabaseHandler::getInstance()->prepare( $sql );
            if(  $stat->execute() ){
                $data = $stat->fetchAll( \PDO::FETCH_CLASS, get_called_class() );
                return !empty($data) ? $data : false;
            }

            return false;
        }
        
    }
    
    // Get One Element With Provided Sql
    public static function getOne( $sql )
    {
        $result = static::get($sql);
        return $result === false ? false : array_shift( $result);
    }

    // Get All Data From Database
    public static function getAll( )
    {
       $sql = "SELECT * FROM ".static::$tableName."";
       $stat = DatabaseHandler::getInstance()->prepare( $sql );
       $data = $stat->execute() ? $stat->fetchAll( \PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE,get_called_class() ) : false;
       return $data;
    }
    // Method To get Data With Column
    public static function getbycolumn( $column = [])
    {   
        // SELECT * FROM app_users WHERE username = :username

        // Extract The Column And Values
        $keys          = array_keys( $column );
        $values        = array_values( $column );
 
        // Prepare Sql Statement
        $sql = "select * from ".static::$tableName." where ";
       
        // Loop Thorugh key( Column )
        for( $i = 0;  $i < count( $keys );  $i++ ){
            $sql.= $keys[$i] . " =:" . $keys[$i]. " and ";
        }

        
        // The Final Sql Statement
        $sql = substr( $sql, 0 , strrpos( $sql, 'and' ) );
    
        // Connect To Database
        $stat = DatabaseHandler::getInstance()->prepare( $sql );
        
        // Loop Through Key And Value Array To Bind Them To SQL Statement
        for( $i = 0; $i < count($keys); $i++ ){
            $stat->bindParam( ":".$keys[$i], $values[$i] );
        }

        $data = $stat->execute() ? $stat->fetchAll( \PDO::FETCH_CLASS, get_called_class() ) : false ;
        
        if( !empty( $data ) ){
            return $data;
        }

        return false;
    }
    // Method To Delete Data With Column
    public static function deletebycolumn(  $column = [] )
    {
         // Extract The Column And Values
         $keys          = array_keys( $column );   // Column Name Array
         $values        = array_values( $column ); // Column Value Array
 
         // Prepare Sql Statement
         $sql = "delete  from ".static::$tableName." where ";
        
         // Loop Thorugh key( Column )
         for( $i = 0;  $i < count( $keys );  $i++ ){
             $sql.= $keys[$i] . "=" . $values[$i]. " and ";
         }

         // The Final Sql Statement
         $sql = substr( $sql, 0 , strrpos( $sql, 'and' ) );

         // Connect To Database
         $stat = DatabaseHandler::getInstance()->prepare( $sql );
         return $stat->execute() ? true : false ;
    }
    // Method To Get The Adata From Database With PK
    public static function getbypk(  $pk )
    {

        $sql = "SELECT * FROM ".static::$tableName." WHERE ".static::$primaryKey." = :".static::$primaryKey."";
        $stat = DatabaseHandler::getInstance()->prepare( $sql );
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
    public function insertData( $pk = false )
    {
        // If Pk Paramater Is True Then We Need To Get Last Insert Id
        $sql = "INSERT INTO ". static::$tableName ." SET ".self::createParams()."";
        $stat = DatabaseHandler::getInstance()->prepare( $sql );
        self::bindParams( $stat );
        if( $stat->execute() ){
            if( $pk === true ) {
                // After Execute The Insert Data Into Database Then Get The Last Insert Id
                $this->{static::$primaryKey} =  DatabaseHandler::getInstance()->lastInsertId();
                return true;
            } 
            return true;
           
        } 
        return false;
    }
    public function updateData( )
    {
        $sql  = "UPDATE ".static::$tableName." SET ".self::createParams()." WHERE ".static::$primaryKey." = ".$this->{static::$primaryKey}."";
        $stat = DatabaseHandler::getInstance()->prepare( $sql );
        self::bindParams($stat );
        return $stat->execute();
    }
    public  function deleteData(   )
    {
        
        $sql = "DELETE FROM ".static::$tableName." WHERE ".static::$primaryKey." =:".static::$primaryKey.";";
        echo $sql;

        $stat = DatabaseHandler::getInstance()->prepare( $sql );
        $stat->bindParam( ":".static::$primaryKey, $this->{static::$primaryKey} );
        return $stat->execute();
    }
    public function save( $pk = false )
    {
        return $this->{static::$primaryKey} == "" ? $this->insertData( $pk ) : $this->updateData( );
    }

}