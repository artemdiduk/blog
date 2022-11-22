<?php

namespace App\Controllers;

use App\Models\CommentsModel;
use Framework\src\Controller;

class CreteCommentController extends Controller
{
    public function page($data = null) {
        session_start();
        $modelComments = new CommentsModel();
        $nameUser = $_SESSION['login'];
        $text =  htmlspecialchars(trim(preg_replace('/[^\S\r\n]+/', ' ', @$_POST['text'])));
        $post =  @$_POST['post'];
        $img = $this->validateImg(@$_FILES['images'], 3145728, "image/png, image/jpeg", $nameUser, '/Applications/MAMP/htdocs/blog/app/public/img/coments/');
        $commentsImg = (is_string($img) && $img != "") ?  $img : "";
        
        $this->create([
            "data" => [
                "user" => $nameUser,
                "text" => $text,
                'post' =>  $post,
                'img' => $commentsImg,
            ],
            "model" => $modelComments,
        ],
            true
        );
        self::redirect("/blog/$post");
    }
}
