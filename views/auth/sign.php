<h2>sign up</h2>
<?php

use App\core\Form\Form;

$form = Form::begin('/signup','post');?>
<?= $form->field('firstname',$model);?>
<?= $form->field('lastname',$model);?>
<?= $form->field('email',$model)->email();?>
<?= $form->field('password',$model)->fieeld();?>
<?= $form->field('cpass',$model)->fieeld();?>
<button type="submit" class="button">
    submit
</button>
<?=
$form->end();
?>
