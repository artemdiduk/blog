<?php

namespace App\Controllers;

use App\Models\CommentsModel;
use Framework\src\Controller;
use Framework\posts\Creater;
class CreteCommentController extends Controller
{
    public function page($data = null) {
        session_start();
        Creater::acceptCreateComment([
            'nameUser' => $_SESSION['login']['slug'],
            'text' => @$_POST['text'],
            'post' => @$_POST['post'],
            'img' => @$_FILES['images'],
        ],
        );
        $post =  @$_POST['post'];
        self::redirect("/blog/$post");
    }
}
