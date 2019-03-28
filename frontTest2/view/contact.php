<div class="social col-md-6">
  <ul>
    <li>
      <a href="https://github.com/Wimahel63" target="_blank"><img src="./web/github.png" alt="logo github" width="80" height="80">  </a>
    </li>
    <li>
      <a href="https://www.linkedin.com/in/magali-piszczyglowa-814a60171/" target="_blank"><img src="./web/linkedin.png" alt="logo linkedin" width="80" height="80">   </a>
    </li>
    <?php foreach($donnees as $value): ?>
    <li>
    <i class="fas fa-mobile-alt"><p style="font-size:30px;>">  <?= $value['telephone'] ?> </p></i>
    </li>
    <li>
    <a href="<?= $value['email'] ?>"><i class="fas fa-at"> </a></i>
    </li>

    <?php endforeach; ?>
  </ul>
</div>

<div class="formulaireContact col-md-6">

<form action="" method="post">
  <div class="form-group">
    <label for="formGroupFirstNameInput">Votre prénom</label>
    <input type="text" class="form-control" id="formGroupFirstNameInput" placeholder="prenom" name="firstname" required>
  </div>
  <div class="form-group">
    <label for="formGroupLastNameInput">Votre nom</label>
    <input type="text" class="form-control" id="formGroupLastNameInput" name="lastname" placeholder="nom" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Votre adresse mail</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Votre message</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
</div><!--fin class formulaireContact-->

<div class="clear"></div>