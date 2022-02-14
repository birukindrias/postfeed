<?php 
namespace App\core;
abstract class userModel extends dbModel
{
    abstract public function displayName(): string;
}
?>