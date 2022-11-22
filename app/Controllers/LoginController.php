<?php

namespace App\Controllers;
use App\Models\UserModel;
use Framework\src\Controller;
class LoginController extends Controller
{
    public function page($data = null) {
        $modelUser = new UserModel();
        $this->render([
            "data" => [
                'form-login' => $this->login($_POST, $modelUser),
            ],
        ]);
        
        $this->layout('login');
    }

}
