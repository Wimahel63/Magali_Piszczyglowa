<?php
namespace Controller;

class RealisationController
{
    private $db;
    public function __construct()
    {
        $this->db = new \model\RealisationManager; // permet de récupérer une connexion à la BDD qui se trouve dans le fichier EntityRepository.php
    }
    public function handlerRequest() // permet de savoir ce que l'internaute demande (afficher/modifier/supprimer), action de l'internaute
    {
        $op = isset($_GET['op']) ? $_GET['op'] : NULL; // si op est définie dans l'URL, on le récupère, on le stock dans $op sinon, si rien n'est défini dans l'URL, on stock NULL dans $op
        try
        {
            if($op == 'add' || $op == 'update') $this->save($op); // si on ajoute ou modifie un employé, on appel la méthode save()
            elseif($op == 'select') $this->select(); // si on selectionne un employé, on appel la méthode select()
            elseif($op == 'delete') $this->delete(); // si on supprime un employé, on appel la méthode delete()
            elseif($op == 'deconnexion') $this->deconnexion();
            else $this->selectAll(); // permettra d'afficher l'ensemble des employés
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage()); // permet d'envoyer un message et d'arreter le script si il y a une erreur dans le bloc try
        }
    }
    public function selectAll()
    {
        // echo 'Methode selectAll()';
        // $r = $this->db->selectAll();
        // echo '<pre>'; print_r($r); echo '</pre>';
        $this->render('layout.php', 'realisations.php', array(
            'title' => 'Mes realisations',
            'donnees' => $this->db->selectAll(),
            'fields' => $this->db->getFields(),
            'id' => 'id_' . $this->db->table3 // affiche idEmploye, cela servira a pointé sur l'indice idEmploye du tableau de données envoyer dans le layout pour les liens voir/modifier/supprimer
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

    public function select() 
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $this->render('layout.php', 'details2.php', array(
            "title" => "Détail de la réalisation : $id",
            "donnees" => $this->db->select($id)
        ));
    }

    public function delete()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $r = $this->db->delete($id);
        $this->redirect('index.php'); // on redirige aprés la suppression
    }

    public function save($op)
    {
        $title = $op;

        $id = isset($_GET['id']) ? $_GET['id'] : NULL; // permet de savoir si un id a été envoyé dans l'URL, si on clique sur 'modifier' on envoi l'id dans l'URL et on le récupère, sinon c'est un ajout

        $values = ($op == 'update') ? $this->db->select($id) : ''; // si on a envoyé un id dans l'URL, on l'envoi en argument de la méthode select() de entityRepository, cela permettra de selectionner toute les données de l'employé pour la modification

        //var_dump($values);

        if($_POST)
        {
            $r = $this->db->save(); // lorsque l'on valide le formulaire d'ajout, on execute la méthode save() du fichier EntityRepository.php
            $this->redirect('index.php'); // aprés l'insertion, on redirige vers la page index.php
        }
        
        $this->render('layout.php', 'form.php', array(
            "title" => "Donnée : $title",
            "op" => $op,
            "fields" => $this->db->getFields(), // c'est ce qui va nous permettre de récupérer le nom des champs pour les définir de façon générique
            "values" => $values // permet de récupérer toute les données de l'employé en cas de modification
        ));
    }

    public function deconnexion()
    {
        session_destroy();
        $this->redirect('./../index.php');
    }
}