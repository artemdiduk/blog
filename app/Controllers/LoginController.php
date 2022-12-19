<?php

namespace App\Controllers;
use App\Repository\UserRepository;
use Framework\src\Controller;
use Framework\auth\Auth;
use Framework\ErrorReporting\Error;
class LoginController extends Controller
{
    private $user;
    private $errorHendler;
    private $auth;
    public function __construct(UserRepository $user, Error $errorHendler, Auth $auth)
    {
        $this->user = $user;
        $this->errorHendler = $errorHendler;
        $this->auth = $auth;
    }
    public function page($data = null) {
        $this->render([
            "data" => [
                'form-login' => $this->errorHendler::isError(
                    $this->auth::acceptAuth(@$_POST['email'], @$_POST['password'], $this->errorHendler, $this->user),
                    "POST",
                    "/blog",
                ),
            ],
        ]);
        
        $this->layout('login');
    }

}
