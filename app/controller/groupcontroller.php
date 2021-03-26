<?php

namespace MVC\CONTROLLER;

use MVC\CONTROLLER\AbstractController;
use MVC\MODEL\GroupModel;
use MVC\MODEL\PrivilegeModel;
use MVC\MODEL\GroupPrivilegeModel ;
use MVC\LIB\ValidateinputFeature;
use MVC\LIB\RedirectPageFeature;
class GroupController extends AbstractController
{
    use RedirectPageFeature;        
    use ValidateinputFeature;
    public function defaultAction()
    {
        // Get The Groups With Group Model And Provide The Data To Data Array
        $groups = GroupModel::getAll( $this->_database );
        $this->_data['groups'] = $groups;

        // Load Translatio File
        $this->_language->loadtranslationFile('template|common');
        $this->_language->loadtranslationFile('group|default');
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
            $privileges = $_POST['privileges'];
       
            // Get New Instaniate Group To Provide It With Group Information
            $group = new GroupModel ();
            $group->group_name = $this->filterStr(  $groupName );
            
            // Save Data In Database And Get The Last Insert ID To Provide Table GroupPrivilege With it 
            if($group->save( $this->_database, true ) ){
                
                // Get New Instiantiate PrivilegeGroup To Provide It With Privilege And Group Information
                $groupPrivilege = new GroupPrivilegeModel();

                // Loop Through Privileges Which We Get From User Inputs
                foreach( $privileges as $privilege ){
                    $groupPrivilege->group_id = $group->group_id;
                    $groupPrivilege->privilege_id = $privilege;
                
                    $groupPrivilege->save( $this->_database ) ? $this->redirect('/group') : false ;
                }   
            }
            
        }   

        // Load Translatio File
        $this->_language->loadtranslationFile('template|common');
        $this->_language->loadtranslationFile('group|add');

        $this->_view();
    }
    public function editAction()
    {
        $this->_view();
    }
}