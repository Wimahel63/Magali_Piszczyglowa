<?php 
// var_dump($donnees);
//echo '<pre>'; print_r($fields); echo '</pre>';
?>


<!-- Faites en sorte d'avoir 3 colonnes en plus : 
    - une colonne permettant de voir le détail de l'employé
    - une colonne pour modifier
    - une colonne pour supprimer
-->
<table class="table table-bordered text-center">
    <thead><tr>
        <th>ID</th><!-- à cause du array_splice permettant de ne pas affocher le champs idEmploye dans le formualire d'ajout, on déclare manuellement un entête, sinon décalage  -->
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
       // $value possède un tableau ARRAY avec les données d'un employé par tour de boucle
       // implode() permet d'extraire les données de chaque tableau ARRAY par employé
        ?>
        <tr>
            <td><?= implode('</td><td>', $value) ?></td>
            <td><a href="?op=select&id=<?= $value[$id] ?>" class="text-dark"><i class="fas fa-search"></i></a></td>
            <td><a href="?op=update&id=<?= $value[$id] ?>" class="text-dark"><i class="fas fa-wrench"></i></a></td>
            <td><a href="?op=delete&id=<?= $value[$id] ?>" class="text-dark"><i class="fas fa-trash-alt"></i></a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>

</table>
<div><a href="?op=add" class="btn btn-large btn-info mb-2"><i class="fas fa-plus"></i> Ajouter une nouvelle donnée</a></div>
