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
        $model->setCreate('user', $nameUser)->
        setCreate('text', $text)->
        setCreate('post', $post)->
        setCreate('img', $storage->saveImage($img, $nameUser))->
        create();
        return true;
    }
}
