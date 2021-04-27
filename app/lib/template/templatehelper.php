<?php

namespace MVC\LIB\template;

trait TemplateHelper
{
    // @This Trait Is Responsible For The Additionl Things In Template
    
    // This Method Is Check If We In The Required Controller To Put Selected Class To Link In Sidebar
    private function checkActive( $activeLink )
    {   
        
        $url = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
        $urlArray = explode( '/', trim( $url, '/') );
        return  ( $urlArray[0] === $activeLink )  ? 'selected' : '';

    }

    // Method To Check If The User Send Form Data
    private function checkRequest( $fieldName, $UserObject = null )
    {
        // Check If The Request Is Method ( Update Data Or Insert New Data )
        if( $_SERVER['REQUEST_METHOD'] == 'POST'){
            return $_POST[$fieldName];  
        } 
        if( !is_null( $UserObject ) && is_object( $UserObject ) ){
            return $UserObject->$fieldName;
        }
    }
}