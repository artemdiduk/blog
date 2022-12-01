<?php

namespace App\Controllers;
use App\Models\UserModel;
use Framework\src\Controller;
use Framework\auth\Auth;
use Framework\ErrorReporting\Error;
class LoginController extends Controller
{
    public function page($data = null) {
        $this->render([
            "data" => [
                'form-login' => Error::isError(
                     Auth::acceptAuth(@$_POST['email'], @$_POST['password']),
                    "POST",
                    "/blog",
                ),
            ],
        ]);
        
        $this->layout('login');
    }

}
