<?php

namespace Framework\posts;
use App\Models\CommentsModel;
use Framework\posts\CreatorMedhodHepler;
use Framework\services\Services;

class CreteComment
{
    public  function createComment($data, $path) {
        $model = new CommentsModel();
        $nameUser = $data['nameUser'];
        $post = $data['post'];
        $text = htmlspecialchars(trim(preg_replace('/[^\S\r\n]+/', ' ', $data['text'])));
        $img = $data['img'];
        if(!CreatorMedhodHepler::validateImg($img,3145728, "image/png, image/jpeg",)) {
            return false;
        }
        $model->create(
            [
                "user" => $nameUser,
                "text" => $text,
                'post' =>  $post,
                'img' => Services::saveImage($img, $nameUser, $path),
            ]
        );
        return true;
    }
}