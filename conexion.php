<?php
class conexion{
    #atributos que son propios del objeto
    private $pdo;
    public function __construct(){
        $servidor ="localhost";
        $base = "proyecto";
        $usuario ="root";
        $pass = "";
        
        $conexion = "mysql:host=$servidor;dbname=$base;charset=utf8mb4";#objeto de tipo pdo, de la clase propia de php
        
        try{
            $this->pdo = new PDO($conexion, $usuario, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        }catch(PDOException $e){
            echo "Falla de Conexión".$e->getMessage();
            die();
        }
    }

     #creo un metodo de ejecucion a sql de insert, update, delete   
    public function ejecutar($sql){
        #Execute una consulta de sql
        $this->pdo->exec($sql);
        #esto nos da el valor de id insertado
        return $this->pdo->lastInsertId();
    }
    public function consultar($sql){ # select 
        #ejecuta la consulta y nos devuelve la info de la base
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        #retorna todos los registros de la consulta sql
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        /*1ro agarra nuestra sentencia de sql y lo mete adentro de un objeto 
         2do agarra el objeto y ejecuta la sentencia de sql que devuelve o no filas de base de datos 
         3ro fetchall() nos devuelve un array con las filas del select  */
    }

    public function search($searchQuery, $tables, $numTables)
    {
        $results = [];
        $source_table = null;

        if ($numTables === 1) {
            $table = $tables;

            $sql = "SELECT $table.id, $table.cod_art, $table.id_prov, $table.descripcion, fabricants.nombre AS fabricant_name, "
                . "$table.precio_doc, $table.precio_oferta, $table.fecha_alta, $table.imagen "
                . "FROM $table "
                . "INNER JOIN fabricants ON $table.id_prov = fabricants.id "
                . "WHERE $table.descripcion LIKE :searchQuery OR fabricants.nombre LIKE :searchQuery";
            
            $source_table = $table; // Single table source
            } else {
                if (is_array($tables) && count($tables) > 0) {
                    $source_table = $tables[0]; // Use the first table in the array as a reference
                }
                //echo ('datos : ' . $source_table);
            
                // Start building the UNION query
                $sql = "SELECT combined_tables.id, combined_tables.cod_art, combined_tables.id_prov, combined_tables.descripcion, 
                        fabricants.nombre AS fabricant_name, combined_tables.precio_doc, combined_tables.precio_oferta, 
                        combined_tables.fecha_alta, combined_tables.imagen 
                        FROM (";
                
                // Initialize the query for each table
                foreach ($tables as $index => $table) {
                    $sql .= "SELECT '$table' AS source_table, id, cod_art, id_prov, descripcion, precio_doc, 
                            precio_oferta, fecha_alta, imagen FROM $table";
                    
                    // Add UNION between tables, but not after the last table
                    if ($table !== end($tables)) {
                        $sql .= " UNION ";
                    }
                }
                
                // Complete the query
                $sql .= ") AS combined_tables 
                        INNER JOIN fabricants ON combined_tables.id_prov = fabricants.id 
                        WHERE combined_tables.descripcion LIKE :searchQuery OR fabricants.nombre LIKE :searchQuery";
        }
            
        //echo 'Final Query: ' . $sql;
        // Assuming $this->pdo is your PDO connection
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':searchQuery', $searchQuery, PDO::PARAM_STR);
        $stmt->execute();

        $results['data'] = $stmt->fetchAll();

        if (empty($results['data'])) {
            // No matching records found
            return false;
        }

        return ['data' => $results['data'], 'table' => $source_table, 'numTables' => $numTables];
    }

}
