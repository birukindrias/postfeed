<?php 
namespace App\model;

use App\core\Model;
use App\core\userModel;

class user extends userModel{
    public string $firstname = "";
    public string $lastname = "";
    public string $email = "";
    public string $password = "";
    public string $cpass = "";
    public static  function primary_key(): string
    {
        return 'id';
    }
    public static function tableName(): string
    {
        return 'users';
    }
public function displayName(): string
{
    return $this->firstname .' '. $this->lastname;
}

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED,[self::RULE_UNIQE],[self::RULE_EMAIL]],
            'password' => [self::RULE_REQUIRED,[self::RULE_MAX,'max' => 8]],
            'cpass' => [self::RULE_REQUIRED,[self::RULE_PASS,'pass' => 'Password']],

        ];
    }

    public function save()
    {
        $this->password =password_hash($this->password,PASSWORD_DEFAULT);
        parent::save();
        return true;
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