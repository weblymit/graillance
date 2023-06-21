<?php
//1- ecriture de la requette
$sql = "INSERT INTO sucre(title, url_img, content, category) VALUES(:title, :url_img, :content, :category)";

// 2- prepare la requette
$query = $pdo->prepare($sql);

// 3- on associe chaque requette à sa valeur et protection contre injection SQL
$query->bindValue(':title', $title, PDO::PARAM_STR);
$query->bindValue(':url_img', $image, PDO::PARAM_STMT);
$query->bindValue(':content', $content, PDO::PARAM_STMT);
$query->bindValue(':category', $category, PDO::PARAM_STR);

// 4- execution de la requette
$query->execute();

// 5- redirection
// header("Location: index.php");
