<?php

namespace Framework\posts;

use App\Models\GroupModel;
class CreateGroup
{
    public  function createGroup($data) {
        $groupModel = new GroupModel();
        $name = $data['name'];
        $url = CreatorMedhodHepler::urlConvert($name);
        if ($groupModel->getAfew('url', $url, '=')->get()) {
            return false;
        }
        $groupModel->setCreate('name', $name)->setCreate('url', $url)->create();
        return  true;
    }

}
