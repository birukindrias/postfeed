<?php
namespace App\core\Form;

abstract class BaseField 
{
    public string $pes='text';
   
    abstract public function inp();
  

    public function __construct($attr, $model)
    {
        $this->attr = $attr;
        $this->model = $model;
    }
  
  
    public function __toString()
    {
        return sprintf(
            '

            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">%s</label>
%s       
             <div class="invalid">
     %s 
    </div>
            
           ',
            $this->model->label()[$this->attr],
            $this->inp(),

            $this->model->firsError($this->attr)

        );
    }
}
