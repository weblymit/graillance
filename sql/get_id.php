<?php

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
  // 2- je nettoie mon id contre xss
  $id = htmlspecialchars($_GET['id']);
  // 3- requette (query in english) vers BDD
  $sql = "SELECT * FROM sucre WHERE id=:id";
  // 4- préparation de la requette
  $query = $pdo->prepare($sql);
  // 5- securiser la requette contre injection sql
  $query->bindValue(':id', $id, PDO::PARAM_INT);
  // 6- executer la requette vers la BDD
  $query->execute();
  // 7- on stock tout ds une variable
  $plat = $query->fetch();

  if (!$plat) {
    header("Location: index.php");
  }
} else {
  header("Location: index.php");
}
