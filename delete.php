<?php
// 1-connexion a ma BDD
require_once("utils/pdo.php");
// requette delete
require_once("sql/delete-sql.php");

//6- redirection
header("location:index.php");
