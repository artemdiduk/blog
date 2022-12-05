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
        $post = $modelPost->getAfew(
                [
                    "url" => [
                        "operator" => "=",
                        "data" => $url,
                        'conditions' => "AND"
                    ],
                    "author" => [
                        "operator" => "=",
                        "data" => $author,
                    ],
                ]
        );
        $comments = $modelComments->getAfew([
                    "post" => [
                        "operator" => "=",
                        "data" => $data['url'],
                        'conditions' => "AND"
                    ],
                    "user" => [
                        "operator" => "=",
                        "data" => $data['author'],
                    ],
                ]);
        if(!$post) {
           return false;
        }
        $modelPost->delate([
                        "url" => [
                        "operator" => "=",
                        "data" => $url,
                        ]
        ]);
        if($comments) {
            $modelComments->delate([
                "post" => [
                        "operator" => "=",
                        "data" => $url,
                ],

            ]);
        }
        return  true;

    }
}