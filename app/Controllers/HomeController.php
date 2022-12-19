<?php

namespace App\Controllers;
use Framework\src\Controller;

use App\Repository\GroupRepository;

class HomeController extends  Controller
{
    private $group;

    public function __construct(GroupRepository $group)
    {
        $this->group = $group;
    
    }
    public function page($data = null) {
        $this->render([
            "data" => [
                'all-theame' => $this->group->getAll()
            ],
        ]);
        
        $this->layout('Home');

    }
}
