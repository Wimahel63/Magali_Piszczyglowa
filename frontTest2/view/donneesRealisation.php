<?php 
// var_dump($donnees);
//echo '<pre>'; print_r($fields); echo '</pre>';
?>
<?php 
//$bdd= new PDO('mysql:host=localhost; dbname=mon_site_cv', 'root', '');

//if(!empty($_FILES['photo']['name'])){//si name est different de vide, j'ai bien telecharger une photo
  // $nom_photo=uniqid(). '-' . $_FILES['photo']['name'];//je genere un id unique pour chaque photo avec uniqid(). Avec ce code je definis le nom de la photo
//    echo $nom_photo .'<br>';

   //$photoBdd= "http://localhost/support_poissy/frontTest2/web/$nom_photo";//me permet d'enregistrer le chemin dans la bdd. Il s'agit de l'url de l'image qui sera conservée en bdd
//    echo $photoBdd .'<br>';

 //  $photoDossier=$_SERVER['DOCUMENT_ROOT'] . "/support_poissy/frontTest2/web/$nom_photo";
  //  echo $_SERVER['DOCUMENT_ROOT'];
   //echo $photoDossier .'<br>';ce code me permet de definir le chemin complet du dossier. il me renvoie le chemin physique jusqu'à la racine du dossier, c-a-d,normalement, htdocs car c'est dans ce dossier que sont placés les dossiers relevant du php ( pour permettre l'utilisation de xampp lorsque l'on utilise xampp), afin de copier l'image dans le dossier, où elle sera stockée

  // copy($_FILES['photo']['tmp_name'], $photoDossier); //ici je copie ma photo dans mon dossier . Il me faut pour ça le nom temporaire de la photo, que je trouve avec $_FILES['image']['tmp_name'], puis le nom du dossier (le chemin) où l'apporter, chemin que j'ai definis dans ma variable $photoDossier ci-dessus


//$resultat=$bdd->exec("INSERT INTO t_realisation (photo) VALUES ('$photoBdd') ");//j'insere mes photos (leur url uniquement) uploadées dans ma bdd grâce à ce code . Ce code doit bien être dans la condition, sinon dès que l'on rafraichit la page, l'action s'effectue quand même et une insertion vide est faite dans la bdd, même si on ne choisit pas de fichier

//}

?>
   <!-- <form method="post" action="" enctype="multipart/form-data" class="col-md-6 offset-md-3 text-center">
        multipart/form-data obligatoire pour inserer une image 
        <div class="form-group">
            <label for="photo">photo</label>
            <input type="file" class="form-control" id="photo" name="photo">
            <small id="emailHelp" class="form-text text-muted">Uploader une photo</small>
        </div>

        <button type="submit" class="col-md-6 btn btn-info mb-5" >Upload</button>

    </form>

    <div class="row">

       ---------------------------- Récuperer les données ------------------------------>
        <table class="table table-hover text-center">
<!-- 
            <thead>
                <tr>
                    <th>ID</th> 
                    <?//php foreach($fields as $colonne):?>

                    <th>
                        <?//= $colonne['Field']; ?>
                    </th>

                    <?//php endforeach;?>

                    <th>Supp</th>

                </tr>
            </thead> -->

            <!----------- Récuperer les données interieur du tableau ----------->
            <?php foreach ($donnees as $value):?>

            <tr>
                <td>
                    <img src="<?= $value['photo']?>" width="100px">
                    
                </td>


                <!-- <td>
                    <a href="?op=delete&id=<?//=$value[$id] ?>" class="text-dark"><i class="fas fa-trash-alt"></i></a>
                </td> -->
            </tr>
            <?php endforeach;?>

        </table>
        <?php
            //$result = $bdd->query("SELECT photo FROM t_realisation");
            //  echo '<pre>';    
            //  print_r($result); 
            //  echo '</pre>'; 

           // while($data = $result->fetch(PDO::FETCH_ASSOC)):
                /* 
                    ()  = recuperer dans la base de données
                    les : remplace les {} pour pouvoir mettre du HTML 
                */
                // echo '<pre>';    
                // print_r($data); 
                // echo '</pre>';
                
            ?>
      <!--  <div class="col-md-4 text-center p-2">
            <img src="<?//= $data['photo'] ?>" alt="" class="col-md-6">
             reouverture d'une balise php 
        </div>-->
        <?//php endwhile; ?>
    

    <!-- </div>
</div> -->


<div class="clear"></div>