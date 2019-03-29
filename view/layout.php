<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Font Awesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <link rel="stylesheet" href="./web/style.css">

    <title><?= $title ?></title>
  </head>

  <body>

  <header>

    <nav class="navbar navbar-expand-md navbar-primary bg-light">
    <a class="navbar-brand" href="./index.php"><strong><em>MHP  <i class="fas fa-dragon"></i></em></strong> </a>
    <button class="navbar-toggler border-primary" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample04">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="formation.php">Formation </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="experience.php">Expérience</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="competence.php">Compétence</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="realisation.php">Réalisations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="formContact.php">Me contacter</a>
          </li>
        </ul>
       
        <span id="heure"></span><!--affiche l'heure créée avec la fonction js-->  
    </div>
    </nav>

    </header>    

    <div class="container">

      <div class="jumbotron">

       <div class="logo">
        <h1 class="display-4 text-center" >m<a class="hidden" href="userForm.php">h</a>p</h1>
        <p class="lead text-center"><em>Magali Piszczyglowa</em><br>Développeuse - Intégratrice Web </p>
       </div>

      </div>

      
      <div class="jumbotron jumbotron-fluid">
      
          <h1 class="display-4 text-center mt-4"><?= $title ?></h1><hr>

          <?= $content ?>

      </div><!-- fin jumbotron fluid-->

    </div><!--fin container-->
    
    <footer class="bg-light text-center text-primary p-2">
        &copy; 2019 - <i class="fas fa-dragon"></i> MHP - Mon site CV !!!
    </footer>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>


<script>
//fonction horloge numerique
$(function() {
  function Horloge() {
    var laDate = new Date();
    var h = laDate.getHours() + ":" + laDate.getMinutes() + ":" + laDate.getSeconds();
     $('#heure').text(h);
  }
setInterval(Horloge, 1000);
});

//fonction de modification de la photo sur la page profil

$(function(){
  $("#home-button").on({
    mouseenter: function(){
    $(this).attr('src','./web/img2 - Copie.JPG');
    },
    mouseleave: function(){
    $(this).attr('src','./web/img4.jpg');
    }
  });
});
</script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>