<?php

namespace App\Service;

abstract class Helper
{
    public static $data;
    public static $view;
    public static $viewTemplate = [];
    public static $isLogin;
    


    public static function viewPlug($name, $catalog)
    {

        self::$viewTemplate = [
            $name => "/../../resources/view/{$catalog}/{$name}.php",
        ];
        self::getView(self::$viewTemplate);
    }
    public static function path()
    {
       
        return "/blog/app/public/";
    }
    public static  function getView($views)
    {
        foreach ($views as $viewName => $viewPath) {
            if (array_key_exists($viewName, self::$data)) {
                $data = self::$data[$viewName];
                require __DIR__ . $viewPath;
            } else {
                require __DIR__ . $viewPath;
            }
        }
    }
}
