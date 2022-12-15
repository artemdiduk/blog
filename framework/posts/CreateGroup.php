<?php

namespace Framework\posts;

class CreateGroup
{
    public  function createGroup($data, $model) {
        $name = $data['name'];
        $url = CreatorMedhodHepler::urlConvert($name);
        if ($model->getAfew('url', $url, '=')->get()) {
            return false;
        }
        $model->setCreate('name', $name)->setCreate('url', $url)->create();
        return  true;
    }

}
