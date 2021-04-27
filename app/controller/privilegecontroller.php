<?php 

namespace MVC\CONTROLLER;

use MVC\CONTROLLER\AbstractController;
use MVC\MODEL\PrivilegeModel;
use MVC\LIB\RedirectPageFeature;
use MVC\LIB\ValidateinputFeature;
use MVC\LIB\Messenger;


class PrivilegeController extends AbstractController
{
    use ValidateinputFeature;
    use RedirectPageFeature;

    public function defaultAction()
    {
     
        // Get Privilege Data From Database
        $privilegeData = PrivilegeModel::getAll( );
        
        // Provide Data Array With Privilege Data 
        $this->_data['privileges'] = $privilegeData;

        // Load Template Translation File
        $this->language->loadtranslationFile('template|common');

        // Load Translation File Of Default Action
        $this->language->loadtranslationFile('privilege|default');

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
            if( $privilege->save( ) ){
                
                // Talkin Message To Put In Session File
                $this->messenger->setMessage('The Privilege Added Successfully', Messenger::MESSAGE_SUCCESS );

                $this->redirect('/privilege');
            }
        }

        // Load Template Translation File
        $this->language->loadtranslationFile('template|common');  
        $this->language->loadtranslationFile('privilege|add');
        $this->_view();
    }
    public function editAction()
    {
        // Get The Id Of The Privilete We Want To Edit  
        $id = $this->filterInt( $this->_params[0]);
        
        
        // Get The Privilege That We Want To Edit
        $privilege = PrivilegeModel::getbypk(  $id );

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
            $privilege->save(  ) ? $this->redirect('/privilege') : false;
        }
        // Load Template Translation File
        $this->language->loadtranslationFile('template|common');
        $this->language->loadtranslationFile('privilege|edit');   
        $this->_view();
    }
    public function deleteAction( )
    {
        // Get The Id Of The Privilete We Want To Edit  
        $id = $this->filterInt( $this->_params[0]); 
        // Get The Privilege That We Want To Delete
        $privilege = PrivilegeModel::getbypk( $id ) ;
        
        // Check If The Privilege Dosen't Return False which Meaning That No Data With This Id Or Not Vaild Id
        if( false == $privilege ){
            $this->redirect("/privilege");
        }
        // Delete This Privilege Object
        $privilege->deleteData(  ) ? $this->redirect("/privilege") : trigger_error("Error In Delete Method", E_USER_ERROR);
        
    }
}


?>