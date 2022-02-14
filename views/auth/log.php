<h2>login</h2>
<?php

use App\core\Form\Form;

$form = Form::begin('/login','post');?>

<?= $form->field('email',$model)->email();?>
<?= $form->field('password',$model)->fieeld();?>
<button type="submit">
    submit
</button>
<?=
$form->end();
?>