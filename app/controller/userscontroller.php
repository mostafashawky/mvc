<?php

namespace MVC\CONTROLLER;

use MVC\CONTROLLER\AbstractController;
use MVC\LIB\RedirectPageFeature;
use MVC\LIB\ValidateinputFeature;
use MVC\MODEL\GroupModel;
use MVC\MODEL\UsersModel;
use MVC\MODEL\ProfileModel;

class UsersController extends AbstractController
{
    use RedirectPageFeature;
    use ValidateinputFeature;

    private $validationController = [
        "username"        => "req|gt(6)|lt(15)",
        "first_name"      => "req|gt(4)lt(15)",
        "last_name"       => "req|gt(4)lt(15)",
        "password"        => "req|gt(7)|lt(15)|confirm(repassword)",
        "email"           => "req|email|confirm(reemail)",
        "phone"           => "req|gt(10)",
        "group_id"        => "req|number",  
    
    ];
    public function defaultAction()
    {
        // Read Users From users Moduel
        $users = UsersModel::getUsers( $this->session->user );
        $this->_data['users'] = $users;

        // Load Translation File
        $this->language->loadtranslationFile("template|common");
        $this->language->loadtranslationFile("users|default");

        $this->_view();
    }
    public function addAction()
    {   

        // Read Groups From Group Moduel
        $groups = GroupModel::getAll();
        $this->_data['groups'] = $groups;
        

        // Load Translation File
        $this->language->loadtranslationFile("template|common");   
        $this->language->loadtranslationFile("users|add"); 
        $this->language->loadtranslationFile("users|labels");
        $this->language->loadtranslationFile("error|common");
      
        if( $_SERVER['REQUEST_METHOD'] == "POST" && $this->isValid( $this->validationController, $_POST) ){
            
            // Get User Moduel To Insert Data Into Users Table
            $user = new UsersModel();
            $user->username      = $_POST['username'];
            $user->password      = $_POST['password'];
            $user->email         = $_POST['email'];
            $user->phone         = $_POST['phone'];
            $user->register_data = \date("Y-m-d H:i:s");
            $user->status        = 1;
            $user->group_id      = $_POST['group_id'];

            // Get If User Exist
            if( $exist = UsersModel::CheckuserExist( $user)  ) { // If User Exist This function Return Data Else Return False
                $this->messenger->setMessage(" المستخدم موجود بالفعل");
            }

            // Seccesfull Save User Data And  Not Exist In Database
            if( $user->save( true ) && $exist == false){
         
                // Insert User Profile Data
                $profile = new ProfileModel();
                $profile->first_name = $_POST['first_name'];
                $profile->last_name = $_POST['last_name'];
                $profile->UserId = $user->UserId;
                $profile->save();
                
                $this->messenger->setMessage( "تم اضافة المستخدم بنجاح");
           
                $this->redirect("/users");
            } else {
                $this->messenger->setMessage("حدث خطأ اثناء حفظ البيانات");
            }      
        }
   
        $this->_view();
    }

    public function editAction()
    {   

         // Load Translation File
         $this->language->loadtranslationFile("template|common");   
         $this->language->loadtranslationFile("users|edit"); 
         $this->language->loadtranslationFile("users|labels");
         $this->language->loadtranslationFile("error|common");
      
         // Get User Data To Edit
         $id = $this->filterInt( $this->_params[0] );
         $user = UsersModel::getbypk( $this->_params[0] );
         
         // Check If There Is Wrong About This Id Or The User Get Him Self To Edit      
         if( false === $user  || $user->UserId === $this->session->user->UserId ) {
            $this->redirect("/users");
         }
         $this->_data['user'] = $user;

         // Get Groups Data
         $groups = GroupModel::getAll();
         $this->_data['groups'] = $groups;
         
        // Get The Requested Data 
        if( $_SERVER['REQUEST_METHOD'] === 'POST' && $this->isValid($this->validationController,  $_POST ) ) {
            $user->username = $_POST['username'];
            $user->password = $_POST['password'];
            $user->email    = $_POST['email'];
            $user->phone    = $_POST['phone'];
            $user->group_id = $_POST['group_id'];
            if( $user->save() ){
                $this->messenger->setMessage( "Data Edited Succesfully" );
            } else {
                $this->messenger->setMessage("Error With Editing Data", 3);
            }
        }

         // Action View
         $this->_view();
    }
  
}