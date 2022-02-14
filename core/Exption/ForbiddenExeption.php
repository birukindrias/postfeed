<?php 

namespace App\core\Exption;

use App\core\App;

class ForbiddenExeption extends \Exception
 {
   protected $code =403;
   protected $message= "not accessible";
   public function __construct() {
    if (App::$app->isGuest()) {
       $this->code =403;
       $this->message= "u are from inside can't do this";
   }
  }
 
}?>