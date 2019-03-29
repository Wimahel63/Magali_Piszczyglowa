<?php
//affichage des details lors de la methode select pour les competences et les realisations (photos)
 
?>

<div class="col-md-4 offset-md-4 list-group text-center mb-4">
    <?php foreach($donnees as $value): ?>  
        <img src="<?=$value ?>" alt="detail" width="400px">
    <?php endforeach; ?> 
</div>


    
   

