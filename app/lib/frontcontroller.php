<?php

namespace MVC\LIB;

// Import Template
use MVC\LIB\template\Template;
use MVC\LIB\Authorized;
use MVC\LIB\RedirectPageFeature;
class FrontController 
{
    use RedirectPageFeature;
    const NOT_FOUND_CONTROLLER = 'NotfoundController';
    const NOT_FOUND_ACTION = 'notfoundAction';

    private $_controller = 'index';
    private $_action = 'default';
    private $_params = array();
    private $_template;
    private $_register;
    private $_authorized;

    private function parseUrl()
    {
        // Get Pathname Only
        $url = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ); 
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
    public function __construct( Register $register, Template $template, Authorized $authorized ) // @param accept the template, language injection object
    {
        // Run The ParseUrl Method To Obtain The Controller Data
        $this->parseUrl();

        // Registery Object Injection Contain The Dependecie Objects ( Services )
        $this->_register  = $register; 

        // Template Object Service
        $this->_template = $template;
        
        $this->_authorized = $authorized;

    }
    public function dispatch()
    {
        
        // Get The Controller Name String Contain The Name of Namespace
        $controller = "MVC\CONTROLLER\\".ucfirst( $this->_controller )."Controller";
        // Get The Action Name
        $action = $this->_action . 'Action';
    
        // Check If There User Data In Session ( Login )
        if( $this->_authorized->is_authorized() === false ){
            
            // Check First If We In Authentication Page
            if( $this->_controller != 'authentication' && $this->_action != "login" ){
                $this->redirect("/authentication/login");
            }
        } else {
            if( $this->_controller == "authentication" && $this->_action == "login" ){
                $this->redirect("/");
            } 
        }
        
        
        // Check If The Controller Class Exist or Controller Dosen't Contain The Method Action 
        if( !class_exists( $controller ) || !method_exists( $controller, $action ) ) {  
            // The Not Found Controller Moduel
            $controller = "MVC\CONTROLLER\\" . SELF::NOT_FOUND_CONTROLLER."";
            $this->_controller = self::NOT_FOUND_CONTROLLER;
            // The Not Found Action
            $action     = $this->_action = self::NOT_FOUND_ACTION;
            
        }
        
        // Make Instance From The Controller Module Which Is The Exist Controller Or Not Exist
        $controller = new $controller( );

        // Provide The Controller Module With Data That We Get It From The FrontController Module 
        $controller->setController( $this->_controller );
        $controller->setAction(     $this->_action     );
        $controller->setParams(     $this->_params     );
        $controller->setTemplate(   $this->_template   );
        $controller->setRegister(   $this->_register   );
        $controller->$action();
    }
}
