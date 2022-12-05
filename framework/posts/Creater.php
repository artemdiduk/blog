<?php

namespace Framework\posts;
use Framework\posts\CreaterPost;
use Framework\posts\UpdatePost;
use Framework\posts\CreateGroup;
use Framework\posts\CreteComment;
use Framework\posts\Delate;
class Creater
{
    public static function acceptCreatePost($data, $path) {
        $createPost = new CreaterPost();
        if($createPost->createPost($data, $path)) {
            return true;
        }
        return  false;
    }
    public static function acceptUpdatePost($data, $path) {
        $updatePost = new UpdatePost();
        if($updatePost->updatePost($data, $path)) {
            return  true;
        }
        return  false;
    }
    public  static function acceptCreateGroup($data) {
        $group = new CreateGroup();
        if($group->createGroup($data)) {
            return true;
        }
        return  false;
    }
    public  static  function acceptCreateComment($data, $path) {
        $comment = new CreteComment();
        if($comment->createComment($data, $path)) {
            return true;
        }
        return  false;
    }
    public  static function delatePost($data) {
        $dalate = new Delate();
        if($dalate->detalePost($data)) {
            return true;
        }
        return  false;
    }
}