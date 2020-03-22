<?php


function agregarProductosAusuarios($db,$id_producto,$id_usuario){

    $id_producto= mysqli_real_escape_string($db,$id_producto);
    $id_usuario= mysqli_real_escape_string($db,$id_usuario);

    $query= "INSERT INTO usuarios_has_productos (id_usuarios, id_Productos)
             VALUES ('$id_usuario','$id_producto')";

    $res=mysqli_query($db,$query);

    return $res;


}


function ObtenerProductosDelUsuario($db, $id_usuario) {
    $id_usuario = mysqli_real_escape_string($db, $id_usuario);

    $query = "SELECT 
                p.id_Productos,
                p.nombre,
                p.precio,
                p.imagenChica,
                p.imagenAlt,
                p.descripcionCorta
            FROM usuarios_has_productos uhp
            INNER JOIN productos p ON uhp.id_Productos = p.id_Productos
            WHERE id_usuarios = '$id_usuario'";
    $res = mysqli_query($db, $query);


    $salida = [];

    while($fila = mysqli_fetch_assoc($res)) {
        $salida[] = $fila;
    }

    return $salida;
}



function quitarProducto($db,$id_producto,$id_usuario){
    $id_producto=mysqli_real_escape_string($db,$id_producto);
    $id_usuario=mysqli_real_escape_string($db,$id_usuario);

    $query="DELETE FROM usuarios_has_productos
            WHERE id_usuarios= '$id_usuario' and id_Productos ='$id_producto'";

    $res=mysqli_query($db,$query);

    return $res;

}
