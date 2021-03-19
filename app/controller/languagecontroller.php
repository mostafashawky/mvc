<?php

namespace MVC\CONTROLLER;

use MVC\LIB\RedirectPageFeature;

class LanguageController extends AbstractController
{
    use RedirectPageFeature;
    public function defaultAction()
    {
        if($_SESSION['lang'] == 'ar') {
            $_SESSION['lang'] = 'en';
        } else {
            $_SESSION['lang'] = 'ar';
        }
        echo $_SESSION['lang'];
        $this->redirect( $_SERVER['HTTP_REFERER'] );
    }
}