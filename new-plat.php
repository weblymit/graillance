<!-- header -->
<?php
include('partials/_header.php');

$error = [];
$errorMsg = "*Ce champs est obligatoire";
$success = false;

// 1-je verifie que le btn submit fonctionne
if (!empty($_POST['submited'])) {

  // 2- je stock les data du user dans des variables
  $title = $_POST['title'];
  $content = $_POST['content'];
  $category = $_POST['category'];
  $image = $_FILES['url_img'];
  // print_r($image);

  // 3- Validation des imput
  // validation title
  if (!empty($title)) {
    // je verifie le nbr de caractere que le user a entrer
    // si les caracteres sont < 4 =>message error
    if (strlen($title) < 4) {
      $error['title'] = "*4 caractères minimum";
    } elseif (strlen($title) > 25) {
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
    } elseif (strlen($content) > 25) {
      $error['content'] = "*500 caractères maximum";
    }
  } else {
    $error['content'] = $errorMsg;
  }
  // validation img
  if (isset($_FILES['url_img']) && $_FILES['url_img']['error'] == 0) {
    // definir variables
    $files_name = $_FILES['url_img']['name'];
    $files_size = $_FILES['url_img']['size'];
    $files_tmp = $_FILES['url_img']['tmp_name'];
    $files_type = $_FILES['url_img']['type'];

    // 1-verifier la taille de l'image
    $max_size = 9000000; //2mo max
    if ($files_size <= $max_size) {
      // 1- verifer bonne extension du fichier
      $fileinfo = pathinfo($files_name);
      // recupere extension fichier user
      $extension = $fileinfo['extension'];
      // EXTENSION AUTORISÉ
      $allowed_extension = ['jpg', 'jpeg', 'png'];

      // 2- verifie que l'extension du fichier est bien dans le tableau des extension autorisé
      if (in_array($extension, $allowed_extension)) {
        // verie qe le dossier upload existe sinon je le crée
        // if (!file_exists('image_uplaod')) {
        //   mkdir('image_upload');
        // }

        // deplace le fichier qui se trove dans le dossier temporaire dans image_upload
        move_uploaded_file($files_tmp, 'image_upload/' . basename($files_name));
      } else {
        $error['url_img'] = "Le fichier n'est pas au bon format";
      }
    } else {
      $error['url_img'] = "Le fichier est trop lourd";
    }
  }

  // 4-Tout est ok
  // print_r(count($error));
  if (count($error) == 0) {
    // si tout est ok je passe success à true

    $success = true;
    // Insertion en BDD
    // 1-query
    $sql = "INSERT INTO sucre(title, content, category, url_img)";
  }
}

?>

<h1 class="text_center uppercase">Ajouter un plat</h1>
<?php
if ($success == false) { ?>
  <div class="container_form">
    <form method="POST" enctype="multipart/form-data">
      <!-- title -->
      <div class="container_input">
        <label for="">Titre du plat</label>
        <input type="text" name="title" class="block" value="<?php
                                                              if (isset($_POST['title'])) {
                                                                echo $_POST['title'];
                                                              } ?>">
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
        <textarea name="content" class="block"><?php if (isset($_POST['content'])) {
                                                  echo $_POST['content'];
                                                } ?></textarea>
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
          <option value="sucre">Sucré</option>
          <option value="sale">Salé</option>
        </select>
        <p class="text_error">
          <?php
          if (isset($_POST['category'])) {
            echo "*Ce champs est obligatoire";
          } ?>
        </p>
      </div>
      <!-- image -->
      <div class="container_input">
        <label for="">Photo</label>
        <input type="file" name="url_img" class="block">
      </div>
      <!-- button submit -->
      <input class="btn" type="submit" value="Envoyer" name="submited">
    </form>
  </div>
<?php } else {
  echo "<p class='text_success'>Votre message a bien été envoyé</p>";
}
?>

<!-- footer -->
<?php include('partials/_footer.php') ?>