<?php

use App\core\App;
use App\controller\siteController;
// echo "<pre>";
include_once "../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$config=[
    'userClass' => \App\model\user::class,
    'db'=>[

        'dsn'=>$_ENV['DB_DSN']  ,
        'user'=>$_ENV['DB_USER'],
        'pass'=>$_ENV['DB_PASS']

      ]
      
    ];
$dir = dirname(__DIR__);
$app = new App($dir,$config);

$app->router->get('/',[siteController::class,'home']);
$app->router->get('/signup',[siteController::class,'sign']);
$app->router->post('/signup',[siteController::class,'sign']);

$app->router->get('/login',[siteController::class,'log']);
$app->router->post('/login',[siteController::class,'log']);

$app->router->get('/logout',[siteController::class,'logout']);
$app->router->get('/pro',[siteController::class,'pro']);
$app->run();
