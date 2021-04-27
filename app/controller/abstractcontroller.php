<?php

namespace MVC\CONTROLLER;

use MVC\LIB\Register;
use MVC\LIB\FrontController;
use MVC\LIB\template\Template;
use MVC\LIB\validate;

class AbstractController
{
    use validate;
    // Controller Name Which Will Be Provided With Set Controller Interface
    protected $_controller;

    // Action Name Which Will Be Proviced With Set Action Interface
    protected $_action;

    // Paramater Array Whici Will Be Provided With Set Paramater 
    protected $_params;

    // The Register Object That Contain The Template And Language Services
    protected $_register; 
    
    // Template Object Which Resposible For Handle Tempalte
    protected $_template;

    // Data Model
    protected $_data = []; 
    
    // Controller Interface Method To Supply The Controller Information
    public function setController( $controller )
    {
        $this->_controller = $controller;
    }

    public function setAction( $action )
    {
        $this->_action = $action;
    }
    public function setParams( $params )
    {
        $this->_params = $params;
    }
    public function setTemplate( Template $template )
    {
        $this->_template = $template;
    }
    public function setRegister( Register $register )
    {
        $this->_register = $register;
    }
    
    // Get The Object From Registery 
    public function __get( $key )
    {
        // The Key Here Get The Property Name That Contain The Object In Registery 
        if( isset( $this->_register->$key ) ){
            return $this->_register->$key;
        } else{
            trigger_error('This Object '.$key.' Dosen\'t Exist');
        }
    }

    public function notfoundAction()
    {
        $this->_view();
    }
    protected function _view()
    {
        // Get The Controller And Action Required To Load It
        $view = APP_VIEW . $this->_controller . 'controller'. DS . $this->_action . '.view.php';
        // Check If The Action Value Is Not Found Action To Load The Notfound View
        if( $this->_action == FrontController::NOT_FOUND_ACTION ){ 
            $view = APP_VIEW . 'notfound' . DS . 'notfound.view.php';
        }
        // Check If The File Exists
        if( file_exists( $view ) ) { 
            // Get Translation Array Of Action View
            $translation = $this->language->getTranslation();

            // Provide The Logic Data To Template Object To View It
            $this->_template->setlogicData( $this->_data, $translation );

            // Provide The View Path To Template Object
            $this->_template->setviewPath( $view );
              
            // Provide Temlate Service With Register Module
            $this->_template->setRegister( $this->_register );
            
            // Render App To Load The Templates 
            $this->_template->renderApp();

        } else {
            triggeR_error( "The Controller And Action Exist But View File Dose't Exist",E_USER_ERROR );
        }


    }
} 