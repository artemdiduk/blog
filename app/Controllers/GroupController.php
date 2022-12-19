<?php
namespace App\Controllers;
use Framework\src\Controller;
use App\Repository\ArticleRepository;
use App\Repository\GroupRepository;

class GroupController extends Controller
{
    private $group;
    private $article;
    public function __construct(GroupRepository $group, ArticleRepository $article)
    {
        $this->group = $group;
        $this->article = $article;
    }
    
    public function getGroup() {
        return $this->group;
    }
    public function page($data = null)
    {
       
        $this->render([
            "data" => [
                'article-theme' => [
                    "article" => $this->article->getPostGroup('group', $data)->get(),
                    "name-categor" => $this->group->getGroupUrl('url', $data)->get(false),
                ]
            ],
        ]);

        $this->layout('group');
    }
}
