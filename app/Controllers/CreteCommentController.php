<?php

namespace App\Controllers;

use App\Models\CommentsModel;
use App\Repository\CommentsRepository;
use Framework\src\Controller;
use Framework\posts\Creater;
use Framework\storage\Storage;
use Framework\posts\CreatorMedhodHepler;
class CreteCommentController extends Controller
{
    private $comments;
    private $createComment;
    private $storage;
    private $createrHelper;
    public function __construct(
        CommentsRepository $comments,
        Creater $createComment,
        Storage $storage,
        CreatorMedhodHepler $createrHelper
    ) {
        $this->comments = $comments;
        $this->createComment = $createComment;
        $this->storage = $storage;
        $this->createrHelper = $createrHelper;
    }
    public function page($data = null) {
        session_start();
        $this->createComment::acceptCreateComment([
            'nameUser' => $_SESSION['login']['slug'],
            'text' => @$_POST['text'],
            'post' => @$_POST['post'],
            'img' => @$_FILES['images'],
        ],
            $this->comments,
            $this->storage,
            $this->createrHelper
        );
        $post =  @$_POST['post'];
        self::redirect("/blog/$post");
    }
}
