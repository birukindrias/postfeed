<?php 
namespace App\core\Middleware;

use App\core\App;
// use App\core\Middleware\BaseMiddleware;
use App\core\Exption\ForbiddenExeption;

class AuthMiddleware extends BaseMiddleware
{
    public array $action =[];
    public function __construct(array $action =[]) {
        $this->action = $action;
    }
    public function  execute()
    {
        if (!App::$app->isGuest()) {
        if (!empty($action) || in_array(App::$app->controller->action,$this->action)) {
            throw new ForbiddenExeption();
        }
    } if (App::$app->isGuest()) {
        if (!empty($action) || in_array(App::$app->controller->action,$this->action)) {
            throw new ForbiddenExeption();
        }
    }
        
    }
//     add controller to app
// mak ForbiddenExeption
// bootstrap
}?>