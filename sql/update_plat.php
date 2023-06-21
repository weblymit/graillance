<?php
$sql = "UPDATE sucre SET title = :title, content = :content, url_img = :url_img, category = :category WHERE id= :id";

$query = $pdo->prepare($sql);

$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->bindValue(':title', $title, PDO::PARAM_STR);
$query->bindValue(':content', $content, PDO::PARAM_STMT);
$query->bindValue(':url_img', $image, PDO::PARAM_STMT);
$query->bindValue(':category', $category, PDO::PARAM_STR);

$query->execute();

// redirection vers la home page
// header("Location: index.php");
