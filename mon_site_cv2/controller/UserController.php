<?php
namespace Controller;

class UserController
{
    private $db;
    public function __construct()
    {
        $this->db = new \model\UserManager; // cette fonction me permet de recuperer la connexion a ma bdd, qui est creee dans le manager
    }


    // fonction correpondant à la fonction à mettre en oeuvre selon l'action demandée par l'utilisateur
    public function handlerRequest() 
    {
        $op = isset($_GET['op']) ? $_GET['op'] : NULL; // si l'action est définie dans l'URL, on la récupère, on la stock dans $op. Mais si rien n'est défini dans l'URL, on stock NULL dans $op et la fonction appelée sera selectAll
        try
        {
            if($op == 'add' || $op == 'update') $this->save($op); // en cas d'ajout ou de modification, on appelle la méthode save()
            elseif($op == 'select') $this->select(); // en cas de selection au detail, on appelle la méthode select()
            elseif($op == 'delete') $this->delete(); // en cas de suppression, on appelle la méthode delete()
            elseif($op == 'deconnexion') $this->deconnexion();// pour la déconnexion, c'est la methode deconnexion qui sera appelée
            else $this->selectAll(); // permettra d'afficher l'ensemble des donnees. Action par defaut si rien n'est defini dans l'url
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage()); // permet d'envoyer un message et d'arreter le script si il y a une erreur dans le bloc try
        }
    }


    public function selectAll() // action par defaut, ce que l'on voit en arrivant sur la page d'accueil
    {
        $this->render('layout.php', 'donnees.php', array(
            'title' => 'Qui suis-je :',
            'donnees' => $this->db->selectAll(),
            'fields' => $this->db->getFields(),
            'id' => 'id_' . $this->db->table5 // affiche l'id du profil, cela servira à pointer sur l'indice id_t_user 
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

    public function select() // méthode permettant de voir le détail d'un employé, quand on clic sur le lien 'détail', c'est la méthode 'select()' qui s'execute
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $this->render('layout.php', 'detail.php', array(
            "title" => "Détail de l'employé ID : $id",
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