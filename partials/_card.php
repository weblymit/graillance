<div class="card_container">
  <a href="show.php?id=<?= $plat['id'] ?>">
    <img src="<?= $plat['url_img'] ?>" alt="<?= $plat['title'] ?>" class="" />
    <div class="card_body">
      <h3><?= $plat['title'] ?></h3>
      <p>
        <?= substr($plat['content'], 0, 80) ?>
      </p>
    </div>
  </a>
</div>