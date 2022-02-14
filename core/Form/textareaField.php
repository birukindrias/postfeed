<?php
namespace App\core\Form;

class textareaField extends BaseField
{

   public function __construct($attr, $model)
   {
       $this->attr = $attr;
       $this->model = $model;
   }
   public function inp()
   {
   return sprintf('<textarea  name="%s" class="form-control" id="exampleFormControlInput1"
    placeholder="%s"></textarea>',
            $this->attr,
            $this->model->label()[$this->attr]);
   }
  
}
