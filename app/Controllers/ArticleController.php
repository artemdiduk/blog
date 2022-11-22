<?php

namespace App\Controllers;

use App\Models\CommentsModel;
use Framework\src\Controller;
use App\Models\ArticleModel;
use App\Models\GroupModel;
class ArticleController extends Controller
{
    public function page($data = null) {
        $modelArticle = new ArticleModel();
        $modelComents = new CommentsModel();
        $modelGrup = new GroupModel();
        $this->render([
            "data" => [
                'post' => $modelArticle->getUnique(['url' => $data], false),
                'coments-form' => $modelArticle->getUnique(['url' => $data], false),
                'comments' => $modelComents->getUnique(['post' => $data], true),
                'upadate-post-form' => [
                    "post" => $modelArticle->getUnique(['url' => $data], false),
                    'group' => $modelGrup->get()
                    ]
                ,
            ],
        ]);

        $this->layout('article');

    }

}
