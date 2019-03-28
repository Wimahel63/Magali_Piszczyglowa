<?php
require_once 'autoload.php';

// Etape 1 : 
// require 'Controller.php';
// Etape 2 : 
// require 'EntityRepository.php';

$controller = new Controller\UserController; // l'autoload voit passer le mot clé 'new' et fait appel au fichier Controller.php. Et dans un 2ème temps, dans le controller il y a un instance 'new' de EntityRepository, donc l'autoload fait appel au fichier EntityRepository.php

//echo '<pre>'; var_dump($controller); echo '</pre>';

$controller->handlerRequest(); 
?>

<!-- <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>mon site cv</title>
    <link rel="stylesheet" href="front/style.css"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="front/style.css">
</head>
<body>
    <header>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
      <a class="navbar-brand" href="">Accueil</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
       </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav"> 
        <li class="nav-item active" id="sousMenu">menu deroulant
        <a class="nav-link" href="#">Mon parcours</a>
            <ul class="niveau2"> 
                <li class="nav-item"><a href="experience.php">Mes experiences</a></li>
                <li class="nav-item"><a href="formation.php">Mes formations</a></li>
            </ul>    
      </li> 
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Mes réalisations</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Mes compétences</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Me contacter</a>
      </li>
    </ul>
  </div>
</nav>

    </header>    

    
      <div class="jumbotron">
       <div class="logo">
        <h1 class="display-4 text-center">m<a class="hidden" href="connect.php">h</a>p</h1>
        <p class="lead text-center">dev integ</p>
       </div>
      </div>

      <div class="container">
     
        <div id="propos"></div>
        <div id="experience"></div>
        <div id="formation"></div>
        <div id="realisation"></div>
        <div id="competences"></div>
        <div id="contact"></div>

      </div> 

      <div class="card" style="width: 18rem;">
  
  <div class="card-body">
    
    <p class="card-text"><div class="btn-group-vertical">
    <button type="button" class="btn btn-primary" id="vueFormation">Primary</button>
    <button type="button" class="btn btn-success" id="vueExperience">Success</button>
    <button type="button" class="btn btn-danger" id="vueRealisation">Danger</button>
    <button type="button" class="btn btn-info" id="vueCompetence">info</button>
    <button type="button" class="btn btn-warning" id="vueContact">Warning</button>
</div></p>
    <a href="connect.php" class="btn btn-primary">Power</a>
  </div>
</div>






<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>     -->