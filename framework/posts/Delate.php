<?php

namespace Framework\posts;


class Delate
{
    public  function detalePost($data, $modelPost, $modelComments) {
        $url = $data['url'];
        $author = $data['author'];
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
