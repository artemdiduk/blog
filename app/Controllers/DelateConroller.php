<?php
namespace App\Controllers;
use App\Models\ArticleModel;
use App\Models\CommentsModel;
use Framework\src\Controller;
use Framework\posts\Creater;


class DelateConroller extends Controller
{
    private $post;
    private $comments;
    private $delate;
    public function __construct(ArticleModel $post, CommentsModel $comments, Creater $delate)
    {
        $this->post = $post;
        $this->comments= $comments;
        $this->delate = $delate;
    }
    public function page($data = null)
    {
        session_start();
        $this->delate::delatePost([
            'url' => @$_POST['post'],
            'author' => @$_SESSION['login']['slug'],
        ],
        $this->post,
        $this->comments,
        );
        $categor = explode('/', @$_POST['post'])[0];
        self::redirect("/blog/$categor");

    }
}

