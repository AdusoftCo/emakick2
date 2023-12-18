<?php
include "conexion.php";

$searchQuery = $_GET['query'];

// Perform a search operation in your tables based on the $searchQuery
// Modify this query based on your database structure and requirements
$sql = "SELECT * FROM table1 WHERE Descripcion LIKE :searchQuery 
        UNION
        SELECT * FROM table2 WHERE Descripcion LIKE :searchQuery
        UNION
        SELECT * FROM table3 WHERE Descripcion LIKE :searchQuery
        UNION
        SELECT * FROM table4 WHERE Descripcion LIKE :searchQuery";


$stmt = $conexion->consultar($sql);
$stmt->bindValue(':searchQuery', "%$searchQuery%", PDO::PARAM_STR);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the results as JSON
echo json_encode($results);
?>