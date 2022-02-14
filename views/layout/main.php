<?php
use App\core\App;
echo App::$app->session->get_Flash('suc');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <style>
    button {
      border-collapse: collapse;
      border: 1px solid blue;
      margin-top: 15px;
      margin-left: 94%;

      width: 70px;
      height:  30px;

      border-radius: 4px;
color: white;
background-color: black;

}
.con {
     
      margin-top: 50px;
    

}
.soc {
     background-color: greenyellow;
     padding: 10px;
     text-align: center;
      /* margin-top: 50px; */
    

}
.invalid {
    color: red; 
   

}
    </style>

  </head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <a class="navbar-brand" href="/">PHP MVC</a>
     

      </ul>
      <ul class="navbar-nav  mb-2 mb-lg-0 d-flex">
      
        <?php if (App::$app->isGuest()): ?>
                                                  
                       <li class="nav-item">
                      <a class="nav-link" aria-current="page" href="/">Home</a>
                 </li>
                  <li class="nav-item ">
       
                  <a class="nav-item nav-link" aria-current="page" href="/pro">  
                     <?= App::$app->user->displayName();?>    </a>
           </li>
        <li class="nav-item">
          <a class="nav-link" href="/logout">logout</a>
        </li>
        <?php elseif (!App::$app->isGuest()): ?>
          <li class="nav-item">
          <a class="nav-link" href="/signup">signup</a>
        </li>

        <li class="nav-item  me-2">
          <a class="nav-link" href="/login">login</a>
        </li>
        <?php endif;?>
        <!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> -->
        <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
        </ul>
    </div>
  </div>
</nav>
<div class="con container-md">

{cont}
</div>

</body>
</html>