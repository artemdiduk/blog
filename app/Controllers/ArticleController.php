<?php

namespace App\Controllers;

use Framework\src\Controller;
use App\Repository\ArticleRepository;
use App\Repository\CommentsRepository;
use App\Repository\GroupRepository;

class ArticleController extends Controller
{
    private $group;
    private $article;
    private $comments;
    public function __construct(GroupRepository $group, ArticleRepository $article, CommentsRepository $comments)
    {
        $this->group = $group;
        $this->article = $article;
        $this->comments = $comments;
      
    }
    public function getArticle()
    {
        return $this->article;
    }
    public function getGroup()
    {
        return $this->group;
    }
    public function getComments()
    {
        return $this->comments;
    }
    public function page($data = null) {
        $this->render([
            "data" => [
                'post' => $this->article->getPostUrl('url', $data)->get(false),
                'coments-form' => $this->article->getPostUrl('url', $data)->get(false),
                'comments' => $this->comments->getCommentsPost('post', $data)->get(),
                'upadate-post-form' => [
                    "post" => $this->article->getPostUrl('url', $data)->get(),
                    'group' => $this->group->getAll()
                    ]
                ,
            ],
        ]);
        $this->layout('article');

    }

}
