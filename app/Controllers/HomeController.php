<?php

namespace App\Controllers;
use Framework\src\Controller;
use App\Models\GroupModel;
class HomeController extends  Controller
{
    private $group;

    public function __construct(GroupModel $group)
    {
        $this->group = $group;
    
    }
    public function page($data = null) {
        $this->render([
            "data" => [
                'all-theame' => $this->group->get()
            ],
        ]);
        
        $this->layout('Home');

    }
}
