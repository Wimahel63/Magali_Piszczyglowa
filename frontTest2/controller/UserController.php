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
            if($op == 'add' || $op == 'update') $this->save($op); 
            elseif($op == 'select') $this->select(); 
            elseif($op == 'delete') $this->delete();
            // else $this->selectAll(); 
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

    public function select() 
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $this->render('layout.php', 'detail.php', array(
            "title" => "Détail de l'employé ID : $id",
            "donnees" => $this->db->select($id)
        ));
    }

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

    //     $values = ($op == 'update') ? $this->db->select($id) : ''; 
    //     //var_dump($values);

    //     if($_POST)
    //     {
    //         $r = $this->db->save(); // lors de la validation du formulaire d'ajout, on execute la méthode save() du fichier UserManager.php
    //         $this->redirect('index.php'); // aprés l'insertion, on redirige vers la page index.php
    //     }
        
    //     $this->render('layout.php', 'form.php', array(
    //         "title" => "Donnée : $title",
    //         "op" => $op,
    //         "fields" => $this->db->getFields(), 
    //         "values" => $values 
    //     ));
    // }
}