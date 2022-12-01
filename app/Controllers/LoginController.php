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
                     Auth::acceptAuth(isset($_POST['email']), isset($_POST['password'])),
                    "POST",
                ),
            ],
        ]);
        
        $this->layout('login');
    }

}
