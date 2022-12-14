<?php

namespace Framework\posts;
use Framework\posts\CreatorMedhodHepler;
use App\Models\ArticleModel;
use App\Models\CommentsModel;
use Framework\services\Services;
use Framework\storage\Storage;
class UpdatePost
{
    public function updatePost($data)
    {
        $name = trim(preg_replace('/[^\S\r\n]+/', ' ', $data['name']));
        $group = $data['group'];
        $url = $group . '/' . CreatorMedhodHepler::urlConvert($name);
        $text = htmlspecialchars(trim(preg_replace('/[^\S\r\n]+/', ' ', $data['text'])));
        $id = $data['id'];
        $img = $data['img'];
        $author = $data['author'];
        $oldUrl = $data['oldUrl'];
        $modelArticle = new ArticleModel();
        $modelComments = new CommentsModel();
        $post = $modelArticle->getAfew('id', $id, '=', "AND")->getAfew('author', $author, '=')->get(false);
        if(!$post) {
            return false;
        }

        if(!CreatorMedhodHepler::checkUrlDublicate($url, $oldUrl, $modelArticle)) {
            return false;
        }
        if(strlen($name) >= 200) {
            return false;
        }
        if(strlen($text) >= 3000) {
            return false;
        }

        $imgOld = $post['img'];

        $services  = new Storage($this);
        if($img['tmp_name'] == '') {
            $img =  $imgOld;
        }
        else if(!CreatorMedhodHepler::validateImg($img, 3145728, "image/png, image/jpeg")) {
            return false;
        }
        else {
            $img = $services->saveImage($img, $url);
        }
        $modelArticle->update("name", $name)->
        update("text", CreatorMedhodHepler::parseToHtmlText($text))->
        update('group', $group)->
        update('url', $url)->
        update('img', $img)->
        setWhere('id', $id)->
        getUpdate();
        $modelComments->update('post', $url)->setWhere('post', $oldUrl)->getUpdate();
        return true;


    }

}
