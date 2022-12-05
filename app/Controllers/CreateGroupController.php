<?php

namespace App\Controllers;
use Framework\src\Controller;
use Framework\posts\Creater;
use Framework\posts\CreatorMedhodHepler;
class CreateGroupController extends Controller
{
    public function page($data = null) {
        Creater::acceptCreateGroup(
            [
               "name" => $_POST['group'],
           ]
        );
        $url = CreatorMedhodHepler::urlConvert($_POST['group']);
        self::redirect("/blog/$url");
       
    }

}
