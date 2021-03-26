<?php
/*
 * Author: Mostafa Shawky
 * Email: mostafa.shawky47@mail.ru
 * FileName: configuration File
 * Description: Application Setting
 */

// Define Constants
defined('DS')              ? null : define('DS', DIRECTORY_SEPARATOR);

// Define Application Paths
defined( 'APP_PATH' )      ? null : define( 'APP_PATH', realpath( dirname( __FILE__ ) . DS . '..') );
defined( 'APP_VIEW' )      ? null : define( 'APP_VIEW', APP_PATH . DS . 'view' . DS );
defined( 'LANGUAGE_PATH' ) ? null : define( 'LANGUAGE_PATH', APP_PATH . DS . 'languages' . DS );
defined( 'TEMPLATE_PATH' ) ? null : define( 'TEMPLATE_PATH', APP_PATH . DS . 'template' . DS );
defined( 'CSS' )           ? null : define( 'CSS', DS . 'css' . DS );
defined( 'JS' )            ? null : define( 'JS', DS  . 'js' . DS );
// Default Language
defined( 'DEFAULT_LANGUAGE' ) ? null : define( 'DEFAULT_LANGUAGE', 'ar' );

// Define Session Constants
define( 'SESSION_PATH' , realpath( APP_PATH . DS . '..' . DS  . 'sessionfile' .DS )) ;  

//define database resources
define('HOST_NAME','mvcapp.nt');
define('DB_NAME','storage');
define('USER_NAME','root');
define('PASSWORD','');
define('DRIVER_CONNECT', 'mysql:' );
$dbs = DRIVER_CONNECT.'host='.HOST_NAME.';dbname='.DB_NAME; 
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
);
try {
    $connection = new PDO( $dbs, USER_NAME, PASSWORD, $options );

}
catch( PDOException $e){
    echo $e->getMessage();
}