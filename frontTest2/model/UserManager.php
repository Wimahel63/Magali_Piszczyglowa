<?php
namespace model;

class UserManager
{
    private $db;
    public $table5;
    public function getDb() // méthode permettant d'instancier la classe PDO et de créer un objet
    {
        if(!$this->db) // seulement si $this->db n'est pas rempli, si il n'y a pas de connexion, alors on la construit
        {
            try
            {
                $xml = simplexml_load_file('app/config.xml'); // simplexml_load_file() permet de convertir le fichier XML en objet
                //echo '<pre>'; var_dump($xml); echo '</pre>';
                // $this->table = "employes"
                $this->table5 = $xml->table5; // on associe le nom de la table du fichier XML à la propriété de la classe, cette propriété nous servira pour toute nos requetes SQL (INSERT INTO $this->table) 
                try
                {
                    $this->db = new \PDO("mysql:dbname=" . $xml->db . ";host=" . $xml->host, $xml->user, $xml->password, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)); // Connexion à la BDD, si jamais on change de BDD, nous n'aurons pas besoin de modifier ce code, c'est un code générique, c'est le fichier config.xml que l'on modifiera
                    // echo '<pre>'; var_dump($this->db); echo '<pre>';
                    // echo '<pre>'; print_r(get_class_methods($this->db)); echo '<pre>';
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
        $q = $this->getDb()->query("DESC " . $this->table5); // DESC : description de la table
        $r = $q->fetchAll(\PDO::FETCH_ASSOC);
        return array_splice($r, 1); 
    }

    public function select($id) 
    {
        $q = $this->getDb()->query("SELECT * FROM " . $this->table5 . " WHERE id_" . $this->table5 . "=" . (int) $id);
        $r = $q->fetch(\PDO::FETCH_ASSOC);
        return $r;
    }

    public function selectAll()
    {
       
        $q = $this->getDb()->query("SELECT prenom, nom, pseudo, email, avatar, age, date_naissance, ville, pays FROM " . $this->table5); //  requete permettant de selectionner toute une table, $this->table5 : représente dans notre cas la table 'user'
        $r = $q->fetchAll(\PDO::FETCH_ASSOC); 
        return $r;
    }

    public function selectVoir()//test pour tout afficher sans option de choix dans la partie back
    {
        
        $q = $this->getDb()->query("SELECT prenom, nom, pseudo, email, avatar, age, date_naissance, ville, pays FROM " . $this->table5); 
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

