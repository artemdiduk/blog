<?php

namespace Framework\ErrorReporting;

class Error
{
    private static $errorHendeler = [];
   
    public static function setError($mesage)
    {
        self::$errorHendeler[] = $mesage;
    }
    public static function getError()
    {
        return self::$errorHendeler;
    }
    public static function isError($data, $method, $page = null, $notErrorHendeler = false)
    {
        if ($_SERVER["REQUEST_METHOD"] == $method) {
            if($notErrorHendeler && !$data) {
                header("Location: $page");
            }
            if (!$data) {
                return self::$errorHendeler;
            }

            header("Location: $page");
        }
    }
}
