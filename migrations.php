<?php

use App\core\App;

include_once "vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dir = dirname(__DIR__);
$config=[
    'userClass' => \App\model\RegisterModel::class,
    'db'=>[

        'dsn'=>$_ENV['DB_DSN']  ,
        'user'=>$_ENV['DB_USER'],
        'pass'=>$_ENV['DB_PASS']

      ]
    ];
$app = new App($dir,$config);


$app->db->appliyM();
