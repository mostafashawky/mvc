<?php

namespace MVC\CONTROLLER;

use MVC\CONTROLLER\AbstractController;
use MVC\MODEL\employee; //import employee model class
use MVC\LIB\ValidateinputFeature;
use MVC\LIB\RedirectPageFeature;
class EmployeeController extends AbstractController
{
    // import validate input feature
    use ValidateinputFeature;
    use RedirectPageFeature;
    public function defaultAction()
    {
        
        // Get The Employee Data To Export It Into The Data Array
        $employees = employee::getemployee();
        $this->_data['employeesKey'] = $employees;

        // Load The Template Translation File
        $this->_language->loadtranslationFile( 'template|common' );
        // The Language Module Will Fetch The Required Language File Of Action View
        $this->_language->loadtranslationFile( 'employee|default' );

        // Load Default View Action
        $this->_view();
    }
    public function addAction()
    {
        // Hold Employee Information From Add Employee Page
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $fullname = $_POST['fullname'];
            $salary = $_POST['salary'];

            // Talk To Employee Model to Add The Employee Information
            $emp = new employee(  ); // Employee Object

            // Employee Information
            $emp->username =   $this->filterStr( $username );
            $emp->email    =   $this->filterEmail( $email );
            $emp->fullname =   $this->filterStr( $fullname );
            $emp->salary   =   $this->filterDec( $salary );
            $emp->save()   ?   $this->redirect( '/employee' ) : null;

        }
        $this->_language->loadtranslationFile( 'template|common' ); 
        $this->_language->loadtranslationFile( 'employee|add' );
        $this->_view();

    }
    public function editAction()
    {

        $id = $this->filterInt( $this->_params[0] );
        // talk with model to get employee data which will be edited
        $emp = employee::getbypk( $id );
        //send data employee to view
        $this->_data['employeeEdit'] = $emp;

        if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $fullname = $_POST['fullname'];
            $salary = $_POST['salary'];
            $emp->username = $this->filterStr( $username );
            $emp->email = $this->filterEmail( $email );
            $emp->fullname = $this->filterStr( $fullname );
            $emp->salary = $this->filterDec( $salary );
            $emp->save() ? $this->redirect( '/employee' ) : null;
        }
        $this->_language->loadtranslationFile( 'employee|edit' );
        $this->_language->loadtranslationFile( 'template|common' ); 
        $this->_view();
    }
    public function deleteAction()
    {

        $id = $this->filterInt( $this->_params[0] );
        if (employee::delete( $id ) ){
            $this->redirect( '/employee' );
        }


    }
}