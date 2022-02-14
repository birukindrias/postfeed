<?php
namespace App\controller;

use App\core\App;
use App\model\log;
use App\model\user;
use App\core\Controller;

class siteController extends Controller{
    public function home()
    {
        $ti='home';
        $model = new user();
        return $this->render('home',
    [
        'model'=> $model,
        'ti'=> $ti

]);

    }
    public function sign()
    {
        $user = new user();
        if (App::$app->request->isPost()) {
            $user->loadData(App::$app->request->getBody());
            $user->rules();
            if ($user->validate() && $user->save()) {
                App::$app->session->set_Flash('susc',"      thanks for registering");
                header('location: /login');
                echo "success";
            }
            return $this->render('auth/sign',[
                'model' => $user
            ]);
        }
        return $this->render('auth/sign',[
            'model' => $user
        ]);

    }
    public function log()
    {
        $user = new log();
        if (App::$app->request->isPost()) {
            $user->loadData(App::$app->request->getBody());
            $user->rules();
            if ($user->validate() && $user->getit()) {
                App::$app->session->set_Flash('suc',"          welcome back");

                header('location: /');
            }
            return $this->render('auth/log',[
                'model' => $user
            ]);
        }
        return $this->render('auth/log',[
            'model' => $user
        ]);

    }
    public function pro()
    {
        $ti='profile';

        $user =App::$app->user;
        return $this->render('pro',[
            'user' => $user,
        'ti'=> $ti

        ]);

    }
    public function logout()
    {
        header('location: /');
        return App::$app->session->remove('user');
    }
}
