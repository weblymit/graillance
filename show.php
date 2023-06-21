<?php
include('partials/_header.php');
include('utils/pdo.php'); // connexion BDD

// Pour afficher un plat on a besoin de faire la requette vers la BDD avec l'id du plat
// Verifie id existant et que c'est un int sinon  redirection homepage
require_once('sql/get_id.php');

?>




<h1 class="text_center uppercase">Information sur le plat</h1>

<div class="container_show">
  <div class="box_left">
    <?php
    if ($plat["url_img"] != null) { ?>
      <img src="<?= $plat["url_img"] ?>" alt="<?= $plat["title"] ?>" class="img_responsive">
    <?php } else { ?>
      <img src="paris-brest.jpeg" alt="paris brest">
    <?php }
    ?>
  </div>
  <div class="box_right">
    <h1 class="uppercase"><?= $plat["title"] ?></h1>
    <p class=""><?= $plat["content"] ?></p>
    <div class="container_btn">
      <a href="update.php?id=<?= $plat["id"] ?>" class="update">Modifier</a>
      <a href="delete.php?id=<?= $plat["id"] ?>" class="delete">Supprimer</a>
    </div>
  </div>
</div>

<!-- footer -->
<?php include('partials/_footer.php') ?>