<?php

namespace Framework\auth;

use App\Models\UserModel;
use Framework\ErrorReporting\Error;

class Registration
{
    public function regestration($name, $email, $password)
    {
        $user = new UserModel();
        $name = strtolower(trim($name));
        $email = trim($email);
        $password = trim($password);
        $slug = trim($name);
        $userEmail = $user->getUnique(["email" => $email], true);
        $userName = $user->getUnique(["name" => $name], true);
        if ($userEmail) {
            Error::setError("Такая почта уже зарегестрируваная");
            return false;
        }
        if ($userName) {
            Error::setError("Такой узер уже єсть");
            return false;
        }
        if (strlen($name) < 3 || ctype_digit($name)) {
            Error::setError("Некорректное  имя (Имя не должно состоять с цифр или имя меньшие трьох символов)");
        }
        if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,16}$/", $password)) {
            Error::setError("Пароль минимум 6 символов, только лат. Буквы, с цифрами и одной заглавной");
        }
        if (empty(Error::getError())) {
            $userCrator =
            [
                "name" => $name,
                'email' => $email,
                "password" => password_hash($password, PASSWORD_DEFAULT),
                "slug" => $slug
            ];
            $user->create(
                $userCrator
            );
            session_start();
            $_SESSION['login'] = $userCrator;
            return true;
        }
        return  false;
    }
}
