<style type="text/css">img{
  position:absolute;
  top:0px;
  left:0px;
  display:none;
  
}
</style>

<div class="card" id="profile" style="max-width: 25rem;">
<?php foreach($donnees as $key => $value): ?>
  <img class="card-img-top" src="./web/img4 - Copie.JPG" alt="Card image cap" id="img4">
  <img class="card-img-top" src="./web/img3 - Copie.JPG" alt="Card image cap" id="img4">
  <img class="card-img-top" src="./web/img2 - Copie.jpg" alt="Card image cap" id="img2">
  <img class="card-img-top" src="./web/dino.jpg" alt="Card image cap" id="img1">
  
  
  <div class="card-body">
    <p class="card-text">
    Bienvenue sur mon site CV.<br> Je suis <?= $value['prenom'] . " " . $value['nom'] ?> . Née le <?= $value['date_naissance'] ?>, je suis actuellement âgée de  <?= $value['age']?> ans. Je vis à <?= $value['ville'] ?> , en <?=$value['pays']?>.</p>

  </div>
</div>
<?php endforeach; ?>

<script src="jquery.js"></script>
<script>
  $(function()
  {
    var i=0;
    affiche();

    function affiche()
    {
      i++;
      if (i==1) precedent='#img4'
      else precedent='#img'+(i-1);
     var actuel='#img'+i;
     $(precedent).fadeOut (2000);
     $(actuel).fadeIn(2000);
     if(i==4) i=0;
    }
    setInterval(affiche,2000);
  });
  </script>