<!-- header -->
<?php
include('partials/_header.php');
include('utils/data_sale.php')
?>
<h1 class="text_center uppercase">Nos Plats salés</h1>

<div class="section_card py_20">
  <?php
  foreach ($platsSales as $plat) {
    include('partials/_card.php');
  }

  ?>
</div>

<!-- footer -->
<?php include('partials/_footer.php') ?>