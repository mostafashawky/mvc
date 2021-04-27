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
    public function notfoundAction()
    {
        $this->language->loadtranslationFile('template|common');
        $this->language->loadtranslationFile('notfound|notfound');
        $this->_view();
    }

}
