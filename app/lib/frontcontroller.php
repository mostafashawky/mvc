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
        // Run The ParseUrl Method To Obtain The Controller Data
        $this->parseUrl();
        $this->_template = $template;
        $this->_language = $language;
        $this->_database  = $database;
    }
    public function dispatch()
    {
        // Get The Controller Name String Contain The Name of Namespace
        $controller = "MVC\CONTROLLER\\".ucfirst( $this->_controller )."Controller";
        // Get The Action Name
        $action = $this->_action . 'Action';
        
        // Check If The Controller Class Exist or Controller Dosen't Contain The Method Action 
        if( !class_exists( $controller ) || !method_exists( $controller, $action ) ) {  
            // The Not Found Controller Moduel
            $controller = "MVC\CONTROLLER\\" . SELF::NOT_FOUND_CONTROLLER."";
            // The Not Found Action
            $action     = $this->_action = self::NOT_FOUND_ACTION;
        }
        // Make Instance From The Controller Module Which Is The Exist Controller Or Not Exist
        $controller = new $controller();
                
        // Provide The Controller Module With Data That We Get It From The FrontController Module 
        $controller->setController( $this->_controller );
        $controller->setAction(     $this->_action     );
        $controller->setParams(     $this->_params     );
        $controller->setLanguage(   $this->_language   );
        $controller->setTemplate(   $this->_template   );
        $controller->setDatabase(   $this->_database   );
        $controller->$action();
    }
}
