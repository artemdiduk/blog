<?php

namespace App\Controllers;

use App\Interface\SaveFile;
use App\Models\ArticleModel;
use App\Models\CommentsModel;
use App\Models\GroupModel;
use Framework\src\Controller;

class UpdatePostConroller extends Controller implements SaveFile
{
    public function page($data = null)
    {
        $modelArticle = new ArticleModel();
        $modelComents = new CommentsModel();
        session_start();
        $this->render([
            "data" => [
                'upadate-post-form' => [
                    'errorPost' => $this->updatePost(
                        [
                            'name' => trim(preg_replace('/[^\S\r\n]+/', ' ', @$_POST['name'])),
                            'url' => @$_POST['group'] . '/' . $this->urlConvert(@$_POST['name']),
                            'group' => @$_POST['group'],
                            'img' => @$_FILES['images'],
                            'author' => $_SESSION['login'],
                            'text' => htmlspecialchars(trim(preg_replace('/[^\S\r\n]+/', ' ', @$_POST['description']))),
                            'id' => @$_POST['id'],
                        ],
                        $this->errorArray,
                        $modelArticle,
                        $modelComents,
                    ),
                ],
            ],
        ]);
    }
    public function updatePost($data, $errorHendeler, $modelArticle, $modelComments) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $url = $data['url'];
            $name = $data['name'];
            $group = $data['group'];
            $author = $data['author'];
            $text = $data['text'];
            $id = $data['id'];
            $post =  $modelArticle->getAfew(
                [
                    "id" => [
                        "operator" => "=",
                        "data" => $id,
                        'conditions' => "AND"
                    ],
                    "author" => [
                        "operator" => "=",
                        "data" => $author,
                    ],
                ],

            );
            if($res = $post[0]) {
                $post = $post[0];
               if($post['name'] != $name) {
                   $nameUpdate = (strlen($name) <= 200) ? $name : $errorHendeler[] = "У названии темы не должно быть больше 200 символов.";

               }
               if($post['group'] != $group) {
                    $groupUpdate = $group;
               }
               $textUpdate = (!$this->checkText($text)) ? $errorHendeler[] = 'Текста должно быть не больше 3000 символов.' : $this->checkText($text);
               dd($nameUpdate, $groupUpdate, $textUpdate);

            }
        }
    }
}
