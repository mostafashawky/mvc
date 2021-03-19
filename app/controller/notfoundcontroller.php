<?php
/*
 * Author: Mostafa Shawky
 * Email: mostafa.shawky47@mail.ru
 * FileName: notfoundcontroller
 * Description: not found controller working when the user request controller not exist
 */
namespace MVC\CONTROLLER;

use MVC\CONTROLLER\AbstractController;

class NotfoundController extends AbstractController{
    public function __construct()
    {
        echo 'hello Mostafa I\'M not found controller class ^_^';
    }
}
