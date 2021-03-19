<?php

include '../app/config/config.php';
include APP_PATH . DS . 'lib' . DS . 'autoload.php';

// Import Session Module
use MVC\LIB\mysession;
//import frontcontroller
use MVC\LIB\FrontController;
//import class template
use MVC\LIB\Template;
//import class handle language
use MVC\LIB\Language;
// Import Database Object
use MVC\LIB\database;

$session = new mysession();
$session->startSession();
    

// Require Template Data Config
$configTemplate = require_once APP_PATH . DS . 'config'. DS . 'configtemplates.php';  

// Check If The Session Contain The Language
if( !isset($_SESSION['lang']) ) {
    $_SESSION['lang'] = DEFAULT_LANGUAGE;
}


$database = new DATABASE( $dbs, USER_NAME, PASSWORD, $options );
$template = new Template( $configTemplate );
$language = new Language();
$FrontController = new FrontController( $template, $language, $database );
$FrontController->dispatch();








