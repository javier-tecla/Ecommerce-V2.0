<?php

class DatatableController {

     public function data() {

        if(!empty($_POST)){

            $draw = $_POST["draw"]; //Contador utilizado por DataTables para garantizar que los retornos de Ajax de las solicitudes de procesamiento del lado del servidor sean dibujados en secuencia por DataTables
            echo '<pre>$draw '; print_r($draw); echo '</pre>';

            $orderByColumnIndex = $_POST["order"][0]["column"]; //Indice de la columna de clasificación (0) basado en el indice, es decir, 0 es el primer registro)
            echo '<pre>$orderByColumnIndex '; print_r($orderByColumnIndex); echo '</pre>';

            $orderBy = $_POST["columns"][$orderByColumnIndex]["data"]; //Obtener el nombre de la columna de clasificación de su indice 
            echo '<pre>$orderBy '; print_r($orderBy); echo '</pre>';

            $orderType = $_POST["order"][0]["dir"]; // Obtener el orden ASC o DESC
            echo '<pre>$orderType '; print_r($orderType); echo '</pre>';

            $start = $_POST["start"];// Indicador de primer registro de paginación
            echo '<pre>$start '; print_r($start); echo '</pre>';

            $length = $_POST["length"];//Indicador de la longitud de la paginación
            echo '<pre>$length '; print_r($length); echo '</pre>';

        }
    }
}

/*================================================
Activar función DataTable
=============================================== */

$data = new DatatableController();
$data -> data();