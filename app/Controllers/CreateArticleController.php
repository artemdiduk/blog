<?php
namespace App\Controllers;

use App\Repository\ArticleRepository;
use App\Repository\GroupRepository;
use Framework\src\Controller;
use Framework\ErrorReporting\Error;
use Framework\posts\Creater;
use Framework\posts\CreatorMedhodHepler;
use Framework\storage\Storage;
class CreateArticleController extends Controller
{
    private $group;
    private $article;
    private $errorHendler;
    private $createPost;
    private $storage;
    private $createrHelper;
    public function __construct(
    GroupRepository $group,
    ArticleRepository $article, 
    Error $errorHendler,
    Creater $createPost, 
    Storage $storage,
    CreatorMedhodHepler $createrHelper
    )
    {
        $this->group = $group;
        $this->createPost= $createPost;
        $this->errorHendler = $errorHendler;
        $this->article = $article;
        $this->storage = $storage;
        $this->createrHelper = $createrHelper;
    }
    public function page($data = null)
    {
        $redirect =  @$_POST['group']. '/' . CreatorMedhodHepler::urlConvert(@$_POST['name']);
        $this->render([
            "data" => [
                'form-add-post' => [
                    'group' => $this->group->getAll(),
                    'errorPost' =>
                        $this->errorHendler::isError(
                        $this->createPost::acceptCreatePost(
                            [
                                'name' =>  @$_POST['name'],
                                'url' => @$_POST['url'],
                                'group' => @$_POST['group'],
                                'img' => @$_FILES['images'],
                                'text' =>  @$_POST['description'],
                            ],
                            $this->article,
                            $this->storage,
                            $this->errorHendler,
                            $this->createrHelper
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
