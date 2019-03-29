<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="..." alt="Card image cap">
  <div class="card-body">
  <?php foreach($donnees as $value): ?>
    <h5 class="card-title"><?= $value['pseudo']?></h5>
    <p class="card-text"><?= implode($value) ?></p>
    <a href="?op=update&id=<?= $value['id']?>" class="btn btn-primary">Modifier</a>
  </div>
</div>
<?php endforeach; ?>