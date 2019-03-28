<?php
namespace Controller;

class RealisationController
{
    private $db;
    public function __construct()
    {
        $this->db = new \model\RealisationManager;  
    }
    public function handlerRequest() // action de l'internaute
    {
        $op = isset($_GET['op']) ? $_GET['op'] : NULL;
        try
        {
            if($op == 'add' || $op == 'update') $this->save($op); //pour l'ajout ou la modification (côté back)
            elseif($op == 'select') $this->select(); 
            elseif($op == 'delete') $this->delete(); 
            else $this->selectAll(); // affiche l'ensemble des donnees par defaut
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage()); 
        } 
    }

    public function formation()
    {
        $this->render('layout.php', 'formation.php');
    }

    public function selectAll()
    {
        // echo 'Methode selectAll()';
        // $r = $this->db->selectAll();
        // echo '<pre>'; print_r($r); echo '</pre>';
        $this->render('layout.php', 'donneesRealisation.php', array(
            'title' => 'Mes realisations',
            'donnees' => $this->db->selectAll(),
            'fields' => $this->db->getFields(),
            'id' => 'id_' . $this->db->table3 
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
        header("Location:" . $url); 
    }

    public function select() // méthode permettant de voir un détail choisi
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $this->render('layout.php', 'detail.php', array(
            "title" => "Détail de la realisation ID : $id",
            "donnees" => $this->db->select($id)
        ));
    }

    public function delete()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $r = $this->db->delete($id);
        $this->redirect('realisation.php'); // on redirige aprés la suppression
    }

    public function save($op)
    {
        $title = $op;

        $id = isset($_GET['id']) ? $_GET['id'] : NULL; 

        $values = ($op == 'update') ? $this->db->select($id) : ''; // si on a envoyé un id dans l'URL, on l'envoi en argument de la méthode select() de RealisationManager
        //var_dump($values);

        if($_POST)
        {
            $r = $this->db->save(); 
            $this->redirect('index.php'); // aprés l'insertion, on redirige vers la page index.php
        }
        
        $this->render('layout.php', 'donneesRealisation.php', array(
            "title" => "Donnée : $title",
            "op" => $op,
            "fields" => $this->db->getFields(), 
            "values" => $values 
        ));
    }

    
}