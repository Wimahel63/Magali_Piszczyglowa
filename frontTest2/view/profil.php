
<div class="card" id="profile" style="max-width: 25rem;">
<?php foreach($donnees as $key => $value): ?>
<a href="#">
  <img class="card-img-top" src="./web/img4 - Copie.JPG" alt="Card image cap" id="home-button" width="250" height="250"></a>
  <div class="card-body">
    <p class="card-text">
    Bienvenue sur mon site CV.<br> Je suis <?= $value['prenom'] . " " . $value['nom'] ?> . Née le <?= $value['date_naissance'] ?>, je suis actuellement âgée de  <?= $value['age']?> ans. Je vis à <?= $value['ville'] ?> , en <?=$value['pays']?>.</p>

  </div>
</div>
<?php endforeach; ?>



