<?php

    require '../boostrap/conexiones.php';
    require '../funciones/autenticacion.php';
    require '../funciones/carrito.php';

    $id_producto= $_GET['id'];

    if(!Autenticar()){
        header('location: ../index.php?s=login');
        exit;
    }

    $exito= quitarProducto($db,$id_producto,autenticacionObtenerId());

    if($exito){
        $_SESSION['success']= ' Se ha eliminado el producto del carrito correctamente';
        header('location : ../index.php?s=carrito');

    }else{
        $_SESSION['errores']= ' No se ha podido eliminar el producto del carrito. Por favor vuelva a intentarlo mas tarde';
        header('location: ../index.php?s=carrito');
    }