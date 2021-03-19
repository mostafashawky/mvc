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
        // Get The Controller And Action Required To Load It
        $view = APP_VIEW . $this->_controller . 'controller'. DS . $this->_action . '.view.php';
        // Check If The Action Value Is Not Found Action To Load The Notfound View
        if( $this->_action == FrontController::NOT_FOUND_ACTION ){ 
            $view = APP_VIEW . 'notfound' . DS . 'notfound.view.php';
        }
        // Check If The File Exists
        if( file_exists( $view ) ) { 
            // Get Translation Array Of Action View
            $translation = $this->_language->getTranslation();
            // Provide The Logic Data To Template Object To View It
            $this->_template->setlogicData( $this->_data, $translation );
            // Provide The View Path To Template Object
            $this->_template->setviewPath( $view );  
            // Render App To Load The Templates 
            $this->_template->renderApp();
                 
        }

    }
}