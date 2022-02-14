<?php
namespace App\core;

use App\core\Router;
use App\core\Request;
use App\core\Session\Session;

class App
{
    public Router $router;
    public Request $request;
public ?dbModel $user;
public Controller $controller;


    public static $app;
    public string $userClass;

    public Session $session;

    public db $db;


    public static $dir;


    public function __construct($dir,$config)
    {
        $this->userClass = $config['userClass'];

        self::$app=$this;
        self::$dir=$dir;
        $this->request = new Request;
        $this->session = new Session;

        $this->db = new db($config['db']);

        $this->router = new Router;

        $val = $this->session->get('user') ?? false;
        if ($val) {
            $key =$this->userClass::primary_key();
            $this->user = $this->userClass::findOne([$key =>$val]);
        }else{
            $this->user = null;
        }
    }




    public function isGuest()
    {
       return $this->user;
    }

    public function login(dbModel $user)
    {
        $this->user =$user;
        $key =$user->primary_key();
        $val =$user->{$key};
        $this->session->set('user',$val);
    return true;
    }
    public function logout()
    {
       
        return $this->session->remove('user');
    }
    public function run()
    {
        try {
            echo $this->router->resolve();

        } catch (\Exception $e) {
         echo  $this->controller->render('error',['er'=>$e]);
        }
    }
}
