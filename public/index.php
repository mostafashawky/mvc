<?php
namespace MVC;

include '../app/config/config.php';

include_once APP_PATH  . 'lib' . DS . 'autoload.php';

// Import Frontcontroller    
use MVC\LIB\FrontController;

// Import Register Class
use MVC\LIB\Register;

// Import Class Template
use MVC\LIB\template\Template;

// Import Class Handle Language
use MVC\LIB\Language;

// Import Session Module
use MVC\LIB\SessionManger;

// Import Messenger Module
use MVC\LIB\Messenger;

// Import Authorized Module
use MVC\LIB\Authorized;

$session = new SessionManger();
$session->startSession();


// Require Template Data Config
$configTemplate = require_once APP_PATH . DS . 'config'. DS . 'configtemplates.php';  

// Check If The Session Contain The Language
if( !isset($session->lang) ) {
    $session->lang = DEFAULT_LANGUAGE;
}

// Authorized Lib
$authorized = Authorized::getInstance( $session );

// Get New Instance From Template Moduel To Inject It Into Controller
$template = new Template( $configTemplate );

// Get New Instance From Language Moduel To Inject It Into Controller
$language = new Language( $session );

// Get Class Message
$messenger = Messenger::getInstance( $session );

// Register Object To Provide With Services Object
$register = Register::getInstance(  );

// Provide The Interface Objects Into Register Class
$register->language   = $language;
$register->session    = $session;
$register->messenger  = $messenger;


// New Instance From FrontController To Handle The Frontel Data And Inject The interdependence Objects To Controller
$FrontController = new FrontController( $register, $template, $authorized );

$FrontController->dispatch();










