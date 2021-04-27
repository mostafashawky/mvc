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
defined( 'APP_PATH' )      ? null : define( 'APP_PATH', dirname( __FILE__ ) . DS . '..' . DS );
defined( 'APP_VIEW' )      ? null : define( 'APP_VIEW', APP_PATH . 'view' . DS );
defined( 'LANGUAGE_PATH' ) ? null : define( 'LANGUAGE_PATH', APP_PATH . 'languages' . DS );
defined( 'TEMPLATE_PATH' ) ? null : define( 'TEMPLATE_PATH', APP_PATH . 'template' . DS );
defined( 'CSS' )           ? null : define( 'CSS', DS . 'css' . DS );
defined( 'JS' )            ? null : define( 'JS', DS  . 'js' . DS );
// Default Language
defined( 'DEFAULT_LANGUAGE' ) ? null : define( 'DEFAULT_LANGUAGE', 'ar' );

// Define Session Constants
define( 'SESSION_PATH' , realpath( APP_PATH  . '..' . DS  . 'sessionfile' )) ;  

