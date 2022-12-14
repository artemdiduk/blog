<?php

namespace Framework\posts;
use App\Models\CommentsModel;
use App\Models\ArticleModel;
class Delate
{
    public  function detalePost($data) {
        $url = $data['url'];
        $author = $data['author'];
        $modelPost = new ArticleModel();
        $modelComments = new CommentsModel();
        $post = $modelPost->getAfew('url', $url, "AND")->getAfew('author', $author)->get(false);
        $comments = $modelComments->getAfew('post', $url, "AND")->getAfew('user', $author)->get(false);
        if(!$post) {
           return false;
        }
        
        $modelPost->getAfew('url', $url)->delate();
        if($comments) {
             $modelComments->getAfew('post', $url)->delate();
        }
        return  true;

    }
}
