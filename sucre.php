<!-- étapes -->
<!-- 
1- Recupère header
2- Fichier connexion a BDD
3- Requete pour recuperer datas sucrées
 -->
<?php
include('partials/_header.php');
include('utils/pdo.php');
require('sql/plats_sucre.php'); // connexion BDD

?>
<h1 class="text_center uppercase">Nos Plats sucrées</h1>

<div class="section_card py_20">
  <?php
  foreach ($platsSucres as $plat) {
    include('partials/_card.php');
  }
  ?>
</div>
<!-- footer -->
<?php include('partials/_footer.php') ?>