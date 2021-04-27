<?php

namespace MVC\CONTROLLER;

use MVC\CONTROLLER\AbstractController;
use MVC\LIB\validate;
use MVC\LIB\UserModel;
use MVC\MODEL\UsersModel;

class TestController extends AbstractController
{
    use validate;
    
    public function defaultAction()
    {   var_dump($this->session->user->group_id);
    }
    


}