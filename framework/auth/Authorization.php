<?php

namespace Framework\auth;
use App\Models\UserModel;
use Framework\ErrorReporting\Error;
class Authorization
{
    public function login($email, $password) {
        $user = new UserModel;
        $user = $user->getAfew(
            [
                "email" => [
                    "operator" => "=",
                    "data" => $email,
                ],
            ],
            false
        );
        if (!$user) {
            Error::setError("Неверные данные");
            return false;
        }
        if (password_verify($password, $user['password']) && empty(Error::getError())) {
            session_start();
            $_SESSION['login'] = $user;
            return true;
        }
        return false;
    }
}
