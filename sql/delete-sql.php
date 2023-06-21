<?php
// 2- recup' id ds url & nettoie
$id = htmlspecialchars($_GET["id"]);
// 3- requette vers BDD
$sql = "DELETE FROM sucre WHERE id=?";
//4- prepare ma requette
$query = $pdo->prepare($sql);
// 5- on execute le requette
$query->execute([$id]);
