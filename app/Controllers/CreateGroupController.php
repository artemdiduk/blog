<?php

namespace App\Controllers;
use Framework\src\Controller;
use Framework\posts\Creater;
use Framework\posts\CreatorMedhodHepler;
use App\Models\GroupModel;
class CreateGroupController extends Controller
{
    private $group;
    private $createrHelper;
    private $createGroup;
    public function __construct(GroupModel $group, Creater $createGroup, CreatorMedhodHepler $createrHelper)
    {
        $this->group = $group;
        $this->createGroup= $createGroup;
        $this->createrHelper = $createrHelper;
    }
    public function page($data = null) {
        $this->createGroup::acceptCreateGroup(
            [
               "name" => $_POST['group'],
            ],
            $this->group 
        );
        $url = $this->createrHelper::urlConvert($_POST['group']);
        self::redirect("/blog/$url");
       
    }

}
