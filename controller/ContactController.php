<?php
namespace Controller;


//dans cette page , utilisation de la table user
class ContactController
{
    private $db;
    
    public function __construct()
    {
        $this->db = new \model\ContactManager; 
    }

    public function handlerRequest() 
    {
        $op = isset($_GET['op']) ? $_GET['op'] : NULL; 
        try
        {
            if($op == NULL) $this->selectAll();
            // if($op == 'add' || $op == 'update') $this->save($op); // si on ajoute ou modifie , on appelle la méthode save()
            // elseif($op == 'select') $this->select(); // si on selectionne , on appelle la méthode select()
            // elseif($op == 'delete') $this->delete(); // si on supprime , on appelle la méthode delete()
            // else $this->selectAll(); //selectionne tout
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage()); 
        }
    }

    public function selectAll()
    {
        // echo 'Methode selectAll()';
        // $r = $this->db->selectAll();
        // echo '<pre>'; print_r($r); echo '</pre>';
        $this->render('layout.php', 'contact.php', array(
            'title' => 'Si vous désirez me contacter :',
            'donnees' => $this->db->selectAll(),
            'fields' => $this->db->getFields(),
            'id' => 'id_' . $this->db->table5 
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

    public function redirect($url)
    {
        header("Location:" . $url); 
    }

    // public function select() 
    // {
    //     $id = isset($_GET['id']) ? $_GET['id'] : NULL;
    //     $this->render('layoutAdmin.php', 'detailAdmin.php', array(
    //         "title" => "Détail de l'employé ID : $id",
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

    //     $values = ($op == 'update') ? $this->db->select($id) : '';
    //     //var_dump($values);

    //     if($_POST)
    //     {
    //         $r = $this->db->save();
    //         $this->redirect('index.php'); // aprés l'insertion, on redirige vers la page index.php
    //     }
        
    //     $this->render('layoutAdmin.php', 'formAdmin.php', array(
    //         "title" => "Donnée : $title",
    //         "op" => $op,
    //         "fields" => $this->db->getFields(), 
    //         "values" => $values 
    //     ));
    // }

    ///////////////////////////////////////////

    public function retour($retour)
    {
        $retour=mail('magali.piszczyglowa@lepoles.com', 'Envoi depuis mon_site_cv', $_POST['message'], 'From:'. $_POST['email']);
    }
}