<?php
namespace App\core;

class Router
{
    public Request $request;
    public function __construct()
    {
        $this->request = new Request;
    }
    public function get($rout, $callback)
    {
        $this->routes['get'][$rout]=$callback;
    }
    public function post($rout, $callback)
    {
        $this->routes['post'][$rout]=$callback;
    }
    public function resolve()
    {
        $rout=$this->request->path();
        $method=$this->request->method();

        $callback=$this->routes[$method][$rout];
        /**
         * @var \App\core\Controller $controller
         */
        $controller = new $callback[0]();
        App::$app->controller =$controller;
        $controller->action=$callback[1];
        $callback[0]=$controller;
        foreach ($controller->getMiddlewares() as $key) {
            $key->execute();
        }
        return call_user_func($callback);
    }
}
