
<table class="table table-hover text-center">

<!----------- Récuperer les données interieur du tableau ----------->
<?php foreach ($donnees as $value):?>

    <tr>
        <td>
            <img src="<?= $value['photo']?>" width="100px" class="realisationHover">
        </td>
    </tr>
<?php endforeach;?>

</table>
       


<div class="clear"></div>