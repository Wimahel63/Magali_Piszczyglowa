<?php
require_once 'autoload.php';

// Etape 1 : 
// require 'Controller.php';
// Etape 2 : 
// require 'EntityRepository.php';

$controller = new Controller\UserController; // l'autoload voit passer le mot clé 'new' et fait appel au fichier Controller.php. Et dans un 2ème temps, dans le controller il y a un instance 'new' de EntityRepository, donc l'autoload fait appel au fichier EntityRepository.php

//echo '<pre>'; var_dump($controller); echo '</pre>';

$controller->handlerRequest();