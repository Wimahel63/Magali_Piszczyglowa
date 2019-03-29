<?php 
//Comme pour les competences, ce fichier sert à afficher les realisations mais aussi a uploader des fichiers
?>

<table class="table table-bordered text-center">
    <thead><tr>
        <!--<th>ID</th> à cause du array_splice permettant de ne pas afficher le champs idEmploye dans le formualire d'ajout, on déclare manuellement un entête, sinon décalage  -->
    <?php foreach($fields as $value): ?>
        <th><?= $value['Field'] ?></th>
    <?php endforeach; ?>
        <th>Voir</th>
        <th>Modifier</th>
        <th>Supprimer</th>
    </tr></thead>
    <tbody>
    <?php foreach($donnees as $value): 
       // echo '<pre>'; print_r($value); echo '</pre>';
       // $value possède un tableau ARRAY avec les données d'une realisation par tour de boucle
       // implode() permet d'extraire les données de chaque tableau ARRAY par realisation
        ?>
        <tr>
           <!-- <td><?= implode('</td><td>', $value) ?></td>-->
              <td><img src="<?=  $value['photo'] ?>" width="80;"></td>
            <td><a href="?op=select&id=<?= $value[$id] ?>" class="text-dark"><i class="fas fa-binoculars"></i></a></td>
            <td><a href="?op=update&id=<?= $value[$id] ?>" class="text-dark"><i class="fas fa-tools"></i></a></td>
            <td><a href="?op=delete&id=<?= $value[$id] ?>" class="text-dark"><i class="fas fa-cut"></i></a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>

</table>
<!-- <div><a href="?op=add" class="btn btn-large btn-info mb-2"><i class="fas fa-plus"></i> Ajouter une nouvelle donnée</a></div> -->
<?php 
$bdd= new PDO('mysql:host=localhost; dbname=mon_site_cv', 'root', '');

if(!empty($_FILES['photo']['name'])){//si name est different de vide, j'ai bien telechargé une photo
   $nom_photo=uniqid(). '-' . $_FILES['photo']['name'];//je genere un id unique pour chaque photo avec uniqid(). Avec ce code je definis le nom de la photo
//    echo $nom_photo .'<br>';

   $photoBdd= "http://localhost/support_poissy/Magali_Piszczyglowa/mon_site_cv2/view/$nom_photo";//me permet d'enregistrer le chemin dans la bdd. Il s'agit de l'url de l'image qui sera conservée en bdd
//    echo $photoBdd .'<br>';

   $photoDossier=$_SERVER['DOCUMENT_ROOT'] . "/support_poissy/Magali_Piszczyglowa/mon_site_cv2/view/$nom_photo";
//    echo $_SERVER['DOCUMENT_ROOT'];
   //echo $photoDossier .'<br>';ce code me permet de definir le chemin complet du dossier. il me renvoie le chemin physique jusqu'à la racine du dossier, c-a-d,normalement, htdocs car c'est dans ce dossier que sont placés les dossiers relevant du php ( pour permettre l'utilisation de xampp lorsque l'on utilise xampp), afin de copier l'image dans le dossier, où elle sera stockée

   copy($_FILES['photo']['tmp_name'], $photoDossier); //ici je copie ma photo dans mon dossier . Il me faut pour ça le nom temporaire de la photo, que je trouve avec $_FILES['image']['tmp_name'], puis le nom du dossier (le chemin) où l'apporter, chemin que j'ai definis dans ma variable $photoDossier ci-dessus


$resultat=$bdd->exec("INSERT INTO t_realisation (photo) VALUES ('$photoBdd') ");//j'insere mes photos (leur url uniquement) uploadées dans ma bdd grâce à ce code . Ce code doit bien être dans la condition, sinon dès que l'on rafraichit la page, l'action s'effectue quand même et une insertion vide est faite dans la bdd, même si on ne choisit pas de fichier
}
?>

<!--formulaire d'upload de fichiers-->
<div>
<form method="post" action="" enctype="multipart/form-data" class="col-md-6 offset-md-3 text-center">
  <div class="form-group">
    <label for="photo">Ajouter un document</label>
    <input type="file" class="form-control-file btn btn-large btn-info mb-2" id="photo" name="photo"><!--bien penser a mettre l'attribut name, sinon ca ne fonctionne pas-->
  </div>
  <button type="submit" class="btn btn-primary">Valider</button>
</form>
</div>
<!-- <div class="col-md-6 text-center p-2" id="realisation">
        <img src="" alt="realisation" class="col-md-6" id="mesReal">
</div> -->

<!-- <?php foreach($donnees as $value): ?>
<div class="container">
<div id="carousel">
			<figure><img src="<?= $value['photo'] ?> " alt=" " class="slide"></figure>
			<figure><img src="http://lorempixel.com/186/116/nature/2" alt=""></figure>
			<figure><img src="http://lorempixel.com/186/116/nature/3" alt=""></figure>
			<figure><img src="http://lorempixel.com/186/116/nature/4" alt=""></figure>
			<figure><img src="http://lorempixel.com/186/116/nature/5" alt=""></figure>
			<figure><img src="http://lorempixel.com/186/116/nature/6" alt=""></figure>
			<figure><img src="http://lorempixel.com/186/116/nature/7" alt=""></figure>
			<figure><img src="http://lorempixel.com/186/116/nature/8" alt=""></figure>
			<figure><img src="http://lorempixel.com/186/116/people/9" alt=""></figure>
		</div></div>
<?php endforeach; ?> -->

<div class="clear"></div>