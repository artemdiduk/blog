<?php
namespace App\Controllers;
use App\Models\ArticleModel;

use App\Models\CommentsModel;
use Framework\src\Controller;
use Framework\posts\Creater;
class DelateConroller extends Controller
{
    public function page($data = null)
    {
        session_start();
        Creater::delatePost([
            'url' => @$_POST['post'],
            'author' => @$_SESSION['login']['slug'],
        ]);
        $categor = explode('/', @$_POST['post'])[0];
        self::redirect("/blog/$categor");

    }
}

