<?php
require_once 'autoload.php';


$controller = new Controller\CompetenceController; // l'autoload voit passer le mot clé 'new' et fait appel au fichier Controller.php. Et dans un 2ème temps, dans le controller il y a un instance 'new' de manager, donc l'autoload fait appel au fichier manager.php



$controller->handlerRequest();