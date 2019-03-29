<?//php foreach($donnees as $value): ?>

<!-- <table class="table"  >
  
  <tbody>
    <tr>
      <th scope="row"><?= $value['id_t_skill']?></th> 
      <img src="<?= $value['competence']?>" width="150" height="150">-->
          
    <!-- </tr> 
  </tbody>
</table> -->

<?//php endforeach; ?>
<div id="carousel"><?php foreach($donnees as $value): ?>
			<figure><img src="<?= $value['competence'] ?> " alt=" " class="slide" width="186" height="116"></figure><?php endforeach; ?>
			<!-- <figure><img src="" alt="" class="slide"></figure>
			<figure><img src="<?= $value['competence'] ?>" alt="" class="slide"></figure>
			<figure><img src="<?= $value['competence'] ?>" alt="" class="slide"></figure>
			<figure><img src="<?= $value['competence'] ?>" alt="" class="slide"></figure>
			<figure><img src="<?= $value['competence'] ?>" alt="" class="slide"></figure>
			<figure><img src="<?= $value['competence'] ?>" alt="" class="slide"></figure>
			<figure><img src="<?= $value['competence'] ?>" alt="" class="slide"></figure>
			<figure><img src="<?= $value['competence'] ?>" alt="" class="slide"></figure> -->
    </div>
</div>