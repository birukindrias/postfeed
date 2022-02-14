<?php
namespace App\core\Form;

class Field extends BaseField
{
    public string $pes='text';
    public const ep = 'email';
    public const em = 'password';

    public function __construct($attr, $model)
    {
        $this->attr = $attr;
        $this->model = $model;
    }
    public function fieeld()
    {
        $this->pes=self::em;
        return $this;
    }
    public function email()
    {
        $this->pes=self::ep;
        return $this;
    }
   public function inp()
   {
   return sprintf('<input type="%s" name="%s" class="form-control" id="exampleFormControlInput1"
    placeholder="%s">',
    $this->pes,
            $this->attr,
            $this->model->label()[$this->attr],
        );
   }
//     public function __toString()
//     {
//         return sprintf(
//             '

//             <div class="mb-3">
//             <label for="exampleFormControlInput1" class="form-label">%s</label>
// %s       
//              <div class="valid-feedback">
//       Looks good!
//     </div>
            
//            ',
//             $this->model->label()[$this->attr],
//             $this->inp(),

//             $this->pes,
//             $this->attr,
//             $this->model->label()[$this->attr]
//             ,
//         );
//     }
}
