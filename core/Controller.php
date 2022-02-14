<?php
namespace App\core;

use App\core\App;
use App\core\Middleware\BaseMiddleware;
use App\core\Middleware\AuthMiddleware;

class Controller
{
    public string $action = "";
    public array $middlewares = [];

    public function __construct() {
        if (!App::$app->isGuest()) {
            $this->regM(new AuthMiddleware(['pro']));

        }
        elseif (App::$app->isGuest()) {
            $this->regM(new AuthMiddleware(['sign','log']));
        }
    }
    public function render($view, $params = [] ?? null)
    {
        $layout=$this->layout();
        $cont=$this->cont($view, $params);

        return str_replace("{cont}", $cont, $layout);
    }

    public function layout()
    {
        ob_start();
        include_once App::$dir."/views/layout/main.php";
        return ob_get_clean();
    }

    public function cont($view, $params = [] ?? null)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once App::$dir."/views/$view.php";
        return ob_get_clean();
    }
    public function regM(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * Get the value of middlewares
     */ 
    public function getMiddlewares()
    {
        return $this->middlewares;
    }

    /**
     * Set the value of middlewares
     *
     * @return  self
     */ 
    public function setMiddlewares($middlewares)
    {
        $this->middlewares = $middlewares;

        return $this;
    }
}
