<!-------------div a envoyer dans mon layout dans la div id profil
<?//php foreach($donnees as $key => $value): ?>
<div class="card bg-light mb-3" style="max-width: 18rem;">
  <div class="card-header">Header</div>
  <div class="card-body">
    <h5 class="card-title">Light card title</h5><ul>
    <li> 
     <p class="card-text"><?//=implode( $value )?></p></li> 
    </ul>
  </div>
</div>
<?//php endforeach; ?>------------------->




<!-------------test si deux tables peuvent avoir leurs champs nommés pareil-------------->

<?php foreach($donnees as $key => $value): ?>
<div class="card bg-white mb-3" style="max-width: 18rem;" id="donnees">
  <div class="card-header"><h4><?= $value['intitule']?></h4></div>
  <div class="card-body">
    <h5 class="card-title"><?= $value['lieu']?></h5>
     <p class="card-text"><?= $value['date_debut']?> - <?= $value['date_fin']?></p>
     <p class="card-text"><?= $value['description']?></p>  
  </div>
</div>
<?php endforeach; ?>

<div class="clear"></div>

<!-- <div > 
<ul class="col-md-4 offset-md-4 list-group text-center mb-4" id="p1">
    <?php foreach($donnees as $key => $value): ?>
        <li class="list-group-item"><?=implode( $value )?></li>
    <?php endforeach; ?>
</ul>
 </div> -->
<!------------------------------------> 



