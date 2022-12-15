<?php

namespace Framework\posts;
use Framework\posts\CreaterPost;
use Framework\posts\UpdatePost;
use Framework\posts\CreateGroup;
use Framework\posts\CreteComment;
use Framework\posts\Delate;
class Creater
{
    
    public static function  acceptCreatePost($data, $model, $storage, $error, $helper) {
        $createPost = new CreaterPost($storage);
        if($createPost->createPost($data, $model, $error, $helper)) {
            return true;
        }
        return  false;
    }
    public static function acceptUpdatePost($data, $modelPost, $modelComments, $storage,  $helper) {
        $updatePost = new UpdatePost($storage);
        if($updatePost->updatePost($data, $modelPost, $modelComments,  $helper)) {
            return  true;
        }
        return  false;
    }
    public static function acceptCreateGroup($data, $model) {
        $group = new CreateGroup();
        if($group->createGroup($data, $model)) {
            return true;
        }
        return  false;
    }
    public static function acceptCreateComment($data, $model, $storage, $helper) {
        $comment = new CreteComment($storage);
        if($comment->createComment($data, $model, $helper)) {
            return true;
        }
        return  false;
    }
    public static  function delatePost($data, $modelPost, $modelComments) {
        $dalate = new Delate();
        if($dalate->detalePost($data, $modelPost, $modelComments)) {
            return true;
        }
        return  false;
    }
}
