<?php

namespace Framework\posts;
use Framework\posts\CreatorMedhodHepler;
use App\Models\ArticleModel;
use App\Models\CommentsModel;
use Framework\src\Database;
use Framework\storage\Storage;
class UpdatePost
{
    private $storage;
    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }
    public function updatePost($data, $modelArticle, $modelComments,  $helper)
    {
        $name = trim(preg_replace('/[^\S\r\n]+/', ' ', $data['name']));
        $group = $data['group'];
        $url = $group . '/' . $helper::urlConvert($name);
        $text = htmlspecialchars(trim(preg_replace('/[^\S\r\n]+/', ' ', $data['text'])));
        $id = $data['id'];
        $img = $data['img'];
        $author = $data['author'];
        $oldUrl = $data['oldUrl'];
        $post = $modelArticle->getAfew('id', $id, '=', "AND")->getAfew('author', $author, '=')->get(false);
        if(!$post) {
            return false;
        }
        if(!$helper::checkUrlDublicate($url, $oldUrl, $modelArticle)) {
            return false;
        }
        if(strlen($name) >= 200) {
            return false;
        }
        if(strlen($text) >= 3000) {
            return false;
        }

        $imgOld = $post['img'];

       
        if($img['tmp_name'] == '') {
            $img =  $imgOld;
        }
        else if(!$helper::validateImg($img, 3145728, "image/png, image/jpeg")) {
            return false;
        }
        else {
            $img = $this->storage->saveImage($img, $url);
        }
        $modelArticle->update("name", $name)->
        update("text", $helper::parseToHtmlText($text))->
        update('group', $group)->
        update('url', $url)->
        update('img', $img)->
        setWhere('id', $id)->
        getUpdate();
        $modelComments->update('post', $url)->setWhere('post', $oldUrl)->getUpdate();
        return true;


    }

}
