<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'calculos.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Results-Gral</title>
        <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
        
</body>
</html>
<!-- Search results will be inserted here dynamically -->
<div class="row d-flex justify-content-center mb-5">
        <div class="col-md-10 col-sm-6 mt-3">
                <div id="search-results-container">
                        <!-- Insertion will begin here dynamically -->
                        <?php
                        if (!empty($results)) {
                                echo ('resultas : ' . $results);
                                foreach ($results as $result) {
                                        displaySearchResult($result, $opcion);
                                }
                        }
                        ?>
                </div>
        </div>
</div>
