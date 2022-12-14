<?php
namespace Framework\posts;
use Framework\ErrorReporting\Error;
use Framework\posts\CreatorMedhodHepler;
use Framework\storage\Storage;
use App\Models\ArticleModel;
class CreaterPost
{
    public function createPost($data) {
        $name = trim(preg_replace('/[^\S\r\n]+/', ' ', $data['name']));
        $group = $data['group'];
        $url = $group . '/' . CreatorMedhodHepler::urlConvert($name);
        $text = $data['text'];
        $img = $data['img'];
        $modePost = new ArticleModel();
        if($modePost->getAfew('url', $url, '=')->get()) {
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
            $storage = new Storage($this);
            $modePost->
            setCreate('name', $name)->
            setCreate('url', $url)->
            setCreate('text', CreatorMedhodHepler::parseToHtmlText($text))->
            setCreate('group', $group)->
            setCreate('author', $_SESSION['login']['slug'])->
            setCreate('img', $storage->saveImage($img, $url))->
            create();

            return true;
        }
        return  false;

    }


}
