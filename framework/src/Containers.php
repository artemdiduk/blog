<?php
namespace Framework\src;
use App\Controllers\ArticleController;
use App\Controllers\CreateArticleController;
use App\Controllers\CreateGroupController;
use App\Models\ArticleModel;
use App\Models\CommentsModel;
use App\Models\GroupModel;
use App\Controllers\CreteCommentController;
use App\Controllers\DelateConroller;
use App\Controllers\GroupController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\RegisterationController;
use App\Controllers\UpdatePostConroller;
use App\Models\UserModel;
use Framework\auth\Auth;
use Framework\ErrorReporting\Error;
use Framework\posts\Creater;
use Framework\posts\CreaterPost;
use Framework\posts\CreatorMedhodHepler;
use Framework\posts\UpdatePost;
use Framework\storage\Storage;
class Containers {
    public $controllers = [];

    public function __construct() 
    {
        $this->controllers['ArticleController'] = new ArticleController(
            new GroupModel(
                new Database()
            ),
            new ArticleModel(
                new Database()
            ),
            new CommentsModel(
                new Database()
            )
        );
        $this->controllers['CreateArticleController'] = new CreateArticleController(
            new GroupModel(
                new Database()
            ),
            new ArticleModel(
                new Database()
            ),
            new Error(),
            new Creater(),
            new Storage(CreaterPost::class),
            new CreatorMedhodHepler()
        );
        $this->controllers['GroupController'] = new GroupController(
            new GroupModel(
                new Database()
            ),
            new ArticleModel(
                new Database()
            ),
        );
        $this->controllers['HomeController'] = new HomeController(
            new GroupModel(
                new Database()
            ),
        );
        $this->controllers['CreateGroupController'] = new CreateGroupController(
            new GroupModel(
                new Database()
            ),
            new Creater(),
            new CreatorMedhodHepler()
        );
        $this->controllers['CreteCommentController'] = new CreteCommentController(
            new CommentsModel(
                new Database()
            ),
            new Creater(),
            new Storage(CreteComment::class),
            new CreatorMedhodHepler()
        );
        $this->controllers['DelateConroller'] = new DelateConroller(
            new ArticleModel(
                new Database()
            ),
            new CommentsModel(
                new Database()
            ),
            new Creater(),

        );
        $this->controllers['LoginController'] = new LoginController(
            new UserModel(
                new Database()
            ),
            new Error(),
            new Auth()
        );
        $this->controllers['RegisterationController'] = new RegisterationController(
            new UserModel(
                new Database() 
            ),
            new Error(),
            new Auth()
        );
        $this->controllers['UpdatePostConroller'] = new UpdatePostConroller(
            new ArticleModel(
                new Database()
            ),
            new CommentsModel(
                new Database()
            ),
            new Creater(),
            new Storage(UpdatePost::class),
            new CreatorMedhodHepler(),
            new Error()
        );
    }
}

?>
