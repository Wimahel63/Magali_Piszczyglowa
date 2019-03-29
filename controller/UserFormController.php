<?php
namespace Controller;

class UserFormController
{
    private $db;
    public function __construct()
    {
        $this->db = new \model\UserFormManager; 
    }
    public function handlerRequest() 
    {
        $op = isset($_GET['op']) ? $_GET['op'] : NULL; 
        try
        {
            if($op == NULL) $this->selectAll();
           
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage()); 
        }
    }
    public function selectAll()
    {
        
        $this->render('layout.php', 'userForm.php', array(
            'title' => 'Me connecter :',
            'donnees' => $this->db->selectAll(),
            'fields' => $this->db->getFields(),
            'id' => 'id_' . $this->db->table5 
        ));
    }
    
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

    public function retour($retour)
    {
        $retour=mail('magali.piszczyglowa@lepoles.com', 'Envoi depuis mon_site_cv', $_POST['message'], 'From:'. $_POST['email']);
    }

    
}