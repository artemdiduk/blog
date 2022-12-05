<?php

namespace Framework\posts;
use Framework\posts\CreatorMedhodHepler;
use App\Models\ArticleModel;
use App\Models\CommentsModel;
use Framework\services\Services;
class UpdatePost
{
    public function updatePost($data, $path)
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
        $post = $modelArticle->getAfew([
                    "id" => [
                        "operator" => "=",
                        "data" => $id,
                        'conditions' => "AND"
                    ],
                    "author" => [
                        "operator" => "=",
                        "data" => $author,
                    ],
                ],
                false
        );

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

        if($img['tmp_name'] == '') {
            $img =  $imgOld;
        }
        else if(!CreatorMedhodHepler::validateImg($img, 3145728, "image/png, image/jpeg")) {
            return false;
        }
        else {
            $img = Services::saveImage($img, $url, $path);
        }
        CreatorMedhodHepler::updata([
            ["name" => $name],
            ['text' => CreatorMedhodHepler::parseToHtmlText($text)],
            ['group' => $group],
            ['url' => $url],
            ['img' => $img],
        ],
            $modelArticle,
            $id
        );
        CreatorMedhodHepler::updataMoreData($oldUrl, $url, [$modelComments], 'post');
        return true;


    }

}