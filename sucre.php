<!-- header -->
<?php
include('partials/_header.php');
include('utils/data_sucre.php');
include('utils/pdo.php');
// Recuperer datas de ma BDD
/////////////////////////////
// 1- Query to get all plats
$sql = "SELECT * FROM sucre ORDER BY title";
// 2- Preformater la query
$query = $pdo->prepare($sql);
// 3- Execute la query
$query->execute();
// 4- Stock ma data dans variable
$platsSucres = $query->fetchAll();
// echo "<pre>";
// print_r($platsSucres);
// echo "</pre>";
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