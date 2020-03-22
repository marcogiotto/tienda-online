<?php

    require '../boostrap/conexiones.php';
    require '../funciones/autenticacion.php';

    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];

    $res = ValidarUsuario($db,$email,$contraseña);

    if($res){
        header('location: ../index.php?s=perfil');
    }else{
        $_SESSION['errores'] =['db' => 'Los datos ingresados no coinciden con nuestros registros.' ] ;
        $_SESSION['old_data'] = $_POST;
        header('Location: ../index.php?s=login');
    }