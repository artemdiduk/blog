<?php
namespace App\Controllers;
use Framework\src\Controller;
use Framework\posts\Creater;
use App\Repository\ArticleRepository;
use App\Repository\CommentsRepository;

class DelateConroller extends Controller
{
    private $post;
    private $comments;
    private $delate;
    public function __construct(ArticleRepository $post, CommentsRepository $comments, Creater $delate)
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

