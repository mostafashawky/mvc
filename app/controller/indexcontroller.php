<?php

namespace MVC\CONTROLLER;

// import abstract controller
use MVC\CONTROLLER\AbstractController;
use MVC\MODEL\employee;

class IndexController extends AbstractController{

    public function defaultAction()
    {
        // Load The Default Translation File 
        $this->_language->loadtranslationFile( 'template|common' );
        $this->_language->loadtranslationFile( 'index|default' );
        $this->_view();
        
    }
    public function addAction()
    {
        // Load The Add Action Translation File
        $this->_view();
    }
    public function __construct()
    {

    }

}
