<?php
require_once('sql/plats_sales_limit.php')
?>

<section class="py_20">
  <h2>Nos plats salés</h2>
  <div class="section_card py_20">
    <?php
    foreach ($platsSales as $plat) {
      include('partials/_card.php');
    }

    ?>
  </div>
</section>