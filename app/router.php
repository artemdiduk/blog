<?php
use Framework\Router;
use Framework\src\Containers;
$containers = new Containers();
$routs = new Router();
$routs->setRout('/', $containers->controllers['HomeController']);
$routs->setRout('registration', $containers->controllers['RegisterationController']);
$routs->setRout('login', $containers->controllers['LoginController']);
$routs->setRout('group', $containers->controllers['GroupController']);
$routs->setRout('group/create', $containers->controllers['CreateGroupController']);
$routs->setRout('create/article', $containers->controllers['CreateArticleController']);
$routs->setRout('сomment/create', $containers->controllers['CreteCommentController']);
$routs->setRout('delate/post', $containers->controllers['DelateConroller']);
$routs->setRout('update/post', $containers->controllers['UpdatePostConroller']);
$routs->modelParse([
    "controller" => $containers->controllers['GroupController'],
    'models' => $containers->controllers['GroupController']->getGroup(),
    'read' => "url",
]);
$routs->modelParse([
    "controller" => $containers->controllers['ArticleController'],
    'models' => $containers->controllers['ArticleController']->getArticle(),
    'read' => "url",
]);
