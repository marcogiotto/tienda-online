<?php

require '../boostrap/conexiones.php';
require '../funciones/usuario.php';



$id = $_POST['id_usuarios'];
$usuario = $_POST['usuario'];
$email  = $_POST['email'];

$errores=[];

if(empty($usuario)){
    $errores['usuario']='Debe ingresar un nombre de usuario';
}

if(empty($email)){
    $errores['email']='Debe ingresar un Email';
}

if(count($errores )> 0){
    $_SESSION['errores']=$errores;

    $_SESSION['info_vieja']= $_POST;

    header(' location: ../index.php?s=editar-perfil');
}

$success=actualizarUsuario($db,$id,[
    'email' => $email,
    'usuario' => $usuario
]);


if($success){
    $_SESSION['success']='Se han modificado sus datos correctamente';
    header('location: ../index.php?s=perfil');
}else{
    $_SESSION['errores']=['db' => ' Ha ocurrido un error no se han podido realizar los cambios intente nuevamente mas tarde'];
    $_SESSION['info_vieja']=$_POST;
    header('location: ../index.php?s=editar-perfil');
}