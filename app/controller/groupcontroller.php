<?php

namespace MVC\CONTROLLER;

use MVC\CONTROLLER\AbstractController;
use MVC\MODEL\GroupModel;
use MVC\MODEL\PrivilegeModel;
use MVC\LIB\ValidateinputFeature;
use MVC\LIB\RedirectPageFeature;
class GroupController extends AbstractController
{
    use RedirectPageFeature;        
    use ValidateinputFeature;
    public function defaultAction()
    {
        // Get The  
        // Load Translatio File
        $this->_language->loadtranslationFile('template|common');

        $this->_view();
    }
    public function addAction()
    {
        // Get The Privileges
        $privilege = PrivilegeModel::getAll( $this->_database );
        
        // Provide Data Array With Privilege Data
        $this->_data['privileges'] = $privilege;

        // Check If The  Request Server Equal To Post That Come From User Inputs
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
            $groupName = $_POST['group_name'];
            
            // Get New Instaniate To Provide It With Group Information
            $group = new GroupModel();
            $group->group_name = $this->filterStr(  $groupName );
            $group->insertData( $this->_database ) ? $this->redirect('/group'): false; 

        }  
        // Load Translatio File
        $this->_language->loadtranslationFile('template|common');

        $this->_view();
    }
}