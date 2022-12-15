<?php

namespace Framework\auth;
use Framework\auth\Authorization;
use Framework\auth\Registration;
use Framework\auth\AuthUser;
class Auth
{

    public static function acceptAuth($email, $password, $error, $model) {
        $login = new Authorization;
        if($login->login($email, $password, $error, $model)) {
            self::user();
            return true;
        }
        return false;
    }
    public  static  function acceptAuthRegistration($name, $email, $password, $error, $model)
    {
        $registr = new Registration();
        if ($registr->regestration($name, $email, $password, $error, $model)) {
            self::user();
            return true;
        }
        return false;
    }
    public static function user (){
        $user = new AuthUser();
        return $user->authUser();
    }
}
