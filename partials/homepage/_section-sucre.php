<?php
require_once('sql/plats_sucres_limit.php')
?>

<section class="py_20">
  <h2>Nos plats sucrés</h2>
  <div class="section_card py_20">
    <?php
    foreach ($platsSucres as $plat) {
      include('partials/_card.php');
    }

    ?>
  </div>
</section>