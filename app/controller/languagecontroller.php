<?php

namespace MVC\CONTROLLER;

use MVC\LIB\RedirectPageFeature;

class LanguageController extends AbstractController
{
    use RedirectPageFeature;
    public function defaultAction()
    {
        global $session;
        if($session->lang == 'ar') {
            $session->lang = 'en';
        } else {
            $session->lang = 'ar';
        }
    
        $this->redirect( $_SERVER['HTTP_REFERER'] );
    }
}