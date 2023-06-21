<?php

// Recuperer datas de ma BDD
/////////////////////////////
// 1- Query to get all plats
$sql = "SELECT * FROM sucre WHERE category = 'sucre' ORDER BY title LIMIT 3";
// 2- Preformater la query
$query = $pdo->prepare($sql);
// 3- Execute la query
$query->execute();
// 4- Stock ma data dans variable
$platsSucres = $query->fetchAll();
