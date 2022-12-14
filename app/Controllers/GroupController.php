<?php
namespace App\Controllers;
use Framework\src\Controller;
use App\Models\ArticleModel;
use App\Models\GroupModel;

class GroupController extends Controller
{
    public function page($data = null)
    {
        $model = new ArticleModel();
        $modelGroup = new GroupModel();
      
        $this->render([
            "data" => [
                'article-theme' => [
                    "article" => $model->getAfew('group', $data, '=')->get(),
                    "name-categor" => $modelGroup->getAfew('url', $data, '=')->get(false),
                ]
            ],
        ]);

        $this->layout('group');
    }
}
