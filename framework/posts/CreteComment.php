<?php

namespace Framework\posts;
use App\Models\CommentsModel;
use Framework\posts\CreatorMedhodHepler;
use Framework\storage\Storage;
class CreteComment
{
    public  function createComment($data) {
        $model = new CommentsModel();
        $nameUser = $data['nameUser'];
        $post = $data['post'];
        $text = htmlspecialchars(trim(preg_replace('/[^\S\r\n]+/', ' ', $data['text'])));
        $img = $data['img'];
        if(!CreatorMedhodHepler::validateImg($img,3145728, "image/png, image/jpeg",)) {
            return false;
        }
        $storage = new Storage($this);
        $model->create(
            [
                "user" => $nameUser,
                "text" => $text,
                'post' =>  $post,
                'img' => $storage->saveImage($img, $nameUser),
            ]
        );
        return true;
    }
}
