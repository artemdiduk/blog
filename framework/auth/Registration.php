<?php

namespace Framework\auth;
class Registration
{
    public function regestration($name, $email, $password, $error, $user)
    {
        $name = strtolower(trim($name));
        $email = trim($email);
        $password = trim($password);
        $slug = trim($name);
        $userEmail = $user->getAfew('email', $email)->get();
        $userName = $user->getAfew('name', $name)->get();
        if ($userEmail) {
            $error::setError("Такая почта уже зарегестрируваная");
            return false;
        }
        if ($userName) {
            $error::setError("Такой узер уже єсть");
            return false;
        }
        if (strlen($name) < 3 || ctype_digit($name)) {
            $error::setError("Некорректное  имя (Имя не должно состоять с цифр или имя меньшие трьох символов)");
        }
        if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,16}$/", $password)) {
            $error::setError("Пароль минимум 6 символов, только лат. Буквы, с цифрами и одной заглавной");
        }
        if (empty($error::getError())) {
            $user->
            setCreate('name', $name)->
            setCreate('email', $email)->
            setCreate('password', password_hash($password, PASSWORD_DEFAULT))->
            setCreate('slug', $slug)->
            create();
            session_start();
            $_SESSION['login'] = $user->getaFew("name", $name)->get(false);
            return true;
        }
        return  false;
    }
}
