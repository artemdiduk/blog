<?php

namespace App\Controllers;

use App\Interface\SaveFile;
use App\Models\ArticleModel;
use App\Models\GroupModel;
use Framework\src\Controller;

class CreateArticleController  extends Controller implements SaveFile
{
    public function page($data = null)
    {

        $modelArticle = new ArticleModel();
        $model = new GroupModel();
        $this->render([
            "data" => [
                'form-add-post' => [
                    'group' => $model->get(),
                    'errorPost' => $this->CreatePost(
                        [
                            'name' => trim(preg_replace('/[^\S\r\n]+/', ' ', @$_POST['name'])),
                            'url' => @$_POST['group'] . '/' . $this->urlConvert(@$_POST['name']),
                            'group' => @$_POST['group'],
                            'img' => @$_FILES['images'],
                            'text' => htmlspecialchars(trim(preg_replace('/[^\S\r\n]+/', ' ', @$_POST['description']))),
                        ],
                        $this->errorArray,
                        $modelArticle
                    ),
                ],
            ],
        ]);

        $this->layout('create-article');
    }

    public function saveImage($storage, $to , $file)
    {

        move_uploaded_file("$storage", "$to" . "$file");
    }

    public function CreatePost($data, $errorHendeler, $model)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $url = $data['url'];
            $name = $data['name'];
            $group = $data['group'];
            if (empty($model->getAfew(
                [
                    "name" => [
                        "operator" => "=",
                        "data" => $name,
                        'conditions' => "AND"
                    ],
                    "url" => [
                        "operator" => "=",
                        "data" => $url,
                    ],
                ]
                
            ))) {
                $name = (strlen($name) <= 200) ? $name : $errorHendeler[] = "У названии темы не должно быть больше 200 символов.";
                $text = (!$this->checkText($data['text'])) ? $errorHendeler[] = 'Текста должно быть не больше 3000 символов.' : $this->checkText($data['text']);
                $img = $this->validateImg($data['img'], 3145728, "image/png, image/jpeg", $url, '/Applications/MAMP/htdocs/blog/app/public/img/post/' );
                session_start();
                if (is_array($img)) {
                    $errorHendeler[] = $img['error'];
                }
                if (!empty($errorHendeler)) {
                    return $errorHendeler;
                }
                $this->create([
                    "data" => [
                        "name" =>  $name,
                        "url" =>  $url,
                        "text" => $text,
                        'img' => $img,
                        'group' => $group,
                        'author' => $_SESSION['login'],
                    ],
                    "model" => $model,
                ],
                true);
                self::redirect("/blog/$url");
            }
            else {
                $errorHendeler[] = 'Такая статья существует';
                return $errorHendeler;
            }

        }

    }

   

}
