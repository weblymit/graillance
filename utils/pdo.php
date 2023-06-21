<?php
// je créee mes variables
$serveur = "localhost";
$dbname = "lagraillance";
$login = "root";
$password = "root"; // or ""

try {
  $pdo = new PDO("mysql:host=$serveur;dbname=$dbname", $login, $password, array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    // Ne pas recuperer les elements dupliqués
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // Pour afficher les error
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
  ));
  // affiche message ok connexion
  // echo "Connexion établie !";
} catch (PDOException $e) {
  echo "Erreur de connexion : " . $e->getMessage();
}
