<?php

include '../app/config/config.php';
include APP_PATH . DS . 'lib' . DS . 'autoload.php';

// Import Session Module
use MVC\LIB\mysession;
//import frontcontroller
use MVC\LIB\FrontController;
//import class template
use MVC\LIB\template\Template;
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

// Get New Instance From Database Moduel To Inject It Into Controller
$database = new DATABASE( $dbs, USER_NAME, PASSWORD, $options );

// Get New Instance From Template Moduel To Inject It Into Controller
$template = new Template( $configTemplate );

// Get New Instance From Language Moduel To Inject It Into Controller
$language = new Language();

// New Instance From FrontController To Handle The Frontel Data And Inject The interdependence Objects To Controller
$FrontController = new FrontController( $template, $language, $database );

$FrontController->dispatch();










