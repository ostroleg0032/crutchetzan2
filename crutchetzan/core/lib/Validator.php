<?php

namespace core\lib;

class Validator {

    public static function validate_password($password) {
        $pattern = "/^[A-Za-z0-9]{4,16}$/";
        preg_match($pattern, $password, $matches);
        if ($matches) {
            return true;
        }
        return false;
    }

    public static function validate_username($username) {
        $pattern = "/^[A-Za-z][A-Za-z0-9]{4,11}$/";
        preg_match($pattern, $username, $matches);
        if ($matches) {
            return true;
        }
        return false;
    }

    public static function password_matches($password1, $password2) {
        return ($password1 == $password2);
    } 
}

?>