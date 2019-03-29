<?php
namespace model;

class RealisationManager
{
    private $db;
    // public $table2;
    public function getDb() // méthode permettant d'instancier la classe PDO et de créer un objet
    {
        if(!$this->db) // seulement si $this->db n'est pas rempli, si il n'y a pas de connexion, alors on la construit
        {
            try
            {
                $xml = simplexml_load_file('app/config.xml'); // simplexml_load_file() permet de convertir le fichier XML en objet
                
                $this->table3 = $xml->table3; // on associe le nom de la table du fichier XML à la propriété de la classe, cette propriété nous servira pour toute nos requetes SQL (INSERT INTO $this->table) 
                try
                {
                    $this->db = new \PDO("mysql:dbname=" . $xml->db . ";charset=utf8;host=" . $xml->host, $xml->user, $xml->password, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)); // Connexion à la BDD, si jamais on change de BDD, nous n'aurons pas besoin de modifier ce code, c'est un code générique, c'est le fichier config.xml que l'on modifiera
                    
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

    public function getFields() // méthode permettant de recolter les données des champs/colonne de la table, c'est un code générique, on récuperera les données de n'importe quelle table
    {
        $q = $this->getDb()->query("DESC " . $this->table3); // DESC : description de la table
        $r = $q->fetchAll(\PDO::FETCH_ASSOC);
        return array_splice($r, 1);
    }

    // public function select($id) 
    // {
    //     $q = $this->getDb()->query("SELECT * FROM " . $this->table3 . " WHERE id_" . $this->table3 . "=" . (int) $id);
    //     $r = $q->fetch(\PDO::FETCH_ASSOC);
    //     return $r;
    // }

    public function selectAll()
    {
        
        $q = $this->getDb()->query("SELECT * FROM " . $this->table3); 
        $r = $q->fetchAll(\PDO::FETCH_ASSOC); 
        return $r;
    }

    // public function save()
    // {
    //     $id = isset($_GET['id']) ? $_GET['id'] : 'NULL';

    //     $q = $this->getDb()->query('REPLACE INTO ' . $this->table3 . '(id_' . $this->table3 . ',' . implode(',', array_keys($_POST)) . ') VALUES (' . $id . ',' . "'" . implode("','", $_POST) . "'" . ')');

    //     //echo 'REPLACE INTO ' . $this->table . '(id' . ucfirst($this->table) . ',' . implode(',', array_keys($_POST)) . ') VALUES (' . $id . ',' . "'" . implode("','", $_POST) . "'" . ')';

       
    // }

    // public function delete($id)
    // {
    //     $q = $this->getDb()->query("DELETE FROM " . $this->table3 . " WHERE id_" . $this->table3 . '=' . (int) $id);

        
    // }
   
}

