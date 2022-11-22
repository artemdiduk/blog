<?php
use Framework\Router;
use App\Controllers\HomeController;
use App\Controllers\RegisterationController;
use App\Controllers\LoginController;
use App\Controllers\GroupController;
use App\Controllers\CreateArticleController;
use App\Controllers\CreateGroupController;
use App\Models\GroupModel;
use App\Models\ArticleModel;
use App\Controllers\ArticleController;
use App\Controllers\CreteCommentController;
use App\Controllers\DelateConroller;
use App\Controllers\UpdatePostConroller;
$routs = new Router();
$routs->setRout('/', new HomeController());
$routs->setRout('registration', new RegisterationController());
$routs->setRout('login', new LoginController());
$routs->setRout('group', new GroupController());
$routs->setRout('group/create', new CreateGroupController());
$routs->setRout('create/article', new CreateArticleController());
$routs->setRout('сomment/create', new CreteCommentController());
$routs->setRout('delate/post', new DelateConroller());
$routs->setRout('update/post', new UpdatePostConroller());
$routs->modelParse([
    "controller" => new GroupController(),
    'models' => new GroupModel,
    'read' => "url",
]);
$routs->modelParse([
    "controller" => new ArticleController(),
    'models' => new ArticleModel(),
    'read' => "url",
]);