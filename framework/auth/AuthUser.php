<?php

namespace Framework\auth;

class AuthUser
{
    public function authUser()
    {
        if (isset($_SESSION['login'])) {
            return $_SESSION['login'];
        } else {
            return null;
        }
    }
}
