<?php
namespace App\Controllers;
use App\Models\ArticleModel;

use App\Models\CommentsModel;
use Framework\src\Controller;

class DelateConroller extends Controller
{
    public function page($data = null) {
        session_start();
        $modelArticle = new ArticleModel();
        $modelComments = new CommentsModel();
        $this->delate([
            'url' => @$_POST['post'],
            'author' => @$_SESSION['login'],
        ],
            $modelArticle,
            $modelComments,
        );

    }
    protected  function delate($data, $modelPost, $modelComments) {
        $categor = explode('/', $data['url'])[0];
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($modelPost->getAfew(
                [
                    "url" => [
                        "operator" => "=",
                        "data" => $data['url'],
                        'conditions' => "AND"
                    ],
                    "author" => [
                        "operator" => "=",
                        "data" => $data['author'],
                    ],
                ]
            ))) {
                $modelPost->delate([
                    "url" => [
                        "operator" => "=",
                        "data" => $data['url'],
                        'conditions' => "AND"
                    ],
                    "author" => [
                        "operator" => "=",
                        "data" => $data['author'],
                    ],
                ]);
                $modelComments->delate([
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
            }
        }
        self::redirect("/blog/$categor");

    }
}