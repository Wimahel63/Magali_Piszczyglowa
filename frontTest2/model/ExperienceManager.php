<?php
namespace model;

class ExperienceManager
{
    private $db;
    public $table;
    public function getDb() // méthode permettant d'instancier la classe PDO et de créer un objet
    {
        if(!$this->db) // seulement si $this->db n'est pas rempli, si il n'y a pas de connexion, alors on la construit
        {
            try
            {
                $xml = simplexml_load_file('app/config.xml'); // simplexml_load_file() permet de convertir le fichier XML en objet
                //echo '<pre>'; var_dump($xml); echo '</pre>';
                
                $this->table = $xml->table; // on associe le nom de la table du fichier XML à la propriété de la classe, cette propriété nous servira pour toute nos requetes SQL (INSERT INTO $this->table) 
                try
                {
                    $this->db = new \PDO("mysql:dbname=" . $xml->db . ";charset=utf8;host=" . $xml->host, $xml->user, $xml->password, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)); 
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
        $q = $this->getDb()->query("DESC " . $this->table); // DESC : description de la table
        $r = $q->fetchAll(\PDO::FETCH_ASSOC);
        return array_splice($r, 1); // permet de ne pas récupérer le premier champs id dans le formulaire, dans la BDD grace à la fonction prédéfinie array_splice()
    }

    public function select($id) 
    {
        $q = $this->getDb()->query("SELECT * FROM " . $this->table . " WHERE id_" . $this->table . "=" . (int) $id);
        $r = $q->fetch(\PDO::FETCH_ASSOC);
        return array_splice($r,1);
    }

    public function selectAll()
    {
        
        $q = $this->getDb()->query("SELECT * FROM " . $this->table); 
        $r = $q->fetchAll(\PDO::FETCH_ASSOC); 
        return $r;
    }

    public function save()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 'NULL';

        $q = $this->getDb()->query('REPLACE INTO ' . $this->table . '(id_' . $this->table . ',' . implode(',', array_keys($_POST)) . ') VALUES (' . $id . ',' . "'" . implode("','", $_POST) . "'" . ')');

        //echo 'REPLACE INTO ' . $this->table . '(id' . ucfirst($this->table) . ',' . implode(',', array_keys($_POST)) . ') VALUES (' . $id . ',' . "'" . implode("','", $_POST) . "'" . ')';

       
    }

    public function delete($id)
    {
        $q = $this->getDb()->query("DELETE FROM " . $this->table . " WHERE id_" . $this->table . '=' . (int) $id);

        
    }
}

