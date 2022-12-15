<?php

namespace App\Controllers;

use App\Models\UserModel;
use Framework\src\Controller;
use Framework\auth\Auth;
use Framework\ErrorReporting\Error;

class RegisterationController extends Controller
{   private $user;
    private $errorHendler;
    private $auth;
    public function __construct(UserModel $user, Error $errorHendler, Auth $auth)
    {
        $this->user = $user;
        $this->errorHendler = $errorHendler;
        $this->auth = $auth;
    }
    public function page($data = null) {
        $this->render([
            "data" => [
                'form-registr' =>
                $this->errorHendler::isError(
                    $this->auth::acceptAuthRegistration
                    (
                    @$_POST['name'], 
                    @$_POST['email'], 
                    @$_POST['password'],
                    $this->errorHendler,
                    $this->user,
                    ),
                    "POST",
                    "/blog",
                ),
            ],
        ]);
        $this->layout('registration');
    }




}
