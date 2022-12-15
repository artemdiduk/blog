<?php

namespace Framework\auth;


class Authorization
{
    public function login($email, $password, $error, $user) {
        $user = $user->getAfew('email', $email)->get(false);
        if (!$user) {
            $error::setError("Неверные данные");
            return false;
        }
        if (password_verify($password, $user['password']) && empty($error::getError())) {
            session_start();
            $_SESSION['login'] = $user;
            return true;
        }
        return false;
    }
}
