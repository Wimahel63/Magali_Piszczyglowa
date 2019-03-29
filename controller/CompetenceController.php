<?php
namespace Controller;

class CompetenceController
{
    private $db;
    public function __construct()
    {
        $this->db = new \model\CompetenceManager; 
    }
    public function handlerRequest() 
    {
        $op = isset($_GET['op']) ? $_GET['op'] : NULL; //on verifie si une action est passée en url
        try
        {
            if($op == null ) $this->selectAll(); // aucune action n'est passée, la methode sera selectAll
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage()); 
        }
    }

    //methode selectAll :  selectionne toutes les donnees de la table demandée et l'affiche dans la vue competences
    public function selectAll()
    {
       
        $this->render('layout.php', 'competence.php', array(
            'title' => 'Mes competences',
            'donnees' => $this->db->selectAll(),
            'fields' => $this->db->getFields()
            // 'id' => 'id_' . $this->db->table4 
        ));
    }


    // $this->render('layout.php', 'donnees.php' , 'paramètres');
    public function render($layout, $template, $parameters = array())
    {
        extract($parameters);  // permet d'avoir des indices du tableau comme variable
        ob_start(); // commence la temporisation, ob_start() démarrer la temporisation de sortie
        // require "view/donnees.php";
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