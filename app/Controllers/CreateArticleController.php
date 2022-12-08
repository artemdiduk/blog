<?php

namespace App\Controllers;
use App\Models\ArticleModel;
use App\Models\GroupModel;
use Framework\src\Controller;
use Framework\ErrorReporting\Error;
use Framework\posts\Creater;
use Framework\posts\CreatorMedhodHepler;
class CreateArticleController extends Controller
{
    public function page($data = null)
    {
        $model = new GroupModel();
        $redirect =  @$_POST['group']. '/' . CreatorMedhodHepler::urlConvert(@$_POST['name']);
        $this->render([
            "data" => [
                'form-add-post' => [
                    'group' => $model->get(),
                    'errorPost' =>
                        Error::isError(
                        Creater::acceptCreatePost(
                            [
                                'name' =>  @$_POST['name'],
                                'url' => @$_POST['url'],
                                'group' => @$_POST['group'],
                                'img' => @$_FILES['images'],
                                'text' =>  @$_POST['description'],
                            ],
                        ),
                        "POST",
                        "/blog/$redirect"
                    ),
                ],
            ],
        ]);
        $this->layout('create-article');
    }


}
