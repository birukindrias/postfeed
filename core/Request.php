<?php
namespace App\core;

class Request
{
    public function path()
    {
        $path = $_SERVER['REQUEST_URI'];
        $pos = strpos($path, '?');
        if (!$pos) {
            return $path;
        }
        return substr($path, 0, $pos);
    }
    public function method()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        return strtolower($method);
    }
    public function isPost()
    {
        if ($this->method() === 'post') {
            return true;
        }
    }
    public function isGet()
    {
        if ($this->method()=== 'get') {
            return true;
        }
    }
    public function getBody()
    {
        $Body =[];
        if ($this->method() === 'post') {
            foreach ($_POST as $key => $value) {
                $Body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->method() === 'get') {
            foreach ($_GET as $key => $value) {
                $Body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $Body;
    }
}
