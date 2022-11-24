<?php

namespace App\Controllers;
use Framework\src\Controller;
use App\Models\GroupModel;
class HomeController extends  Controller
{
    public function page($data = null) {
        $model = new GroupModel();
        $this->render([
            "data" => [
                'all-theame' => $model->get()
            ],
        ]);
       
        $this->layout('Home');
        
    }
}
