<?php
namespace Controller;

class CompetenceController
{
    private $db;
    public function __construct()
    {
        $this->db = new \model\CompetenceManager; // permet de récupérer une connexion à la BDD qui se trouve dans le fichier Manager.php correspondant
    }
    public function handlerRequest() // permet de savoir ce que l'internaute demande (afficher/modifier/supprimer), action de l'internaute
    {
        $op = isset($_GET['op']) ? $_GET['op'] : NULL; // si op est définie dans l'URL, on le récupère, on le stock dans $op sinon, si rien n'est défini dans l'URL, on stock NULL dans $op, et on effectue la fonction selectAll
        try
        {
            if($op == 'add' || $op == 'update') $this->save($op); // si on ajoute ou modifie un employé, on appel la méthode save()
            elseif($op == 'select') $this->select(); // si on selectionne un element, on appelle la méthode select()
            elseif($op == 'delete') $this->delete(); // si on supprime un element, on appelle la méthode delete()
            elseif($op == 'deconnexion') $this->deconnexion();
            else $this->selectAll(); // permettra d'afficher l'ensemble des donnees d'une table
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage()); // permet d'envoyer un message et d'arreter le script si il y a une erreur dans le bloc try
        }
    }


    public function selectAll()
    {
        $this->render('layout.php', 'competences.php', array(
            'title' => 'Mes competences',
            'donnees' => $this->db->selectAll(),
            'fields' => $this->db->getFields(),
            'id' => 'id_' . $this->db->table4 // affiche id_t_skill, cela servira a pointé sur l'indice id_t_skill du tableau de données envoyé dans le layout pour les liens voir/modifier/supprimer
        ));
    }

    
    // methode qui me permettra de selectionner le template à partir duquel seront affichées mes données
    public function render($layout, $template, $parameters = array())
    {
        extract($parameters);  // permet d'avoir des indices du tableau comme variable
        ob_start(); // commence la temporisation, ob_start() démarrer la temporisation de sortie
        
        require "view/$template";

        //$content =  require "view/$template";
        $content = ob_get_clean(); // tout ce qui se trouve dans le template sera stocké dans $content 
       
        ob_start(); // temporiser la sortie de l'affichage
       
        require "view/$layout";
        return ob_end_flush(); // libérer l'affichage et fait tout apparaitre sur la page 
    }

    public function redirect($url) // méthode permettant d'effectuer une redirection
    {
        header("Location:" . $url); // fonction prédéfinie permettant d'effectuer une redirection
    }


    //methode select : selectionne les données d'un seul élémnt à la fois selon son id
    public function select() 
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $this->render('layout.php', 'details2.php', array(
            "title" => "Compétence : $id",
            "donnees" => $this->db->select($id)
        ));
    }


    // methode delete: supprime l'élément dont l'id a été selectionné
    public function delete()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $r = $this->db->delete($id);
        $this->redirect('index.php'); // on redirige après la suppression
    }

    public function save($op)
    {
        $title = $op;

        $id = isset($_GET['id']) ? $_GET['id'] : NULL; // permet de savoir si un id a été envoyé dans l'URL, si on clique sur 'modifier' on envoi l'id dans l'URL et on le récupère, sinon c'est un ajout

        $values = ($op == 'update') ? $this->db->select($id) : ''; // si on a envoyé un id dans l'URL, on l'envoie en argument de la méthode select() du Manager correspondant, cela permettra de selectionner toutes les données de l'elément pour la modification

        if($_POST)
        {
            $r = $this->db->save(); // lorsque l'on valide le formulaire d'ajout, on execute la méthode save() du fichier Manager.php correspondant
            $this->redirect('donnees.php'); // aprés l'insertion, on redirige vers la page donnees.php
        }
        
        $this->render('layout.php', 'form.php', array(
            "title" => "Competence : $title",
            "op" => $op,
            "fields" => $this->db->getFields(), // c'est ce qui va nous permettre de récupérer le nom des champs pour les définir de façon générique
            "values" => $values // permet de récupérer toutes les données de la compétence  modifiée
        ));
    }


    // methode deconnexion : me renvoie sur la page index.php d mon côté front
    public function deconnexion()
    {
        session_destroy();
        $this->redirect('./../index.php');
    }
}