<?php
namespace Controller;

class FormationController
{
    private $db;
    public function __construct()
    {
        $this->db = new \model\FormationManager; // permet de récupérer une connexion à la BDD qui se trouve dans le fichier FormationManager.php
    }
    public function handlerRequest() // action de l'internaute
    {
        $op = isset($_GET['op']) ? $_GET['op'] : NULL; // si op est définie dans l'URL, on le récupère, on le stock dans $op sinon, si rien n'est défini dans l'URL, on stock NULL dans $op
        try
        {
            if($op == NULL) $this->selectAll();
            // if($op == 'add' || $op == 'update') $this->save($op); // si on ajoute ou modifie une formation, on appelle la méthode save()
            // elseif($op == 'select') $this->select(); // si on selectionne une formation, on appelle la méthode select()
            // elseif($op == 'delete') $this->delete(); // si on supprime une formation, on appelle la méthode delete()
            // elseif($op == 'voir') $this->selectVoir();//action qui va me renvoyer sur la page avec les modif et pas sur la page de vue globale que l'on a avec selectAll
            // else $this->selectAll(); // permettra d'afficher l'ensemble des formations
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage()); // permet d'envoyer un message et d'arreter le script si il y a une erreur dans le bloc try
        }
    }

    // public function selectVoir()
    // {
    //     $this->render('layoutAdmin.php', 'donneesAdmin.php', array(
    //         'title' => 'Mes formations',
    //         'donnees' => $this->db->selectVoir(),
    //         'fields' => $this->db->getFields(),
    //         'id' => 'id_' . $this->db->table2 // affiche id_t_formation, cela servira a pointé sur l'indice idFormation du tableau de données envoyer dans le layout pour les liens voir/modifier/supprimer
    //     )); 
    // }

    // public function formation()
    // {
    //     $this->render('layout.php', 'formation.php');
    // }

    public function selectAll()
    {
        // echo 'Methode selectAll()';
        // $r = $this->db->selectAll();
        // echo '<pre>'; print_r($r); echo '</pre>';
        $this->render('layout.php', 'donnees.php', array(
            'title' => 'Mes formations',
            'donnees' => $this->db->selectAll(),
            'fields' => $this->db->getFields(),
            'id' => 'id_' . $this->db->table2 
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

    // public function select() 
    // {
    //     $id = isset($_GET['id']) ? $_GET['id'] : NULL;
    //     $this->render('layout.php', 'detail.php', array(
    //         "title" => "Détail de la formation n° ID : $id",
    //         "donnees" => $this->db->select($id)
    //     ));
    // }

    // public function delete()
    // {
    //     $id = isset($_GET['id']) ? $_GET['id'] : NULL;
    //     $r = $this->db->delete($id);
    //     $this->redirect('index.php'); // on redirige aprés la suppression
    // }

    // public function save($op)
    // {
    //     $title = $op;

    //     $id = isset($_GET['id']) ? $_GET['id'] : NULL; // permet de savoir si un id a été envoyé dans l'URL, si on clique sur 'modifier' on envoi l'id dans l'URL et on le récupère, sinon c'est un ajout

    //     $values = ($op == 'update') ? $this->db->select($id) : ''; // si on a envoyé un id dans l'URL, on l'envoi en argument de la méthode select() de FormationManager, cela permettra de selectionner toute les données de la formation pour la modification

    //     //var_dump($values);

    //     if($_POST)
    //     {
    //         $r = $this->db->save(); 
    //         $this->redirect('index.php'); 
    //     }
        
    //     $this->render('layoutAdmin.php', 'formAdmin.php', array(
    //         "title" => "Donnée : $title",
    //         "op" => $op,
    //         "fields" => $this->db->getFields(), 
    //         "values" => $values 
    //     ));
    // }
}