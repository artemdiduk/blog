<?php

namespace App\Controllers;
use Framework\src\Controller;
use Framework\auth\Auth;
use Framework\ErrorReporting\Error;
class RegisterationController extends Controller
{
    public function page($data = null) {
        $this->render([
            "data" => [
                'form-registr' => Error::isError(
                    Auth::acceptAuthRegistration(@$_POST['name'], @$_POST['email'], @$_POST['password']),
                    "POST",
                    "/blog",
                ),
            ],
        ]);
        $this->layout('registration');
    }




}
