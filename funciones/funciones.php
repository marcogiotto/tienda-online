<?php

/**
 * Devuelve los productos,podes indicar la cantidad que te trae.
 *
 * @param $db
 * @param null $cantidad
 * @return array
 */
function TraerProductos ($db,$cantidad = null){

        $query="SELECT productos.*, 
                GROUP_CONCAT(e.id_etiquetas, ' :', e.nombre SEPARATOR '-') AS etiquetas
                from productos
                left join productos_has_etiquetas phe on productos.id_Productos = phe.id_Productos
                left join etiquetas e on e.id_etiquetas = phe.id_etiquetas
                GROUP BY productos.id_Productos ";
        if($cantidad !== null){
            $query.= " LIMIT " .$cantidad;

        }


        $resultado = mysqli_query($db,$query);

        $res = [];
        while($filas = mysqli_fetch_assoc($resultado)){

            if($filas['etiquetas'] != ''){
                $etiquetasCombinadas= explode('-',$filas['etiquetas']);
                $etiquetas=[];

                foreach ($etiquetasCombinadas as $etiquetasUnicas){

                    $partesE=explode(':',$etiquetasUnicas);
                    $etiquetas[]=[
                        'id_etiquetas' => $partesE[0],
                        'nombre'=> $partesE[1]
                    ];


                }
                $filas['etiquetas']=$etiquetas;


            }else{
                $filas['etiquetas']='';
            }







            $res[]= $filas;

        }

        return $res;



}

/**
 * Obtenemos el id de todos los productos.
 *
 * @param $db conexion a la base de datos.
 * @param $id obtenemos por gel el id del producto.
 * @return $res array del producto con ese id
 */

function ObtenerId ($db,$id){

    $id= mysqli_real_escape_string($db,$id);

    $query= "SELECT * FROM productos 
             WHERE id_Productos ='$id'";

    $resultado = mysqli_query($db,$query);

    $res = mysqli_fetch_assoc($resultado);

    $filasQuery= "SELECT etiquetas.* FROM etiquetas
                  left join productos_has_etiquetas phe on etiquetas.id_etiquetas = phe.id_etiquetas
                  WHERE phe.id_Productos='$id'";

    $fQuery=mysqli_query($db,$filasQuery);
    $etiquetas=[];
    while($fetiquetas = mysqli_fetch_assoc($fQuery)){
        $etiquetas[]=$fetiquetas;


    }
    $res['etiquetas']=$etiquetas;

    return $res;
}

/**
 * Eliminamos los prodcutos que desamos.
 *
 * @param $db conexion a base de datos.
 * @param $id id del producto obtenido por get
 * @return $res booleano
 */


function EliminarProducto ($db,$id){

    $id=mysqli_real_escape_string($db,$id);
    $eliminarEtiquetas="DELETE FROM productos_has_etiquetas
                        WHERE id_Procutos='$id'";
    $exitoE=mysqli_query($db,$eliminarEtiquetas);

    $query = "DELETE FROM productos_has_etiquetas
                WHERE id_Productos = '$id'";

    mysqli_query($db, $query);

    $query= "DELETE FROM productos 
            WHERE  id_Productos = '$id'";

    $res =mysqli_query($db,$query);

if($res && $exitoE){
    mysqli_query($db,'COMMIT');
}

    return $res;



}

/**
 * Cargamos los productos a la base desde el panel
 *
 * @param $db
 * @param $info
 * @return bool|mysqli_result
 */

function CargarProductos ($db,$info){
    mysqli_query($db,'START TRANSACTION');

    $id_usuarios = mysqli_real_escape_string($db,$info['id_usuarios']);
    $nombre= mysqli_real_escape_string($db,$info['nombre']);
    $precio= mysqli_real_escape_string($db,$info['precio']);
    $descripcionCorta= mysqli_real_escape_string($db,$info['descripcionCorta']);
    $descripcionLarga= mysqli_real_escape_string($db,$info['descripcionLarga']);
    $imagenChica= mysqli_real_escape_string($db,$info['imagenChica']);
    $imagenGrande= mysqli_real_escape_string($db,$info['imagenGrande']);
    $fecha= mysqli_real_escape_string($db,$info['fecha']);
    $imagenAlt= mysqli_real_escape_string($db,$info['imagenAlt']);


    $query="INSERT INTO productos (usuarios_id_usuarios,nombre,precio,descripcionCorta,descripcionLarga,imagenChica,imagenGrande,fecha,imagenAlt)
            VALUES('$id_usuarios','$nombre','$precio','$descripcionCorta','$descripcionLarga','$imagenChica','$imagenGrande','$fecha','$imagenAlt')";

    $res =mysqli_query($db,$query);

    $idProducto=mysqli_insert_id($db);

    $exitoE = GrabarEtiquetas($db,$idProducto,$info['etiquetas']);


    if($res && $exitoE){
            mysqli_query($db,'COMMIT');
            return  true;
        }else{
            mysqli_query($db,'ROLLBACK');
            return false;
        }



}

/**
 * Con esta funcion podemos editar los productos cargados en la base
 * @param $db
 * @param $id
 * @param $data
 * @return bool|mysqli_result
 */


    function EditarProductos ($db,$id,$data){
        mysqli_query($db,"START TRANSACTION");


        $id= mysqli_real_escape_string($db,$id);

        $nombre = mysqli_real_escape_string($db,$data['nombre']);
        $precio = mysqli_real_escape_string($db,$data['precio']);
        $descripcionCorta = mysqli_real_escape_string($db,$data['descripcionCorta']);
        $descripcionLarga = mysqli_real_escape_string($db,$data['descripcionLarga']);

        $imagenAlt = mysqli_real_escape_string($db,$data['imagenAlt']);
        $imagenChica = mysqli_real_escape_string($db,$data['imagenChica']);
        $imagenGrande = mysqli_real_escape_string($db,$data['imagenGrande']);

        $query="UPDATE productos
               SET nombre = '$nombre',
               precio= '$precio',
               descripcionCorta='$descripcionCorta',
               descripcionLarga='$descripcionLarga',
               imagenChica='$imagenChica',
               imagenGrande='$imagenGrande',
               imagenAlt='$imagenAlt'
               WHERE id_Productos='$id'";

        $res=mysqli_query($db,$query);

        $borrarEtiquetas="DELETE FROM productos_has_etiquetas
                         WHERE id_Productos ='$id'";

        $exitoBorar=mysqli_query($db,$borrarEtiquetas);

        $exitoE=GrabarEtiquetas($db,$id,$data['etiquetas']);

        if($res && $exitoE && $exitoBorar){
            mysqli_query($db,"COMMIT");
            return true;
        }else{
            mysqli_query($db,'ROLLBACK');
            return  false;
        }


    }


/**
 * Guardamos las nuevas etiquetas en la base de datos.
 *
 * @param $db
 * @param $id
 * @param $idEtiquetas
 * @return bool|mysqli_result
 */


function GrabarEtiquetas($db,$id,$idEtiquetas){

    if(isset($idEtiquetas) && count($idEtiquetas)> 0){

        $valorEtiquetas=[];

        foreach($idEtiquetas as $idEtiquetas) {

            $idEtiquetas=mysqli_real_escape_string($db,$idEtiquetas);
            $valorEtiquetas[]="($id,'$idEtiquetas')";
        }

        $valor=implode(', ',$valorEtiquetas);

        $insertE="INSERT INTO productos_has_etiquetas (id_Productos,id_etiquetas)
                  VALUES $valor";

        $exitoE=mysqli_query($db,$insertE);

    }else{

        $exitoE=true;
    }

return $exitoE;
}





