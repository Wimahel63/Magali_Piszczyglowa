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
        $op = isset($_GET['op']) ? $_GET['op'] : NULL; 
        try
        {
            if($op == 'add' || $op == 'update') $this->save($op); 
            elseif($op == 'select') $this->select(); 
            elseif($op == 'delete') $this->delete(); 
            else $this->selectAll(); 
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage()); 
        }
    }
    public function selectAll()
    {
       
        $this->render('layout.php', 'competence.php', array(
            'title' => 'Mes competences',
            'donnees' => $this->db->selectAll(),
            'fields' => $this->db->getFields(),
            'id' => 'id_' . $this->db->table4 
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
        $this->render('layoutAdmin.php', 'detail.php', array(
            "title" => "Competence: $id",
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
    //         $r = $this->db->save(); 
    //         $this->redirect('index.php'); 
    //     }
        
    //     $this->render('layoutAdmin.php', 'form.php', array(
    //         "title" => "Competence : $title",
    //         "op" => $op,
    //         "fields" => $this->db->getFields(), 
    //         "values" => $values 
    //     ));
    // }
}