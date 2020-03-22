<?php

require '../../boostrap/conexiones.php';
require  '../../funciones/autenticacion.php';

$email=$_POST['email'];
$contraseña = $_POST['contraseña'];

$errores=[];


if(empty($email)){
    $errores['email']='Debe ingresar un mail.';
}
if(empty($contraseña)){
    $errores['contraseña']='Debe ingresar la contraseña.';
}

if(count($errores) > 0){
    $_SESSION['errores']= $errores;



    header('location: ../index.php?s=ingreso');

    exit;
}

$succcess = ValidarUsuario($db,$email,$contraseña);


if($_SESSION['id_rol'] != 1){
    $_SESSION['errores']=['aut' =>'No estas autorizado para ingresar a esta sección.'];
    header('location: ../index.php?s=ingreso');

    exit;
}


if($succcess){

    header('location: ../index.php?s=listado-productos');

}else{
    $errores['login']='La clave o el usuario no es el correcto';
    $_SESSION['errores']= $errores;
    header("location: ../index.php?s=inicio");
}