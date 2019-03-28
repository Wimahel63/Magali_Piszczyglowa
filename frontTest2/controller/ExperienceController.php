<?php
namespace Controller;

class ExperienceController
{
    private $db;
    public function __construct()
    {
        $this->db = new \model\ExperienceManager; // permet de récupérer une connexion à la BDD qui se trouve dans le fichier ExperienceManager.php
    }
    public function handlerRequest() //  action de l'internaute
    {
        $op = isset($_GET['op']) ? $_GET['op'] : NULL; // si op est définie dans l'URL, on le récupère, on le stock dans $op sinon, si rien n'est défini dans l'URL, on stock NULL dans $op
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
        // echo 'Methode selectAll()';
        // $r = $this->db->selectAll();
        // echo '<pre>'; print_r($r); echo '</pre>';
        $this->render('layout.php', 'donnees.php', array(
            'title' => 'Mes experiences professionnelles',
            'donnees' => $this->db->selectAll(),
            'fields' => $this->db->getFields(),
            'id' => 'id_' . $this->db->table 
        ));
    }
    // $this->render('layout.php', 'donnees.php' , 'paramètres');
    public function render($layout, $template, $parameters = array())
    {
        extract($parameters); 
        ob_start(); 
        require "view/$template";
        $content = ob_get_clean(); 
        ob_start(); 
        require "view/$layout";
        return ob_end_flush();  
    }

    public function redirect($url) 
    {
        header("Location:" . $url); 
    }

    public function select() 
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $this->render('layout.php', 'detail.php', array(
            "title" => "Experience : $id",
            "donnees" => $this->db->select($id)
        ));
    }

    public function delete()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $r = $this->db->delete($id);
        $this->redirect('index.php'); 
    }

    public function save($op)
    {
        $title = $op;

        $id = isset($_GET['id']) ? $_GET['id'] : NULL; // permet de savoir si un id a été envoyé dans l'URL, si on clique sur 'modifier' on envoi l'id dans l'URL et on le récupère, sinon c'est un ajout

        $values = ($op == 'update') ? $this->db->select($id) : ''; // si on a envoyé un id dans l'URL, on l'envoi en argument de la méthode select() de ExperienceManager, cela permettra de selectionner toute les données de la realisation pour la modification

        //var_dump($values);

        if($_POST)
        {
            $r = $this->db->save(); // lorsque l'on valide le formulaire d'ajout, on execute la méthode save() du fichier ExperienceManager.php
            $this->redirect('index.php'); // aprés l'insertion, on redirige vers la page index.php
        }
        
        $this->render('layout.php', 'form.php', array(
            "title" => "Experience : $title",
            "op" => $op,
            "fields" => $this->db->getFields(), // c'est ce qui va nous permettre de récupérer le nom des champs pour les définir de façon générique
            "values" => $values // permet de récupérer toutes les données de l'experience en cas de modification
        ));
    }
}