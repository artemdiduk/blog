<?php

namespace App\Controllers;
use App\Models\GroupModel;
use Framework\Router;
use Framework\src\Controller;

class CreateGroupController extends Controller
{
    public function page($data = null) {
        $model = new GroupModel();
        $this->create([
            "data" => [
                "name" => $_POST['group'],
                "url" => $this->urlConvert($_POST['group'])
            ],
            'check' => [
                "name" => [
                    "operator" => "=",
                    "data" => $_POST['group'],
                    'conditions' => "AND"
                ],
                "url" => [
                    "operator" => "=",
                    "data" => $this->urlConvert($_POST['group'])
                ],
            ],
            "model" => $model,
        ]);
        $url = $this->urlConvert($_POST['group']);
        self::redirect("/blog/$url");
       
    }

}
