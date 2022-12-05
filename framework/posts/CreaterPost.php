<?php
namespace Framework\posts;
use App\Interface\SaveFile;
use Framework\ErrorReporting\Error;
use Framework\posts\CreatorMedhodHepler;
use Framework\services\Services;
use App\Models\ArticleModel;
class CreaterPost
{
    public function createPost($data, $path) {
        $name = trim(preg_replace('/[^\S\r\n]+/', ' ', $data['name']));
        $group = $data['group'];
        $url = $group . '/' . CreatorMedhodHepler::urlConvert($name);
        $text = $data['text'];
        $img = $data['img'];
        $modePost = new ArticleModel();
        if($modePost->getUnique(["url" => $url], true)) {
            Error::setError('Такая статья существует');
            return false;
        }
        if(strlen($name) >= 200) {
            Error::setError("У названии темы не должно быть больше 200 символов.");
        }
        if(strlen($text) >= 3000) {
            Error::setError('Текста должно быть не больше 3000 символов.');
        }
        if(!CreatorMedhodHepler::validateImg($img, 3145728, "image/png, image/jpeg")) {
            return  false;
        }
        if(empty(Error::getError())){
            session_start();
            $modePost->create(
                [
                    'name' => $name,
                    'url' => $url,
                    'text' => CreatorMedhodHepler::parseToHtmlText($text),
                    'group' => $group,
                    'author' => $_SESSION['login']['slug'],
                    'img' => Services::saveImage($img, $url, $path),
                ]
            );
            return true;
        }
        return  false;

    }


}