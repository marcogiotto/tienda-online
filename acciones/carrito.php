<?php

    require '../boostrap/conexiones.php';
    require '../funciones/autenticacion.php';
    require '../funciones/carrito.php';

    $id_producto= $_GET['id'];

    if(!Autenticar()){

        header('location: ../index.php?s=login');
        exit;
    }

    $exito = agregarProductosAusuarios($db,$id_producto,autenticacionObtenerId());

    if($exito){
        $_SESSION['success']='El producto se agrego correctamente al caritto';
        header('location: ../index.php?s=carrito');
    }else{
        $_SESSION['errores']= 'No se a podido agregar el producto al carrito, Por favor vuelva a intentarlo mas tarde';
        header('location: ../index.php?s=productos');
    }