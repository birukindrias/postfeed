<?php
namespace App\core\Form;

use App\core\Form\exField;
use App\core\Form\Field;

class Form
{
    public static function begin($action, $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }
    public function field($attr, $model)
    {
        return new Field($attr, $model);
    }
    public function exfield($attr, $model)
    {
        return new exField($attr, $model);
    }
    public function end()
    {
        echo "</form>";
    }
}
