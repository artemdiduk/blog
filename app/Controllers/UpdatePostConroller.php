<?php
namespace App\Controllers;
use App\Repository\ArticleRepository;
use App\Repository\CommentsRepository;
use Framework\ErrorReporting\Error;
use Framework\src\Controller;
use Framework\posts\Creater;
use Framework\posts\CreatorMedhodHepler;
use Framework\storage\Storage;
class UpdatePostConroller extends Controller
{
   
    private $article;
    private $comments;
    private $errorHendler;
    private $updatePost;
    private $storage;
    private $createrHelper;
    public function __construct(
        ArticleRepository $article,
        CommentsRepository $comments,
        Creater $updatePost,
        Storage $storage,
        CreatorMedhodHepler $createrHelper,
        Error $errorHendler
    ) {
        $this->updatePost = $updatePost;
        $this->article = $article;
        $this->comments = $comments;
        $this->storage = $storage;
        $this->createrHelper = $createrHelper;
        $this->errorHendler =  $errorHendler;
    }
    public function page($data = null)
    {
        session_start();
        $redirect =  @$_POST['group']. '/' . $this->createrHelper::urlConvert(@$_POST['name']);
        $this->render([
            "data" => [
                'upadate-post-form' => [
                    'errorPost' =>
                        $this->errorHendler::isError(
                            $this->updatePost::acceptUpdatePost(
                                [
                                    'name' =>  @$_POST['name'],
                                    'url' => @$_POST['url'],
                                    'group' => @$_POST['group'],
                                    'img' => @$_FILES['images'],
                                    'text' =>  @$_POST['description'],
                                    'id' => @$_POST['id'],
                                    'author' => $_SESSION['login']['slug'],
                                    'oldUrl' => @$_POST['old-url'],
                                ],
                                $this->article,
                                $this->comments,
                                $this->storage,
                                $this->createrHelper
                            ),
                            "POST",
                            "/blog/$redirect",
                            true,
                        ),
                ],
            ],
        ]);
    }

}
