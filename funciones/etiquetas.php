<?php

/**
 * Traemos las etiquetas desde la base de datos.
 *
 * @param $db
 * @return array
 */

function TraerEtiquetas($db){
    $query= "SELECT * FROM etiquetas";

    $respuesta=mysqli_query($db,$query);

    $etiquetas=[];

    while($filetiquetas=mysqli_fetch_assoc($respuesta)){
        $etiquetas[]=$filetiquetas;
    }

    return $etiquetas;
}