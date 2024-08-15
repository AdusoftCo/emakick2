<?php session_start();
include 'conexion.php';
include 'calculos.php';

$opcion = isset($_GET['option']) ? $_GET['option'] : '';
$conexion = new conexion();


// Check if a search query is submitted
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['searchQuery2'])) {
    $numTables = 1;
    $searchQuery = $_GET['searchQuery2'];
    
    $searchResult = $conexion->search("%$searchQuery%", $opcion, $numTables);

    if ($searchResult) {
        $results = $searchResult['data'];
        $table = $searchResult['table'];
        displaySearchResults($results, $table);
    }
    exit();
} 

if ($opcion) {
               
        $texto = strtoupper($opcion);

        #Seccion que TOMA variables pa Borrar o Modificar Registro
        if ($_GET) {
            if (isset($_GET['modificar'])) {
                $id = $_GET['modificar'];
                header("Location:modificar.php?modificar=" . $id);
                die();
            }

            if(isset($_GET['registrar'])) {
                header("Location:registrar.php?option=" . $opcion);
                die();
            }

            if (isset($_GET['borrar'])) {
                $id = $_GET['borrar'];
                $conexion = new conexion();

                #borramos el registro de la base 
                $sql = "DELETE FROM $opcion WHERE $opcion.`id` =".$id;
                $id_proyecto = $conexion->ejecutar($sql);
                #para que no intente borrar muchas veces
                header("Location:galeria.php?option=" . $opcion);
                die();
            }
        }
    }

    /*$sql = "SELECT " . $opcion . ".id, " . $opcion . ".cod_art, " . $opcion . ".id_prov, "
        . $opcion . ".descripcion, " . $opcion . ".precio_doc, " . $opcion . ".precio_oferta, "
        . $opcion . ".fecha_alta, " . $opcion . ".imagen, fabricants.nombre AS fabricant_name,
        stocking.cant_doce AS stock_cantidad
        FROM " . $opcion . "
        LEFT JOIN fabricants ON " . $opcion . ".id_prov = fabricants.id
        LEFT JOIN stocking ON " . $opcion . ".id = stocking.product_id AND stocking.categoria = '" . $opcion . "'";*/

$sql = "SELECT " . $opcion . ".id, " . $opcion . ".cod_art, " . $opcion . ".id_prov, "
        . $opcion . ".descripcion, " . $opcion . ".precio_doc, " . $opcion . ".precio_oferta,"
        . $opcion . ".fecha_alta, " . $opcion . ".imagen, fabricants.nombre AS fabricant_name 
        FROM " . $opcion . "
        LEFT JOIN fabricants ON " . $opcion . ".id_prov = fabricants.id";

    $opData = $conexion->consultar($sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<body>
    <div class="fixed-section">
        <div class="d-flex align-items-center justify-content-between">
            <a href="index_admin.php" class="back-link"><i class="fas fa-arrow-left"></i></a>
            <!--Formulario Searching -->
            <div id="search-box" class="mt-3">
                <form id="search-form" method="get" action="galeria.php" class="d-flex">
                    <input type="text" id="searchQuery2" name="searchQuery2" placeholder="Buscar registros ..."
                        class="form-control p-1">
                    <button type="submit" class="search-icon"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        
        <div class="row d-flex justify-content-center mb-0">
            <div class="col-md-8 col-sm-10 mt-3">
                <h2><b><i>SECCION <?php echo $texto; ?></i></b></h2>
                <div class="ms-4 mt-4">
                    <a class="btn boton" name="registrar" id="registrar" href="registrar.php?option=<?php echo $opcion; ?>" >
                        <span class="text-span">ALTA NUEVO ARTICULO</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- TABLA CON LOS REGISTROS ACTUALES -->
    <!--Mobile Design From Here-->
    <div class="row d-flex justify-content-center mb-5">
        <div class="col-md-10 col-sm-6 mt-3">
            <div id="search-results-conta">
                <!-- Search results will be inserted here dynamically -->
                <?php
                if ($opcion) {
                    foreach ($opData as $op) {
                        displaySearchResult($op, $opcion);
                    }
                }
                ?>
            </div>
            <!--<table class="table tabla__galeria" style="background-color:#FAFAFA;">
                 Table content ... 
            </table>-->
        </div>
    </div>
    
    
    <!-- Include jQuery directly from CDN <a  class="btn btn-warning" href="?modificar=<?php echo $op['id']; ?>">Modificar</a>-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                
    <script>
        const searchForm2 = document.getElementById('search-form');
        const searchResultsContainer2 = document.getElementById('search-results-conta');

        searchForm2.addEventListener('submit', async (event) => {
        event.preventDefault(); // Prevent default form submission
        const searchQuery2 = document.getElementById('searchQuery2').value;

        // Make an AJAX request to galeria.php with the searchQuery
        try {
            const response = await fetch(`galeria.php?option=<?php echo $opcion; ?>&searchQuery2=${searchQuery2}`);
            const html = await response.text();
            console.log('Respuesta: ', response);
            
            // Update the page content with the search results
            searchResultsContainer2.innerHTML = html;
            console.log('Respuesta: ', searchResultsContainer2);
            } catch (error) {
                console.error('Error:', error);
            }
        });
    </script>

    <script type="text/javascript">
        function wantdelete(e) {
            var respuest2 = confirm("Desea realmente BORRAR el Registro ...?");
            if (respuest2 == false) {
                e.preventDefault();
            } else {
                alert('BORRADO Con fir ma do !!!');
            }
        }
    </script>
</body>
</html>