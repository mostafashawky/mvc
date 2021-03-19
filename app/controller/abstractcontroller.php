<?php
/*
 * Author: Mostafa Shawky
 * Email: mostafa.shawky47@mail.ru
 * FileName: AbstractController
 * Description: the parent controller class contains the property and method that used in all controller
 */

namespace MVC\CONTROLLER;


use MVC\LIB\FrontController;

class AbstractController
{
    protected $_controller;
    protected $_action;
    protected $_params;
    protected $_language;
    protected $_template;
    protected $_database;
    protected $_data = [];
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
    public function setLanguage( $language )
    {
        $this->_language = $language;
    }
    public function setTemplate( $template )
    {
        $this->_template = $template;
    }
    // Set Database Object To Inject It Into Requried Controller
    public function setDatabase( $database )
    {
        $this->_database = $database;
    }
    public function notfoundAction()
    {
        $this->_view();
    }
    protected function _view()
    {
        //extract the data from model in view
        $view = APP_VIEW . $this->_controller . 'controller'. DS . $this->_action . '.view.php';
        
        if( $this->_action == FrontController::NOT_FOUND_ACTION ){ //check if the action contain not found action
            $view = APP_VIEW . 'notfound' . DS . 'notfound.view.php';
        }

        if( file_exists( $view ) ) { //check if the file exists

             
            // Get Translation Array Of Action View
            $translation = $this->_language->getTranslation();
        
            // Pass The View Path To Template Object
            $this->_template->setviewPath( $view );  
            
            $this->_template->setlogicData( $this->_data, $translation );

            $this->_template->renderApp();
                 
        } else {
            require_once APP_VIEW . $this->_controller . 'controller' . DS . 'notfoundindex.php';
        }

    }
}