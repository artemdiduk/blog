<?php

namespace App\Controllers;

use App\Models\CommentsModel;
use Framework\src\Controller;
use App\Models\ArticleModel;
use App\Models\GroupModel;
class ArticleController extends Controller
{
    private $group;
    private $article;
    private $comments;
    public function __construct(GroupModel $group, ArticleModel $article, CommentsModel $comments)
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
                'post' => $this->article->getAfew('url', $data)->get(false),
                'coments-form' => $this->article->getAfew('url', $data, '=')->get(false),
                'comments' => $this->comments->getAfew('post', $data, '=')->get(),
                'upadate-post-form' => [
                    "post" => $this->article->getAfew('url', $data, '=')->get(),
                    'group' => $this->group->get()
                    ]
                ,
            ],
        ]);
        $this->layout('article');

    }

}
