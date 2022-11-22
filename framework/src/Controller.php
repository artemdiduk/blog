<?php

namespace Framework\src;

use App\Interface\SaveFile;
use App\Service\Helper;

abstract class Controller implements SaveFile
{
    protected $errorArray = [];
    public static function redirect($page)
    {
        header("Location: $page");
    }

    protected  function  render($arr)
    {
        session_start();
        $this->isLogin('login');
        foreach ($arr as $datas) {
            Helper::$data = $datas;
        }
    }
    protected  function create($arr, $noCheck = false)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $model = $arr['model'];
            if($noCheck) {
                $model->create($arr['data']);
            }
            elseif (empty($model->getaFew($arr['check']))) {
                $model->create($arr['data']);
            }
        }
    }
    protected function layout($layout)
    {
        require_once __DIR__  . "/../../resources/layout/{$layout}.php";
    }
    protected function login($menthod, $model)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = trim($menthod['email']);
            $password = md5(trim($menthod['password']));
            if (isset($email) && isset($password)) {
                if (!empty($userArr = $model->getAfew(
                    [
                        "email" => [
                            "operator" => "=",
                            "data" => $email,
                            'conditions' => "AND"
                        ],
                        "password" => [
                            "operator" => "=",
                            "data" => $password,
                        ],

                    ]
                ))) {
                    foreach ($userArr as $user) {
                        $_SESSION['login'] = $user['name'];
                        self::redirect('blog/');
                    }
                }
                $this->errorArray[] = 'Неверные данные';
                return $this->errorArray;
            }
            $this->errorArray[] = 'Заполните все поля';
            return $this->errorArray;
        }
    }
    protected function registration($menthod, $model)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = strtolower(trim($menthod['name']));
            $email = trim($menthod['email']);
            $password = trim($menthod['password']);
            $slug = trim($menthod['name']);
            if (strlen($name) < 3 || ctype_digit($name)) {
                $this->errorArray[] = 'Некорректное  имя (Имя не должно состоять с цифр или имя меньшие трьох символов)';
            } else if (!empty($model->getUnique(["name" => $name], true))) {
                $this->errorArray[] = 'Такой узер уже єсть';
            }
            if (!isset($email)) {
                $this->errorArray[] = 'Заполните почту';
            } else if (!empty($model->getUnique(["email" => $email], true))) {
                $this->errorArray[] = 'Такая почта уже зарегестрируваная';
            }
            if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,16}$/", $password)) {
                $this->errorArray[] = 'Пароль минимум 6 символов, только лат. Буквы, с цифрами и одной заглавной';
            }
            if (empty($this->errorArray)) {
                $model->create(
                    [
                        "name" => $name,
                        'email' => $email,
                        "password" => md5($password),
                        "slug" => $slug
                    ]
                );
                self::redirect('login');
            }
            return $this->errorArray;
        }
    }
    protected function urlConvert($arg)
    {
        $arg = htmlspecialchars($arg);
        $from = array('а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я');
        $to = array('a', 'b', 'v', 'g', 'd', 'e', 'e', 'zh', 'z', 'i', 'i', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'kh', 'cz', 'ch', 'sh', 'shh', '', 'y', '', 'e', 'yu', 'ya', 'A', 'B', 'V', 'G', 'D', 'E', 'E', 'ZH', 'Z', 'I', 'I', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'KH', 'CZ', 'CH', 'SH', 'SHH', '', 'Y', '', 'E', 'YU', 'YA');
        $url =  strtolower(trim(preg_replace('/[^\S\r\n]+/', ' ', str_replace($from, $to, $arg))));
        $url = str_replace([',', "'", '""', '{}', ".", ':', ';', '\\', "«", "»"], '', $url);
        $url = str_replace(" ", '-', $url);
        return $url;
    }
    protected  function parseToHtmlText($text)
    {
        $html = [];
        foreach (explode(PHP_EOL, $text) as $row) {
            if (trim($row) != '') {
                $html[] = '<p>' . trim($row) . '</p>';
            }
        }
        return implode(PHP_EOL, $html);
    }
    private function isLogin($nameSession)
    {
        if (!empty($_SESSION[$nameSession])) {
            Helper::$isLogin = $_SESSION[$nameSession];
        }
    }
    public function validateImg($img, $size, $type, $name, $save)
    {
        if (empty($img['name'])) {
            return '';
        }
        if ($img['size'] >= $size) {
            return ['error' => "Не больше 3х мб"];
        }
        $patt = preg_quote($img['type'], '~');
        if (!preg_match_all("~\w*$patt\w*~", $type)) {
            return ['error' => 'должна быть картинка jpg/png формата'];
        }
        $nameImg = str_replace("/", "-", $name, $count);
        $extension = pathinfo($img['name'], PATHINFO_EXTENSION);
      
        $new_name = $nameImg . uniqid() . '.'  . $extension;
        $this->saveImage($img["tmp_name"], $save ,$new_name);
        return $new_name;

    }
    public function saveImage($storage, $to , $file)
    {

        move_uploaded_file("$storage", "$to" . "$file");
    }
    public function checkText($text)
    {
        if (strlen($text) <= 3000) {
            return $this->parseToHtmlText($text);
        } else {
            return  false;
        }
    }
}
