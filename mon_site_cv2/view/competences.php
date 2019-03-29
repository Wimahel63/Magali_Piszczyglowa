<?php 
//Même vue que pour experience et formation a ceci pret qu'ici j'ai ds balises img pour afficher mes donnees pour la methode selectAll et un input file pour l'upload des fichiers
?>



<table class="table table-bordered text-center">
    <thead><tr>
        
    <?php foreach($fields as $value): ?>
        <th><?= $value['Field'] ?></th>
    <?php endforeach; ?>
        <th>Voir</th>
        <th>Modifier</th>
        <th>Supprimer</th>
    </tr></thead>
    <tbody>
    <?php foreach($donnees as $value): 
       
       // implode() permet d'extraire les données de chaque tableau ARRAY par competence
        ?>
        <tr>
           <!-- <td><?= implode('</td><td>', $value) ?></td> -->
              <td><img src="<?=  $value['competence'] ?>" width="90;" height="110;"></td>
            <td><a href="?op=select&id=<?= $value[$id] ?>" class="text-dark"><i class="fas fa-binoculars"></i></a></td>
            <td><a href="?op=update&id=<?= $value[$id] ?>" class="text-dark"><i class="fas fa-tools"></i></a></td>
            <td><a href="?op=delete&id=<?= $value[$id] ?>" class="text-dark"><i class="fas fa-cut"></i></a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>

</table>

<?php 
$bdd= new PDO('mysql:host=localhost; dbname=mon_site_cv', 'root', '');

if(!empty($_FILES['competence']['name'])){//si name est different de vide, j'ai bien telecharger une photo
   $nom_photo=uniqid(). '-' . $_FILES['competence']['name'];//je genere un id unique pour chaque photo avec uniqid(). Avec ce code je definis le nom de la photo
//    echo $nom_photo .'<br>';

   $photoBdd= "http://localhost/support_poissy/Magali_Piszczyglowa/mon_site_cv2/view/$nom_photo";//me permet d'enregistrer le chemin dans la bdd. Il s'agit de l'url de l'image qui sera conservée en bdd
//    echo $photoBdd .'<br>';

   $photoDossier=$_SERVER['DOCUMENT_ROOT'] . "/support_poissy/Magali_Piszczyglowa/mon_site_cv2/view/$nom_photo";
//    echo $_SERVER['DOCUMENT_ROOT'];
   //echo $photoDossier .'<br>';ce code me permet de definir le chemin complet du dossier. il me renvoie le chemin physique jusqu'à la racine du dossier, c-a-d,normalement, htdocs car c'est dans ce dossier que sont placés les dossiers relevant du php ( pour permettre l'utilisation de xampp lorsque l'on utilise xampp), afin de copier l'image dans le dossier, où elle sera stockée

   copy($_FILES['competence']['tmp_name'], $photoDossier); //ici je copie ma photo dans mon dossier . Il me faut pour ça le nom temporaire de la photo, que je trouve avec $_FILES['image']['tmp_name'], puis le nom du dossier (le chemin) où l'apporter, chemin que j'ai definis dans ma variable $photoDossier ci-dessus


$resultat=$bdd->exec("INSERT INTO t_skill (competence) VALUES ('$photoBdd') ");//j'insere mes photos (leur url uniquement) uploadées dans ma bdd grâce à ce code . Ce code doit bien être dans la condition, sinon dès que l'on rafraichit la page, l'action s'effectue quand même et une insertion vide est faite dans la bdd, même si on ne choisit pas de fichier
}
?>
<div>
<form method="post" action="" enctype="multipart/form-data" class="col-md-6 offset-md-3 text-center">
  <div class="form-group">
    <label for="competence">Ajouter un document</label>
    <input type="file" class="form-control-file btn btn-large btn-info mb-2" id="competence" name="competence"><!--bien penser a mettre l'attribut name, sinon ca ne fonctionne pas-->
  </div>
  <button type="submit" class="btn btn-primary">Valider</button>
</form>
 <!-- <?//php foreach($donnees as $value): ?>
<div class="col-md-6 text-center p-2" id="realisation">
        <img src="<?//= $value['competence'] ?>" alt="realisation" class="col-md-6" id="mesReal">
</div>
<?//php endforeach; ?> -->

</div>


<div class="clear"></div>