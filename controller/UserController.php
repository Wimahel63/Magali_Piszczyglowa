<?php
namespace Controller;

class UserController
{
    private $db;


    public function __construct()
    {
        $this->db = new \model\UserManager; 
    }


    public function handlerRequest() // action de l'internaute
    {
        $op = isset($_GET['op']) ? $_GET['op'] : NULL; // si op est définie dans l'URL, on le récupère, on le stock dans $op sinon, si rien n'est défini dans l'URL, on stock NULL dans $op
        try
        {
            if($op == NULL) $this->selectAll(); // si aucune action n'est réalisée, alors execute la function selectAll
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage()); // permet d'envoyer un message et d'arreter le script si il y a une erreur dans le bloc try
        }
    }

    //methode de selection de toutes les donnees de la table user pour l'affichage
    public function selectAll()
    {
        $this->render('layout.php', 'profil.php', array(
            'title' => 'Qui suis-je :',
            'donnees' => $this->db->selectAll(),
            'fields' => $this->db->getFields()
            //'id' => 'id_' . $this->db->table5  affiche id_t_user, cela servira a pointé sur l'indice id_t_user du tableau de données envoyé dans le layout pour les liens voir/modifier/supprimer
        ));
    }

   
    public function render($layout, $template, $parameters = array())
    {
        extract($parameters);  // permet d'avoir des indices du tableau comme variable
        ob_start(); // commence la temporisation, ob_start() démarrer la temporisation de sortie
        // require "view/donnees.php";par ex
        require "view/$template";

        //$content =  require "view/$template";
        $content = ob_get_clean(); // tout ce qui se trouve dans le template sera stocké dans $content 
        //$content = "view/donnees.php";

        ob_start(); // temporiser la sortie de l'affichage
        // require "view/layout.php";
        require "view/$layout";
        return ob_end_flush(); // libérer l'affichage et fait tout apparaitre sur la page 
    }

    
    public function redirect($url) // méthode permettant d'effectuer une redirection
    {
        header("Location:" . $url); // fonction prédéfinie permettant d'effectuer une redirection
    }

    
}