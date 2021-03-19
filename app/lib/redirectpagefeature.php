<?php


namespace MVC\LIB;


trait RedirectPageFeature
{
    public function redirect( $pagename )
    {
        header("location:".$pagename."");
    }
}