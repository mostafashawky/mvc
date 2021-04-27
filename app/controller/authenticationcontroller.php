<?php

namespace MVC\CONTROLLER;

use MVC\CONTROLLER\AbstractController;
use MVC\LIB\RedirectPageFeature;
use MVC\LIB\ValidateinputFeature;
use MVC\MODEL\ProfileModel;
use MVC\MODEL\UsersModel;

class AuthenticationController extends AbstractController
{
    use RedirectPageFeature;
    use ValidateinputFeature;

    public function loginAction()  
    {

        // Get Data From Request Post ( Login Form )
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
            
            // Form Data
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Check User Authentiction Login
            $user = UsersModel::authentication( $username, $password, $this->session );

            // User Disableds
            if( 2 === $user ){ 
                $this->messenger->setMessage("You Have Been Disabled By Administration", 3);                
            
            } else if( true ===  $user){

                // The User Exist Without Problems Success Login
                $this->redirect("/");
            } else {
                // Wrong Username, Password
                $this->messenger->setMessage("Username And Password Not Correct",3);
            } 

        }

        // Load Translatio File
        $this->language->loadtranslationFile("auth|login");
        $this->_template->editTemplateparts([
            "templates_header" => [
               "starttemplateheader" => TEMPLATE_PATH . "starttemplateheader.php",
               "header_resources"    => [
                   "fonts"       => CSS . "fonts.css",
                   "normalize"   => CSS . "normalize.css",
                   "fontawesome" => CSS . "font-awesome.min.css",
                   "maincss"     => CSS . "main.".(isset($this->session->lang) ? $this->session->lang: DEFAULT_LANGUAGE).".css",   
               ],
               "endtemplateheader" => TEMPLATE_PATH . "endtemplateheader.php",
            ],
            "template_blocks" => [
                "startwrapper"         => TEMPLATE_PATH . "startwrapper.php",
                ":action"              => "action_view",
            ],
            "template_footer" => [
                "scripts" => [
                    "mainjs" => JS . "main.js"
                ],
                "template_footer" => TEMPLATE_PATH . "footertemplate.php",
            ],
        
        ]);
        $this->_view();
    }
    
    public function logoutAction()
    {
        $this->session->sessionKill();
        $this->redirect("/authentication/login");
    }

}