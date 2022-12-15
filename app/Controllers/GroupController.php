<?php
namespace App\Controllers;
use Framework\src\Controller;
use App\Models\ArticleModel;
use App\Models\GroupModel;
use Framework\src\Database;

class GroupController extends Controller
{
    private $group;
    private $article;
    public function __construct(GroupModel $group, ArticleModel $article)
    {
        $this->group = $group;
        $this->article = $article;
    }
    public function getArticle()
    {
        return $this->article;
    }
    public function getGroup() {
        return $this->group;
    }
    public function page($data = null)
    {
       
        $this->render([
            "data" => [
                'article-theme' => [
                    "article" => $this->article->getAfew('group', $data, '=')->get(),
                    "name-categor" => $this->group->getAfew('url', $data, '=')->get(false),
                ]
            ],
        ]);

        $this->layout('group');
    }
}
