<?php

namespace MVC\CONTROLLER;

use MVC\CONTROLLER\AbstractController;
use MVC\MODEL\GroupName;

class GroupController extends AbstractController
{
    public function defaultAction()
    {
        // Get All Group And Push It Into Data Array 
        $this->_data['group'] = GroupName::getAll( $this->_database );
    
        $this->_view();
    }
}