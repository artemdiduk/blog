<?php
namespace App\Controllers;

use Framework\ErrorReporting\Error;
use Framework\posts\Creater;
use Framework\posts\CreatorMedhodHepler;
use Framework\src\Controller;
class UpdatePostConroller extends Controller
{
    public function page($data = null)
    {
        session_start();
        $redirect =  @$_POST['group']. '/' . CreatorMedhodHepler::urlConvert(@$_POST['name']);
        $this->render([
            "data" => [
                'upadate-post-form' => [
                    'errorPost' =>
                        Error::isError(
                            Creater::acceptUpdatePost(
                                [
                                    'name' =>  @$_POST['name'],
                                    'url' => @$_POST['url'],
                                    'group' => @$_POST['group'],
                                    'img' => @$_FILES['images'],
                                    'text' =>  @$_POST['description'],
                                    'id' => @$_POST['id'],
                                    'author' => $_SESSION['login']['slug'],
                                    'oldUrl' => @$_POST['old-url'],
                                ],
                                "/Applications/MAMP/htdocs/blog/app/public/img/post/"
                            ),
                            "POST",
                            "/blog/$redirect",
                            true,
                        ),
                ],
            ],
        ]);
    }

}
