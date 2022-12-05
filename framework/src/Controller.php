<?php

namespace Framework\src;
use App\Service\Helper;
use Framework\auth\Auth;
abstract class Controller
{
    public static function redirect($page)
    {
        header("Location: $page");
    }

    protected  function  render($arr)
    {
        if(!isset($_SESSION))
        {
            session_start();
        }
        Helper::$isLogin = Auth::user();
        foreach ($arr as $datas) {
            Helper::$data = $datas;
        }
    }

    protected function layout($layout)
    {
        
        require_once __DIR__  . "/../../resources/layout/{$layout}.php";
    }
    
}
