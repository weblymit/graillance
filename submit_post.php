<!-- header -->
<?php include('partials/_header.php') ?>
<h1>Traitement du formulaire</h1>

<?php
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$title = $_POST['title'];
$content = $_POST['content'];
$category = $_POST['category'];
?>

<?php
if (empty($title) || empty($content) || empty($category)) {
  echo "<p class='text_error'>Il faut remplir tous les champs</p>";
} else { ?>
  <h2>Voici les info du plat à ajouter :</h2>
  <ul>
    <li>Nom de la recette : <?= htmlspecialchars($title) ?></li>
    <li>Description de la recette : <?= htmlspecialchars($content) ?></li>
    <li>Category de la recette : <?= htmlspecialchars($category) ?></li>
  </ul>
<?php }
?>



<!-- footer -->
<?php include('partials/_footer.php') ?>