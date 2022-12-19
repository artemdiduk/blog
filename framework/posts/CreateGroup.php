<?php

namespace Framework\posts;

class CreateGroup
{
    public  function createGroup($data, $model) {
        $name = $data['name'];
        $url = CreatorMedhodHepler::urlConvert($name);
        if ($model->getGroupUrl('url', $url)->get()) {
            return false;
        }
        $model->createGroup([
            'name' => $name,
            'url' => $url,
        ]);
        return  true;
    }

}
