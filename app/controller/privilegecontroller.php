<?php 

namespace MVC\CONTROLLER;

use MVC\CONTROLLER\AbstractController;
use MVC\MODEL\PrivilegeModel;
use MVC\LIB\RedirectPageFeature;
use MVC\LIB\ValidateinputFeature;

class PrivilegeController extends AbstractController
{
    use ValidateinputFeature;
    use RedirectPageFeature;

    public function defaultAction()
    {

        // Get Privilege Data From Database
        $privilegeData = PrivilegeModel::getAll( $this->_database );
        
        // Provide Data Array With Privilege Data 
        $this->_data['privileges'] = $privilegeData;

        // Load Template Translation File
        $this->_language->loadtranslationFile('template|common');

        // Load Translation File Of Default Action
        $this->_language->loadtranslationFile('privilege|default');

        $this->_view();
    }
    public function addAction()
    {
        // Check If The Request Equal To Post Request To Handle The Data Send By User
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
            // Inputs From User
            $privilegeName = $_POST['privilege_name'];
            $privilegeUrl  = $_POST['privilege_url'];

            // Get New Instaniate To Provide It With Privilege Information
            $privilege = new PrivilegeModel();
            
            // Data We Get From The User After Filter It
            $privilege->privilege_name = $this->filterStr( $privilegeName );
            $privilege->privilege_url  = $this->filterStr( $privilegeUrl );
            
            // Insert The Data Into Database
            $privilege->insertData( $this->_database ) ? $this->redirect('/privilege') : false ;

        }

        // Load Template Translation File
        $this->_language->loadtranslationFile('template|common');  
        $this->_language->loadtranslationFile('privilege|add');
        $this->_view();
    }
    public function editAction()
    {
        // Get The Id Of The Privilete We Want To Edit  
        $id = $this->filterInt( $this->_params[0]);
        
        
        // Get The Privilege That We Want To Edit
        $privilege = PrivilegeModel::getbypk( $this->_database, $id );

        // Check If The Returned Value From Privilege Model Not Equal False
        if( false == $privilege ){
            $this->redirect('/privilege');
        }

        // Provide Data Array With The Privilege data
        $this->_data['privilege'] = $privilege;

        // Check If The Request Equal To Post Request To Handle The Data Send By User
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
            $privilegeName = $_POST['privilege_name'];
            $privilegeUrl  = $_POST['privilege_url'];
            
            // Reset The Privilege Data Object 
            $privilege->privilege_name = $this->filterStr( $privilegeName );
            $privilege->privilege_url  = $this->filterStr( $privilegeUrl );

        
            // Send Data To Database
            $privilege->save( $this->_database ) ? $this->redirect('/privilege') : false;
        }
        // Load Template Translation File
        $this->_language->loadtranslationFile('template|common');
        $this->_language->loadtranslationFile('privilege|edit');   
        $this->_view();
    }
    public function deleteAction( )
    {
        // Get The Id Of The Privilete We Want To Edit  
        $id = $this->filterInt( $this->_params[0]); 

        // Get The Privilege That We Want To Delete
        $privilege = PrivilegeModel::getbypk( $this->_database, $id );

        // Delete This Privilege Object
        $privilege->deleteData( $this->_database ) ? $this->redirect('/privilege') : false;
        
    }
}


?>