<?php
namespace model;

class CompetenceManager
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
                // $this->table = "employes"
                $this->table4 = $xml->table4; // on associe le nom de la table du fichier XML à la propriété de la classe, cette propriété nous servira pour toute nos requetes SQL (INSERT INTO $this->table) 
                try
                {
                    $this->db = new \PDO("mysql:dbname=" . $xml->db . ";charset=utf8;host=" . $xml->host, $xml->user, $xml->password, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)); // Connexion à la BDD, si jamais on change de BDD, nous n'aurons pas besoin de modifier ce code, c'est un code généric, c'est le fichier config.xml que l'on modifiera
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
        $q = $this->getDb()->query("DESC " . $this->table4); // DESC : description de la table
        $r = $q->fetchAll(\PDO::FETCH_ASSOC);
        return array_splice($r, 1); // permet de ne pas récupérer le premier champs idEmploye dans le formulaire, dans la BDD grace à la fonction prédéfinie array_splice()
    }

    public function select($id) // méthode permettant de récupérer les données d'un employé via son id
    {
        $q = $this->getDb()->query("SELECT * FROM " . $this->table4 . " WHERE id_" . $this->table4 . "=" . (int) $id);
        $r = $q->fetch(\PDO::FETCH_ASSOC);
        return $r;
    }

    public function selectAll()
    {
        //  $q = $this->getDb()->query("SELECT * FROM employe");
        $q = $this->getDb()->query("SELECT * FROM " . $this->table4); //  requete permettant de selectionner toute une table, $this->table : représente dans notre cas la table 'employe'
        $r = $q->fetchAll(\PDO::FETCH_ASSOC); 
        return $r;
    }

    public function save()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 'NULL';

        $q = $this->getDb()->query('REPLACE INTO ' . $this->table4 . '(id_' . $this->table4 . ',' . implode(',', array_keys($_POST)) . ') VALUES (' . $id . ',' . "'" . implode("','", $_POST) . "'" . ')');

       

        /*
            - ucfirst($this->table) --> idEmploye 
            - array_keys($_POST) --> permet de recupérer tout les indices du formumaire, tout  les attributs 'name', c'est un code générique, quelque soit le formulaire, nous récupèrerons les bons indices
            - implode(',', array_keys($_POST)) --> implode() permet d'extraire tout les indices du formulaire séparé par une virgule
            - Si l'id est connu en BDD, la requete REPLACE se comporte comme un UPDATE
            - Si l'id n'est pas connu en BDD, la requete REPLACE se comporte comme un INSERT, ça permet de faire 2 requete en une seule
        */
    }

    public function delete($id)
    {
        $q = $this->getDb()->query("DELETE FROM " . $this->table4 . " WHERE id_" . $this->table4 . '=' . (int) $id);
    }
}

