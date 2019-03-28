<!Doctype html>
<html lang="fr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Fontawseome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css"
    integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">

  <title>MHP</title>
</head>


<body>
  <?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=mon_site_cv', 'root', '');

if (isset($_POST['formconnexion']))
{
 
  $mailconnect = $_POST['mailconnect'];
  // $mailconnect = htmlspecialchars($_POST['mailconnect']);
  // $mdpconnect = sha1($_POST['mdpconnect']);
  $mdpconnect = $_POST['mdpconnect'];
  if (!empty($mailconnect) AND !empty($mdpconnect)) 
  {
    $requser = $bdd->prepare("SELECT * FROM t_user WHERE email = ? AND password = ? ");
    $requser->execute(array($mailconnect, $mdpconnect));

    $userexist = $requser->rowCount();

    if($userexist == 1)
    {
      $userinfo = $requser->fetch();
      $_SESSION['id'] = $userinfo['id'];
      $_SESSION['pseudo'] = $userinfo['pseudo'];
      $_SESSION['email'] = $userinfo['email'];
      header('Location: http://localhost/support_poissy/Magali_Piszczyglowa/mon_site_cv2/index.php');
    }
    else {
      $erreur = "Mauvaise connexion, l'email et / ou le mot de passe est incorrect";
      session_destroy();
    }
  }
  else {
    $erreur = 'Tous les champs doivent être complétés !';
  }
}
?>
  <!--Navbar Bootstrap  -->

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand text-grey text-center" href="index.php"><i class="fas fa-reply"></i></a>
  </nav>

  <div class="container">
    

    <div class="card text-center col-md-8 offset-md-2" style="width: 50rem;">
      <div class="card-body">
        <form method="post" action="">
          <div class="form-group">
            <label for="email">Email </label>
            <input type="email" class="form-control" id="mailconnect" aria-describedby="mailconnectHelp"
              placeholder="Entrer email" name="mailconnect">
          </div>
          <div class="form-group">
            <label for="mdpconnect">Mot de Passe</label>
            <input type="password" class="form-control" id="mdpconnect" placeholder="Entrer mot de passe"
              name="mdpconnect">
          </div>
          <div class="form-group form-check">

            <input type="submit" class="btn btn-primary" name='formconnexion' value='Se connecter' />
          </div>
        </form>
        <?php
        if (isset($erreur)) {
          
          echo '<font color= "red">' . $erreur .'</font>';
        }
        ?>
        <br>
        <br>
      </div>
    </div>
  </div>
  <br>
  <br>

  

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"
    integrity="sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp"
    crossorigin="anonymous"></script>
</body>

</html>






