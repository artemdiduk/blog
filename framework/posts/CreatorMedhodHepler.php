<?php

namespace Framework\posts;
use Framework\ErrorReporting\Error;
class CreatorMedhodHepler
{
    public static  function urlConvert($arg)
    {
        $arg = htmlspecialchars($arg);
        $from = array('а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я');
        $to = array('a', 'b', 'v', 'g', 'd', 'e', 'e', 'zh', 'z', 'i', 'i', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'kh', 'cz', 'ch', 'sh', 'shh', '', 'y', '', 'e', 'yu', 'ya', 'A', 'B', 'V', 'G', 'D', 'E', 'E', 'ZH', 'Z', 'I', 'I', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'KH', 'CZ', 'CH', 'SH', 'SHH', '', 'Y', '', 'E', 'YU', 'YA');
        $url =  strtolower(trim(preg_replace('/[^\S\r\n]+/', ' ', str_replace($from, $to, $arg))));
        $url = str_replace([',', "'", '""', '{}', ".", ':', ';', '\\', "«", "»"], '', $url);
        $url = str_replace(" ", '-', $url);
        return $url;
    }
    public static function validateImg($img, $size, $type)
    {
        if (@$img['size'] >= $size) {
            Error::setError("Не больше 3х мб картинка");
            return false;
        }
        $patt = preg_quote(@$img['type'], '~');
        if (!preg_match_all("~\w*$patt\w*~", $type)) {
            Error::setError("должна быть картинка jpg/png формата");
            return false;
        }
        return true;

    }
    public static function parseToHtmlText($text)
    {
        $html = [];
        foreach (explode(PHP_EOL, $text) as $row) {
            if (trim($row) != '') {
                $html[] = '<p>' . trim($row) . '</p>';
            }
        }
        return implode(PHP_EOL, $html);
    }
    public  static  function checkUrlDublicate($url, $urlSecond, $modelCheck) {
       if($url == $urlSecond) {
           return  true;
       }
      else if($modelCheck->getAfew('url', $url, '=')->get()) {
          return  false;
      }
      return  true;
    }
   

    
}
