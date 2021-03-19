<?php
/*
 * Author: Mostafa Shawky
 * Email: mostafa.shawky47@mail.ru
 * FileName: frontcontroller
 * Description:
 *  this file is responsibe for handle to request And Extract the controller And Action then disptch the controller
 *
 */

namespace MVC\LIB;

class FrontController {
    private $_controller = 'index';
    private $_action = 'default';
    private $_params = array();
    private $_database;
    private $_template; 
    private $_language;

    const NOT_FOUND_CONTROLLER = 'NotfoundController';
    const NOT_FOUND_ACTION = 'notfoundAction';
    private function parseUrl()
    {
        $url = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ); //get pathname only
        $url = trim( $url, '/' ); //remove slashes
        $url = explode('/', $url, 3); //convert the url into array to extract it into pieces
        
        //check if the controller exists
        if( isset( $url[0] ) && '' != $url[0]  ){
            $this->_controller = $url[0];
        }
        //check if action exists
        if( isset( $url[1] ) && '' != $url[1] ) {
            $this->_action = $url[1];
        }
        //check if params exists
        if( isset( $url[2] ) && '' != $url[2] ){
            $this->_params = explode('/', $url[2] );

        }
    }
    public function __construct( Template $template, Language $language, DATABASE $database  ) // @param accept the template, language injection object
    {
        // the parseurl function will work when instantiate object
        $this->parseUrl();
        $this->_template = $template;
        $this->_language = $language;
        $this->_database  = $database;
                   
    }
    public function dispatch()
    {
        $controller = "MVC\CONTROLLER\\".ucfirst( $this->_controller )."Controller";

        if( !class_exists( $controller ) ) { //if the controller dosen't exist then we will can not found controller
            $controller = "MVC\CONTROLLER\\".SELF::NOT_FOUND_CONTROLLER."";
        }
        $controller = new $controller();
        $action = $this->_action . 'Action';
        if( !method_exists( $controller, $action ) ){ //check if the method exist in controller object
            $this->_action = $action = self::NOT_FOUND_ACTION ;
        }

        //set the controller its property
        $controller->setController( $this->_controller );
        $controller->setAction(     $this->_action     );
        $controller->setParams(     $this->_params     );
        $controller->setLanguage(   $this->_language   );
        $controller->setTemplate(   $this->_template   );
        $controller->setDatabase(   $this->_database   );
        $controller->$action();

    }
}
