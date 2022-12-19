<?php
namespace Framework\posts;
use Framework\storage\Storage;

class CreaterPost
{   
    private $storage;
    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }
    public function createPost($data, $model, $error, $helper) {
    
        $name = trim(preg_replace('/[^\S\r\n]+/', ' ', $data['name']));
        $group = $data['group'];
        $url = $group . '/' . $helper::urlConvert($name);
        $text = $data['text'];
        $img = $data['img'];
        if($model->getPostUrl('url', $url)->get()) {
            $error::setError('Такая статья существует');
            return false;
        }
        if(strlen($name) >= 200) {
            $error::setError("У названии темы не должно быть больше 200 символов.");
        }
        if(strlen($text) >= 3000) {
            $error::setError('Текста должно быть не больше 3000 символов.');
        }
        if(!$helper::validateImg($img, 3145728, "image/png, image/jpeg")) {
            return  false;
        }
        if(empty($error::getError())){
            session_start();
            $model->createPost([
                'name' => $name,
                'url' => $url,
                'text' =>  $helper::parseToHtmlText($text),
                'group' => $group,
                'author' => $_SESSION['login']['slug'],
                'img' => $this->storage->saveImage($img, $url),
            ]);

            return true;
        }
        return  false;

    }


}
