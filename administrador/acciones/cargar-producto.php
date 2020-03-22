<?php

require '../../boostrap/conexiones.php';
require '../../funciones/funciones.php';
require '../../funciones/imagenes.php';


$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$descripcionCorta = $_POST['descripcionCorta'];
$descripcionLarga = $_POST['descripcionLarga'];
$etiquetas= $_POST['etiquetas'];
$imagenAlt = $_POST['imagenAlt'];
$imagen = $_FILES['imagen'];

$errores = [];

if(empty($nombre)){
    $errores['nombre']='Debe ingresar un nombre';
}
if(empty($precio)){
    $errores['precio']= 'Debe ingresar el precio del producto';
}

if(empty($descripcionCorta)){
    $errores['descripcionL']= 'Debe ingresar una descripción';
}

if(empty($descripcionCorta)){
    $errores['descripcionC']= 'Debe ingresar una descripción';
}
if(empty($imagenAlt)){
    $errores['imagenAlt']= 'Debe ingresar la descripción de la imagen';
}
if(empty($imagen['tmp_name'])) {
    $errores['imagen']  = "Debe elegir una imagen.";
}

if(count($errores) > 0){
    $_SESSION['errores']= $errores;

    $_SESSION['info_vieja']= $_POST;

    header('location: ../index.php?s=cargar-productos');

    exit;
}



if(!empty($_SESSION['id_usuario'])) {
    $usuario = $_SESSION['id_usuario'];
}

$nombresImagenes = GenerarImagenes($imagen, __DIR__ . '/../../img/cuadrados/', null, true);



$success= CargarProductos($db, [
    'id_usuarios'=> $usuario,
    'nombre' => $nombre,
    'precio'=>$precio,
    'descripcionCorta'=>$descripcionCorta,
    'descripcionLarga' => $descripcionLarga,
    'imagenChica' => $nombresImagenes['name'],
    'imagenGrande' => $nombresImagenes['big'],
    'fecha' => date('Y-m-d H:i:s'),
    'imagenAlt' => $imagenAlt,
    'etiquetas' => $etiquetas


]);

if($success){
    $_SESSION['success']= 'Se ha cargado el producto '. $nombre . ' Extiosamente';

   header('location: ../index.php?s=listado-productos');
}else{

    header('location: ../index.php?s=cargar-productos');

    }