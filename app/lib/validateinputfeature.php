<?php


namespace MVC\LIB;


trait ValidateinputFeature
{
    public function filterStr($input)
    {
        return filter_var($input, FILTER_SANITIZE_STRING);
    }

    public function filterInt($input)
    {
        return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
    }

    public function filterDec($input)
    {
        return filter_var($input, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ALLOW_FRACTION);
    }

    public function filterEmail($input)
    {
        return filter_var($input, FILTER_SANITIZE_EMAIL);
    }
}