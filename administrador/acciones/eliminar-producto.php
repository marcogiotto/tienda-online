<?php

require '../../boostrap/conexiones.php';
require '../../funciones/funciones.php';

$id = $_GET['id'];


$success = EliminarProducto($db,$id);

if($success){
    $_SESSION['success']='se ha eliminado exitosamente la noticia';
    header('Location: ../index.php?s=listado-productos');
}else{

    header('location: ../index.php?s=listado-productos');
}