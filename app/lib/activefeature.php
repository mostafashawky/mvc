<?php

namespace MVC\LIB;

trait ActiveFeature
{
    // This Method Is Check If We In The Require Controller To Put Selected Class To Link In Sidebar
    public function checkActive( $activeLink )
    {   
        
        $url = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
        $urlArray = explode( '/', trim( $url, '/') );
        return  ( $urlArray[0] === $activeLink )  ? 'selected' : '';

    }
}