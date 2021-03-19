<?php
/*
 * Author: Mostafa Shawky
 * Email: mostafa.shawky47@mail.ru
 * FileName: autoload
 * Description: Include File Based on the class name
 */

namespace MVC\LIB;

class AutoLoad {
    public static function autoload( $classname ){
        $classname = str_replace( 'MVC', '', $classname ); //Replace the MVC Word
        $classname = str_replace( '\\', DS, $classname );
        $classname = strtolower( $classname ); //convert all word to lower case beacuse file format with lowercase
        $classname = APP_PATH . $classname . '.php';
        if( !file_exists( $classname ) ){ // if file dosen't exists then stop script
            return;
        }
        require_once $classname;
    }
}

// Register the Autoload function
spl_autoload_register(__NAMESPACE__.'\AutoLoad::autoload');

