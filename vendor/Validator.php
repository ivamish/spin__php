<?php


namespace vendor;


class Validator
{
    public static function name(string $value) : bool
    {
       return preg_match("/^[a-zA-Z-' ]*$/",$value);
    }

    public function email(string $value) : bool
    {
        return (bool)filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}