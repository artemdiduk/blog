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
                            'oldUrl' => @$_POST['old-url'],
                            'group' => @$_POST['group'],
                            'img' => @$_FILES['images'],
                            'author' => $_SESSION['login'],
                            'id' => @$_POST['id'],
                            'text' => htmlspecialchars(trim(preg_replace('/[^\S\r\n]+/', ' ', @$_POST['description']))),
                        ],
                        $this->errorArray,
                        $modelArticle,
                        $modelComents,
                    ),
                ],
            ],
        ]);
    }
    public function updatePost($data, $errorHendeler, $modelArticle, $modelComents)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $validator = true;
            $post =  $modelArticle->getAfew(
                [
                    "id" => [
                        "operator" => "=",
                        "data" => $data['id'],
                        'conditions' => "AND"
                    ],
                    "author" => [
                        "operator" => "=",
                        "data" => $data['author'],
                    ],
                ],
                false
            );
            if($data['url'] != $data['oldUrl']) {
                $validator  = $modelArticle->getAfew(
                [
                    "url" => [
                        "operator" => "=",
                        "data" => $data['url'],
                    ],
                ],
                );
            }
            if ($post && is_array($validator) == false) {
                $name = (strlen($data['name']) <= 200) ? ['name' => $data['name']] : $errorHendeler[] = "У названии темы не должно быть больше 200 символов.";
                $text = (!$this->checkText($data['text'])) ? $errorHendeler[] = 'Текста должно быть не больше 3000 символов.' : $this->checkText($data['text']);
                $textUpdate = ['text' => $text];
                $group = ['group' => $data['group']];
                $url = ['url' => $data['url']];
                $img = ['img' => $post['img']];
                if($data['img']['full_path'] != '') {
                    $img = ['img' => $this->validateImg($data['img'], 3145728, "image/png, image/jpeg", $data['url'], $this->saveArticleImgPath)];
                }
                if (!empty($errorHendeler)) {
                   self::redirect("/blog/{$data['url']}");
                }
                $this->isUpdataLoneliness($data['oldUrl'], $data['url'], [$modelComents], 'post');
                $this->isUpdata([$name, $textUpdate, $group, $url, $img], $modelArticle, $data['id']);
                self::redirect("/blog/{$data['url']}");
                
            } 
            else {
                self::redirect("/blog/{$data['url']}");
            }
        }
        self::redirect("/blog/{$data['url']}");
       
    }
   
    
}
