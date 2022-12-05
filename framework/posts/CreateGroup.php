<?php

namespace Framework\posts;

use App\Models\GroupModel;
class CreateGroup
{
    public  function createGroup($data) {
        $groupModel = new GroupModel();
        $name = $data['name'];
        $url = CreatorMedhodHepler::urlConvert($name);
        if($groupModel->getUnique(["url" => $url], true)) {
            return false;
        }
        $groupModel->create([
            "name" => $name,
            "url" => $url,
        ]);
        return  true;
    }

}
