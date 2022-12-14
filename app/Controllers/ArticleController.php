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
                'post' => $modelArticle->getAfew('url', $data, '=')->get(false),
                'coments-form' => $modelArticle->getAfew('url', $data, '=')->get(false),
                'comments' => $modelComents->getAfew('post', $data, '=')->get(),
                'upadate-post-form' => [
                    "post" => $modelArticle->getAfew('url', $data, '=')->get(),
                    'group' => $modelGrup->get()
                    ]
                ,
            ],
        ]);
        $this->layout('article');

    }

}
