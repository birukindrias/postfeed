<?php
namespace App\core\Session;
class Session
{
    public const FLASH_KEY = "flash_messages";
    public function __construct() {
        session_start();
        $flash_messages=$_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flash_messages as $key => &$value) {
            $value['remove'] = true;
        }
        $_SESSION[self::FLASH_KEY] =$flash_messages;
    }

    public function set($key,$val)
    {
        $_SESSION[$key]=$val;
    }
    public function get($key)
    {
        return $_SESSION[$key] ?? false;
    }
    public function remove($key)
    {
        unset($_SESSION[$key]);
        return true;
    }
    
    public function set_Flash($key,$msg)
    {
        $_SESSION[self::FLASH_KEY][$key] =[
            'remove'=>false,
            'msg'=>$msg
        ];
    }
    public function get_Flash($key)
    {
       return $_SESSION[self::FLASH_KEY][$key]['msg'] ?? false;
    }

    public function __destruct() {
        $flash_messages=$_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flash_messages as $key => &$value) {
            if($value['remove'] === true){
                unset($flash_messages[$key]);
            }
        }
        $_SESSION[self::FLASH_KEY] =$flash_messages;
    }
} 

?>