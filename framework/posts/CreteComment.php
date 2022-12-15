<?php

namespace Framework\posts;
use App\Models\CommentsModel;
use Framework\posts\CreatorMedhodHepler;
use Framework\src\Database;
use Framework\storage\Storage;
class CreteComment
{
    private $storage;
    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }
    public  function createComment($data, $model, $helper) {
        $nameUser = $data['nameUser'];
        $post = $data['post'];
        $text = htmlspecialchars(trim(preg_replace('/[^\S\r\n]+/', ' ', $data['text'])));
        $img = $data['img'];
        if(!$helper::validateImg($img,3145728, "image/png, image/jpeg",)) {
            return false;
        }
        
        $model->setCreate('user', $nameUser)->
        setCreate('text', $text)->
        setCreate('post', $post)->
        setCreate('img', $this->storage->saveImage($img, $nameUser))->
        create();
        return true;
    }
}
