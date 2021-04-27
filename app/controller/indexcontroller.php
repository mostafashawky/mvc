<?php

namespace MVC\CONTROLLER;

// import abstract controller
use MVC\CONTROLLER\AbstractController;
class IndexController extends AbstractController
{

    public function defaultAction()
    {
      
        // Load The Default Translation File 
       $this->language->loadtranslationFile( 'template|common' );
       $this->language->loadtranslationFile( 'index|default' );
       $this->_view();
    }
    public function addAction()
    {
        // Load The Add Action Translation File
        $this->_view();
    }


}
