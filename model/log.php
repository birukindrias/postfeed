<?php 
namespace App\model;

use App\core\App;
use App\core\Model;
use App\core\dbModel;

class log extends dbModel{
    public string $email = "";
    public string $password = "";
    public static function tableName(): string
    {
        return "users"; 
    }
public static   function    primary_key

(): string
{
    return 'id';
}
public function displayName(): string
{
    return $this->firstname .' '. $this->lastname;
}

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED,[self::RULE_EMAIL]],
            'password' => [self::RULE_REQUIRED,[self::RULE_MAX,'max' => 8]],
        ];
    }

    public function getit()
    {
        $user = static::findOne(['email' => $this->email]);
        if (!$user) {
            return false;
        }
        if (!password_verify($this->password,$user->password)) {
            return false;
        }
        return App::$app->login($user);
    }
    public function attrs(): array
    {
        return [
            'firstname',
            'lastname',
            'email',
            'password',
        ];
    }
}
?>