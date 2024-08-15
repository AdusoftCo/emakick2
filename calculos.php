<?php
function calculos ($id_prov, $costo) {
    if ($id_prov != 13 && $id_prov != 16 && $id_prov != 24 && $id_prov != 17 ) 
        {
            $a = (30 * $costo) / 100;
            $docena = $costo + $a;
            $f = $costo / 12;
            $g = (55 * $f) / 100;
            $oferta = $f + $g;
            return array($docena, $oferta);
        } elseif ($id_prov == 13)
            {
                $a = (25 * $costo)/ 100;
                $b = $costo - $a;
                $c = (12 * $b)/ 100;
                $d = $b + $c;
                $e = (26 * $d)/ 100;
                $docena = $d + $e;
                $f = $d / 12;
                $g = (55 * $f)/ 100;
                $oferta = $f + $g;
                return array($docena, $oferta);
            } elseif ($id_prov == 16 || $id_prov == 24)
                {
                    $a = (20 * $costo) / 100;
                    $b = $costo - $a;
                    $c = (7 * $b) / 100;
                    $d = $b + $c;
                    $doce = $d * 12;
                    $e = (30 * $doce) / 100;
                    $docena = $doce + $e;
                    $f = (50 * $d) / 100;
                    $oferta = $f + $d;
                    return array($docena, $oferta);
                } elseif ($id_prov == 17)
                    {
                        $a = (25 * $costo) / 100;
                        $docena = $costo + $a;
                        $b = (30 * $costo) / 100;
                        $oferta = $b + $costo;
                        return array($docena, $oferta);
                    } else {
                            $a = (22 * $costo) / 100;
                            $docena = $costo + $a;
                            $f = $costo / 12;
                            $g = (55 * $f) / 100;
                            $oferta = $f + $g;
                            return array($docena, $oferta);
                    }
                    
};

function displaySearchResults($results, $opcion)
{
    if (empty($results)) {
        echo "No hay registros con esa Palabra!.";
        return;
    }

    foreach ($results as $result) {
        displaySearchResult($result, $opcion);
    }
}

function displaySearchResult($result, $opcion)
{
    $color = '#008f39';
    $dateNow = $result['fecha_alta'];
    $dateHere = date("d-m-Y", strtotime($dateNow));

    echo '<div class="col mb-4">';
    echo    '<div class="card border border-3 shadow w-100">';
    echo        '<div class="table-responsive">';
    echo            '<table class="table">';
    echo                '<tbody>';
    echo                    '<tr>';
    echo                        '<th scope="col">Imagen:</th>';
    echo                            '<td><img src="/emakick2/imagenes/' . $result['imagen'] . '" style="max-width: 100px; max-height: 75px;"></td>';
    echo                    '</tr>';
    echo                    '<tr>';
    echo                        '<th scope="col">Cod.Artículo:</th>';
    echo                            '<td>' . $result['cod_art'] . '&nbsp; &nbsp; &nbsp;  Modificado: <span style="color: '. $color . ';">' . $dateHere . '</span></td>';
    echo                    '</tr>';
    echo                    '<tr>';
    echo                        '<th scope="col">Proveedor : </th>';
    echo                            '<td>' . (isset($result['fabricant_name']) ? $result['fabricant_name'] : '') . '</td>';
    echo                    '</tr>';
    echo                    '<tr>';
    echo                        '<th scope="col">Descripción : </th>';
    echo                            '<td>' . $result['descripcion'] . '</td>';
    echo                    '</tr>';
    //echo                    '<tr>';
    //echo                        '<th scope="col">Cantidad Docenas: </th>';
    //echo                            '<td>' . getStockCantidad($result['id'], $opcion) . '</td>';
    //echo                    '</tr>';
    echo                    '<tr>';
    echo                        '<th scope="col">Precio Docena: $</th>';
    echo                            '<td>' . $result['precio_doc'] . '</td>';
    echo                    '</tr>';
    echo                    '<tr>';
    echo                        '<th scope="col">Oferta Unidad: $</th>';
    echo                            '<td>' . $result['precio_oferta'] . '</td>';
    echo                    '</tr>';
    echo                '</tbody>';
    echo            '</table>';
    echo            '<div class="d-flex justify-content-center mb-2">';
    echo                '<a name="modificar" id="modificar" class="btn btn-warning mr-2" href="modificar.php?option=' . $_GET['option'] . '&modificar=' . $result['id'] . '">Modificar</a>';
    echo                '<a onclick="wantdelete(event)" name="eliminar" id="eliminar" class="btn btn-danger" href="galeria.php?option=' . $_GET['option'] . '&borrar=' . $result['id'] . '">Eliminar</a>';
    echo            '</div>';
    echo        '</div>';
    echo    '</div>';
    echo '</div>';
}

/*function getStockCantidad($product_id, $categoria)
{
    $conexion = new conexion();
    $sql = "SELECT cant_doce FROM stocking WHERE product_id = $product_id AND categoria = '$categoria'";
    $result = $conexion->consultar($sql);

    if ($result && count($result) > 0) {
        return $result[0]['cant_doce'];
    } else {
        return 0;
    }
}*/

?>

<?php
function generateSection($title, $imageSrc, $categChosen, $altText) {
    ?>
    <div class="col-12 mt-4 mb-4 text-center">
        <h2><?php echo $title; ?></h2>
    </div>
    <div class="col-12 text-center">
        <a href="<?php echo $categChosen; ?>">
            <img src="<?php echo $imageSrc; ?>" alt="<?php echo $altText; ?>" class="image-size">
        </a>
    </div>
<?php
}
?>
