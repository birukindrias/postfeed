<?php 
namespace App\core;

use App\model\user;

abstract class Model
{
    public const RULE_REQUIRED = "required";
    public const RULE_EMAIL = "email";
    public const RULE_UNIQE = "uniqe";
    public const RULE_MAX = "max";
    public const RULE_PASS = "pass";
    public array $errors = [];
    abstract public function rules(): array;

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this,$key)) {
                 $this->{$key} = $value;
            }
        }
    }
    public function validate()
    {
        foreach ($this->rules() as $key => $rules) {
            $value =$this->{$key};

            foreach ($rules as $rule) {
                $rulename =$rule;
                if (!is_string($rulename)) {
                    $rulename =$rule[0];
                }
                if ($rulename === self::RULE_REQUIRED && !$value) {
                    $this->addError($key, self::RULE_REQUIRED,$rule);
                }
                if ($rulename === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($key, self::RULE_EMAIL,$rule);
                }
                if ($rulename === self::RULE_PASS && $this->password != $this->cpass) {
                    $this->addError($key, self::RULE_PASS,$rule);
                }
                if ($rulename === self::RULE_MAX && strlen($this->password) < $rule['max']) {
                    $this->addError($key, self::RULE_MAX,$rule);
                }
                if ($rulename === self::RULE_UNIQE
                //  && strlen($this->password) < $rule['max']
                 ) {
                   $emai=user::findOne(['email'=>$this->email]);
                   if ($emai->email==$this->email) {
                    $this->addError($key, self::RULE_UNIQE,$rule);

                   }
                }
            }
        }
return empty($this->errors);
    }
    public function addError($attr,$rule,$rules  )
    {

        $msg = $this->errorM()[$rule];
        foreach ($rules as $key => $value) {
            $meg =str_replace("{{$key}}",$value,$msg);

        }
        return $this->errors[$attr][]=$meg ?? $msg;
    }
    public function firsError($me)
    {
        $error=$this->errors[$me] ?? [];
        foreach ($error as $key => $item) {
            $ite=$item ?? false;
            
        }

        return $ite;
    }
    public function errorM()
    {
      
           return [
                    self::RULE_REQUIRED => 'please this field is required',
                    self::RULE_EMAIL => 'email must be valide email',
                    self::RULE_MAX => 'password must be at least {max}.',
                    self::RULE_PASS => 'password must  the same as {pass}.',
                    // self::RULE_MATCH => 'it must be the same as {match}',
                    self::RULE_UNIQE => 'this E-mail is already exist ',
                ];
            }
            public function label(): array
            {
                return   [
                    'firstname'=> 'First Name',
                'lastname'=>'Last Name',

'email'=>'E-mail',
'password'=>'Password',
'cpass'=>'Confurm Password'

                ];       }
}
?>