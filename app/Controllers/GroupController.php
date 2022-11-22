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
                    "article" => $model->getUnique(['group' => $data], true),
                    "name-categor" => $modelGroup->getUnique(['url' => $data], false),
                ]
            ],
        ]);

        $this->layout('group');
    }
}
