<?php

namespace MVC\CONTROLLER;

use MVC\CONTROLLER\AbstractController;
use MVC\MODEL\GroupName;

class GroupController extends AbstractController
{
    public function defaultAction()
    {
       
        echo "<pre>";
         print_r( GroupName::getAll( $this->_database ));
        echo "</pre>";
         //   $this->_view();
    }
}