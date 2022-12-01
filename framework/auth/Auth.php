<?php

namespace Framework\auth;
use Framework\auth\Authorization;

class Auth
{

    public static function acceptAuth($email, $password) {
        $login = new Authorization;
        if($login->login($email, $password)) {
            return true;
        }
        return false;
    }
}
