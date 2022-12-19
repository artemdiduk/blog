<?php

namespace Framework\posts;
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
        $post = $modelArticle->getPostUrlAndAuthor('url', $url, 'author', $author)->get(false);
        if(!$post) {
            return false;
        }
        if ($modelArticle->getPostUrl('url', $url)->get()) {
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
        
        $modelArticle->updatePost(
            [
                'name' => $name,
                'url' => $url,
                'text' =>  $helper::parseToHtmlText($text),
                'group' => $group,
                'img' => $img,
                'id' => $id,
            ]
        );
        $modelComments->updateComments([
            'post' => $url,
            'whats' => $oldUrl,
        ]);
        return true;


    }

}

