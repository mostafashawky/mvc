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
        $groups = GroupModel::getAll( );
        $this->_data['groups'] = $groups;

        // Load Translatio File
        $this-> language->loadtranslationFile('template|common');
        $this->language->loadtranslationFile('group|default');
        $this->_view();
    }
    public function addAction()
    {
        // Get The Privileges
        $privilege = PrivilegeModel::getAll( );
        
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
                
                    $groupPrivilege->save( ) ? $this->redirect('/group') : false ;
                }   
            }
            
        }   

        // Load Translatio File
        $this->language->loadtranslationFile('template|common');
        $this->language->loadtranslationFile('group|add');

        $this->_view();
    }
    public function editAction()
    {   
        // Get Group Model To Get Required Group
        $group = GroupModel::getbypk( $this->_params[0]  );

        // Check If The Returened Value Equal False Mean That The Data Dosen't Exit Or Wrong Id
        if( false == $group ) {
            $this->redirect('/group');
        }
        $this->_data['group'] = $group;
        
        // Get Privileges Model To Get All Privileges
        $privilege = PrivilegeModel::getAll( );
        $this->_data['privileges'] = $privilege;
        
        // Get Privilege That Related To Group We Want To Edit
        $privilegesId = GroupPrivilegeModel::getbycolumn( ['group_id' => $group->group_id]  );
        $privilegesIdstack = [];
      
        if( false != $privilegesId ){   
            // Push The Privilege Id To Array Stack
            foreach( $privilegesId as $privilegeId ){
                $privilegesIdstack[] = $privilegeId->privilege_id;
            }
        }
        
        // Pass The Old Privilege Related To Grop
        $this->_data['privilegesIdstack'] = $privilegesIdstack;

        // Get The Data Of The Privilege Edited From User
        if( $_SERVER['REQUEST_METHOD'] =='POST' ){  
            $groupname         = $_POST['group_name'];

            // Check First If The Privileges Post Empty Or not
            $privileges        = !empty( $_POST['privileges'] ) ? $_POST['privileges'] : [] ;

            // Compare The Input Data From User To Old Data That Saved In Database In PrivilegeIdstack Array
            $deletedPrivileges = array_diff( $privilegesIdstack, $privileges );
            $insertPrivileges  = array_diff( $privileges, $privilegesIdstack );
            
            // Reset The Group Object That We Get With Pk
            $group->group_name = $this->filterStr( $groupname );
            $group->updateData(  );
            
            // Loop Through The Deleted Privileges 
            // We Here Deal With Privilege_id Not PK So We Should Use Delete By Column
            foreach( $deletedPrivileges as $deletedPrivilege ){
                // Delete Them
                GroupPrivilegeModel::deletebycolumn( ['privilege_id'=>$deletedPrivilege,'group_id'=> $group->group_id]);

            }

            // Loop Through The Inserted Privileges
            foreach( $insertPrivileges as $insertPrivilege ){
                // Insert them
               $groupPrivilege = new GroupPrivilegeModel();
               $groupPrivilege->group_id     = $group->group_id;
               $groupPrivilege->privilege_id = $insertPrivilege;
               $groupPrivilege->insertData( ); 
            }   
            $this->redirect('/group');
        }
        
        // Load Translation File
        $this->language->loadtranslationFile('template|common');
        $this->language->loadtranslationFile('group|edit');
        $this->_view();
    }
}