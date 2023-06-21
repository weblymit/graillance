<!-- étapes -->
<!-- 
1- Recupère header
2- Fichier connexion a BDD
3- Recupere id du plat
4- Lorsque user appuie sur envoyer
  - Validation des inputs
  - No error message => modification dans BDD

 -->
<?php
include('partials/_header.php');
require_once('utils/pdo.php');

$error = [];
$errorMsg = "*Ce champs est obligatoire";
$success = false;

// 1- Je recupere le plat avec l'id de l'url
//////////////////////////////////////////
//1-verifie id existant et que c'est un int
require_once('sql/get_id.php');

// 2- J'insere les modification en BDD
///////////////////////////////////
// 1-je verifie que le btn submit fonctionne
if (!empty($_POST['submited'])) {
  // 2- je stock les data du user dans des variables + protection xss
  $title = trim(htmlspecialchars($_POST['title']));
  $content = trim(htmlspecialchars($_POST['content']));
  $category = trim(htmlspecialchars($_POST['category']));
  // print_r($image);

  // 3- Validation des imput
  // validation title
  if (!empty($title)) {
    // je verifie le nbr de caractere que le user a entrer
    // si les caracteres sont < 4 =>message error
    if (strlen($title) < 4) {
      $error['title'] = "*4 caractères minimum";
    } elseif (strlen($title) > 35) {
      $error['title'] = "*25 caractères maximum";
    }
  } else {
    $error['title'] = $errorMsg;
  }
  // validation du content
  if (!empty($content)) {
    // je verifie le nbr de caractere que le user a entrer
    // si les caracteres sont < 4 =>message error
    if (strlen($content) < 4) {
      $error['content'] = "*25 caractères minimum";
    } elseif (strlen($content) > 700) {
      $error['content'] = "*500 caractères maximum";
    }
  } else {
    $error['content'] = $errorMsg;
  }
  // traitement upload file
  //////////////////////////
  if (isset($_FILES['url_img']) && $_FILES['url_img']['error'] == 0) {

    // definir variables des inputs
    $files_name = $_FILES['url_img']['name'];
    $files_size = $_FILES['url_img']['size'];
    $files_tmp = $_FILES['url_img']['tmp_name'];
    $files_type = $_FILES['url_img']['type'];

    // 1-verifier la taille de l'image
    $max_size = 9000000; //2mo max
    if ($files_size <= $max_size) {
      // 1- verifer bonne extension du fichier
      $fileinfo = pathinfo($files_name);
      // recupere extension du fichier uploader
      $extension = $fileinfo['extension'];
      // Création tableau des EXTENSIONS AUTORISÉES
      $allowed_extension = ['jpg', 'jpeg', 'png'];

      // 2- verifie que l'extension du fichier est bien dans le tableau des extensions autorisées
      if (in_array($extension, $allowed_extension)) {
        // on renomme le fichier uploader par le user 
        $new_img_name = uniqid('IMG-', true) . "." . $extension;
        // dossier ou le fichier doit être mis
        $img_upload_path = 'image_upload/' . $new_img_name;
        // deplace le fichier qui se trove dans le dossier temporaire dans image_upload
        move_uploaded_file($files_tmp, $img_upload_path);
        // correspond à l'url du file uploader que l'on va enregistrer en BDD
        $image = $img_upload_path;
      } else {
        $error['url_img'] = "Le fichier n'est pas au bon format";
      }
    } else {
      $error['url_img'] = "Le fichier est trop lourd";
    }
  } else {
    $error['url_img'] = $errorMsg;
  }


  // 4-Tout est ok
  if (count($error) == 0) {
    // si tout est ok je passe success à true
    $success = true;
    // Insertion en BDD
    // 1-query
    require_once('sql/update_plat.php');
  }
}

?>

<h1 class="text_center uppercase">Modifier un plat</h1>
<?php
if ($success == false) { ?>
  <div class="container_form">
    <form method="POST" enctype="multipart/form-data">
      <!-- title -->
      <div class="container_input">
        <label for="">Titre du plat</label>
        <input type="text" name="title" class="block" value="<?= $plat['title'] ?>">
        <p class="text_error">
          <?php
          if (isset($error['title'])) {
            echo $error['title'];
          } ?>
        </p>
      </div>
      <!-- content -->
      <div class="container_input">
        <label for="">Description du plat</label>
        <textarea name="content" class="block" rows="12"><?= $plat['content'] ?></textarea>
        <p class="text_error">
          <?php
          if (isset($error['content'])) {
            echo $error['content'];
          } ?>
        </p>
      </div>
      <!-- category -->
      <div class="container_input">
        <label for="">Categorie</label>
        <select name="category" class="block">
          <option value="">Choisir catégorie</option>
          <option value="sucre" <?php if ($plat["category"] == "sucre") echo 'selected="selected"' ?>>Sucré</option>
          <option value="sale" <?php if ($plat["category"] == "sale") echo 'selected="selected"' ?>>Salé</option>
        </select>

      </div>
      <!-- image -->
      <div class="container_input">
        <label for="">Photo</label>
        <input type="file" name="url_img" class="block">
        <p class="text_error">
          <?php
          if (isset($error['url_img'])) {
            echo $error['url_img'];
          } ?>
        </p>
      </div>
      <!-- button submit -->
      <input class="update" type="submit" value="Modifier" name="submited">
    </form>
  </div>
<?php } else {
  echo "<p class='text_success'>Votre message a bien été modifié</p>";
}
?>

<!-- footer -->
<?php include('partials/_footer.php') ?>