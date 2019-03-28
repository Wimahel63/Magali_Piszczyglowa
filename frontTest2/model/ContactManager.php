<?php
namespace model;

class ContactManager
{
    private $db;
    public $table5;
    public function getDb() 
    {
        if(!$this->db) // seulement si $this->db n'est pas rempli, si il n'y a pas de connexion, alors on la construit
        {
            try
            {
                $xml = simplexml_load_file('app/config.xml'); // simplexml_load_file() permet de convertir le fichier XML en objet
                //echo '<pre>'; var_dump($xml); echo '</pre>';
                
                $this->table5 = $xml->table5; 
                try
                {
                    $this->db = new \PDO("mysql:dbname=" . $xml->db . ";host=" . $xml->host, $xml->user, $xml->password, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)); 
                }
                catch(\PDOException $e) // on entre ici en cas de mauvaise connexion à la BDD
                {
                    die('Problème de connexion BDD ' . $e->getMessage());
                }
            }
            catch(\PDOException $e)
            {
                die('Problème de fichier XML manquant');
            }
        }
        return $this->db; // on retourne la connexion
    }

    public function getFields() 
    {
        $q = $this->getDb()->query("DESC " . $this->table5); 
        $r = $q->fetchAll(\PDO::FETCH_ASSOC);
        return array_splice($r, 1); // permet de ne pas récupérer le premier champs id dans le formulaire, dans la BDD grace à la fonction prédéfinie array_splice()
    }

    public function select($id) 
    {
        $q = $this->getDb()->query("SELECT * FROM " . $this->table5 . " WHERE id_" . $this->table5 . "=" . (int) $id);
        $r = $q->fetch(\PDO::FETCH_ASSOC);
        return $r;
    }

    public function selectAll()
    {
        
        $q = $this->getDb()->query("SELECT prenom, nom, pseudo, email, telephone, avatar, age, date_naissance, ville, pays FROM " . $this->table5);
        $r = $q->fetchAll(\PDO::FETCH_ASSOC); 
        return $r;
    }

    public function save()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 'NULL';

        $q = $this->getDb()->query('REPLACE INTO ' . $this->table5 . '(id_' . $this->table5 . ',' . implode(',', array_keys($_POST)) . ') VALUES (' . $id . ',' . "'" . implode("','", $_POST) . "'" . ')');

        //echo 'REPLACE INTO ' . $this->table . '(id' . ucfirst($this->table) . ',' . implode(',', array_keys($_POST)) . ') VALUES (' . $id . ',' . "'" . implode("','", $_POST) . "'" . ')';

       
    }

    public function delete($id)
    {
        $q = $this->getDb()->query("DELETE FROM " . $this->table5 . " WHERE id_" . $this->table5 . '=' . (int) $id);

       
    }
}

