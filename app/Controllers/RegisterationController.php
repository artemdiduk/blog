<?php

namespace App\Controllers;
use App\Models\UserModel;

use Framework\src\Controller;

class RegisterationController extends Controller
{
    public function page($data = null) {
        $modelUser = new UserModel();
        $this->render([
            "data" => [
                'form-registr' => $this->registration($_POST, $modelUser),
            ],
        ]);
        $this->layout('registration');
    }




}
