<?php

namespace Framework\src;

use App\Interface\SaveFile;
use App\Service\Helper;
use Framework\auth\Auth;
abstract class Controller implements SaveFile
{   
    public $saveArticleImgPath = 'C:/xampp/htdocs/blog/app/public/img/post/';
    public $saveCommentsImgPath =  'C:/xampp/htdocs/blog/app/public/img/comments/';
    protected $errorArray = [];
    public static function redirect($page)
    {
        header("Location: $page");
    }

    protected  function  render($arr)
    {    
        session_start();
        Helper::$isLogin = Auth::user();
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
    public function isUpdataLoneliness($elementOld, $elementNew, $models, $what)
    {
        foreach ($models as $model) {
            $model->updateLoneliness($elementNew, $elementOld, $what);
        }
    }
    public function isUpdata($arr, $modelArticle, $id)
    {
        $modelArticle->update($arr, $id);
    }
    
}
