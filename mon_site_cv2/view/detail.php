<?php
//echo '<pre>'; print_r($donnees); echo '</pre>';
?>

<ul class="col-md-4 offset-md-4 list-group text-center mb-4">
    <?php foreach($donnees as $value): ?>  
        <li class="list-group-item"><?=$value ?></li>
    <?php endforeach; ?> 
</ul>


    <a href="index.php" class="btn btn-large btn-info mb-2"><i class="fas fa-plus"></i> Retour</a>
   

