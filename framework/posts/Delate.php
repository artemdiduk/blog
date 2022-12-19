<?php

namespace Framework\posts;


class Delate
{
    public  function detalePost($data, $modelPost, $modelComments) {
        $url = $data['url'];
        $author = $data['author'];
        $post = $modelPost->getPostUrlAndAuthor('url', $url, 'author', $author)->get(false);
        $comments = $modelComments->getCommentsPostAndAuthor('post', $url, 'user', $author)->get(false);
        if(!$post) {
           return false;
        }
        
        $modelPost->getPostUrl('url', $url)->delate();
        if($comments) {
             $modelComments->getCommentsPost('post', $url)->delate();
        }
        return  true;

    }
}

