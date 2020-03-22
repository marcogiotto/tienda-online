<?php
require '../../boostrap/conexiones.php';
require '../../funciones/funciones.php';
require '../../funciones/imagenes.php';

$id_Productos= $_POST['id_Productos'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$descripcionCorta = $_POST['descripcionCorta'];
$descripcionLarga = $_POST['descripcionLarga'];
$imagenAlt = $_POST['imagenAlt'];
$imagenActual = $_POST['imagenGrande'];
$etiquetas = $_POST['etiquetas'];
$imagen = $_FILES['imagen'];



$errores = [];

if(!empty($_SESSION['id_usuario'])) {
    $usuario = $_SESSION['id_usuario'];
}

if(empty($nombre)){
    $errores['nombre']='Debe ingresar un nombre';
}
if(empty($precio)){
    $errores['precio']= 'Debe ingresar el precio del producto';
}

if(empty($descripcionCorta)){
    $errores['descripcionL']= 'Debe ingresar una descripción';
}

if(empty($descripcionLarga)){
    $errores['descripcionC']= 'Debe ingresar una descripción';
}

if(empty($imagenAlt)){
    $errores['imagenAlt']='Debe ingresar una descripción de la imagen';
}

if(count($errores) > 0){
    $_SESSION['errores']= $errores;

    $_SESSION['info_vieja']= $_POST;

  header('location: ../index.php?s=editar-productos');

    exit;
}
if(!empty($imagen['tmp_name'])) {

$nombresImagenes = GenerarImagenes($imagen, __DIR__ . '/../../img/cuadrados/', null, true);
$nombreImagen = $nombresImagenes['name'];
$nombreImagenGrande= $nombresImagenes['big'];

} else {
    $nombreImagenGrande = $_POST['imagenGrande'];
    $nombreImagen= str_replace('.png','-small.png',$nombreImagenGrande);
}





$success = EditarProductos($db,$id_Productos,[
    'id_usuarios' => $usuario,
    'nombre' => $nombre,
    'precio'=> $precio,
    'descripcionCorta' => $descripcionCorta,
    'descripcionLarga' => $descripcionLarga,
    'fecha'=> date('Y-m-d H:i:s'),
    'imagenAlt' => $imagenAlt,
    'imagenChica' => $nombreImagen,
    'imagenGrande' => $nombreImagenGrande,
    'etiquetas' => $etiquetas,




]);

if($success){
    if(!empty($imagen['tmp_name'])) {

        unlink(__DIR__ . '/../../img/cuadrados/' . $_POST['imagenGrande']);
        unlink(__DIR__ . '/../../img/cuadrados/' . str_replace('.png', '-small.png', $_POST['imagenGrande']));
    }



    $_SESSION['success'] ='Se ha editado la noticia '.$nombre.' con exito';
    header('location: ../index.php?s=listado-productos');
}else{
    $_SESSION['errores'] = ['db' => 'Se produjo un error por lo que no se pudo editar la noticia, vuelva a intentarlo luego'];
    $_SESION['info_vieja'] = $_POST;
    header('location: ../index.php?s=editar-productos&id='.$id_Productos);
}