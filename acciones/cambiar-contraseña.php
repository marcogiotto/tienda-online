<?php

    require '../boostrap/conexiones.php';
    require '../funciones/usuario.php';

    $id_usuarios      = $_POST['id_usuarios'];
    $contraseñaVieja  = $_POST['contraseñaVieja'];
    $contraseñaNueva  = $_POST['contraseñaNueva'];
    $contraseñaNueva1 = $_POST['contraseñanNueva1'];

    $contra=implode(validarContraseña($db,$id_usuarios));
    $resultado=password_verify($contraseñaVieja,$contra);

    $errores=[];

    if(!$resultado){

        $errores['contraseñaVieja']= 'La contraseña ingresada no es correcta';
        $_SESSION['errores']=$errores;
        $_SESSION['info_vieja']=$id_usuarios;
        header('location: ../index.php?s=cambiar-contraseña');
        die;
    }

    if(empty($contrseñaVieja)){
        $errores['contrsenañVieja']= 'La contraseña no pueda estar vacia';
    }

    if(empty($contraseñaNueva)){
        $errores['contraseñaNueva']= 'La contraseña nueva debes estar completa';
    }

    if(empty($contraseñaNueva1)){
        $errores['contraseñaNueva1']= 'La contraseña no debe estar vacia';
    }

    if($contraseñaNueva != $contraseñaNueva1){
        $erorres['contraseñas']= 'Las contraseñas no coinciden';
    }

    if(count($errores) > 0){
        $_SESSION['errores']= $errores;
        $_SESSION['info_vieja']=$id_usuarios;
        header('location: ../index.php?s=cambiar-contraseña');
    }


    $success= cambiarContraseña($db,$id_usuarios,$contraseñaNueva);


if($success){
    $_SESSION['success']='Se ha cambiado la contraseña correctamente';
    header('location: ../index.php?s=perfil');
}else{
    $_SESSION['errores']=['db' => ' Ha ocurrido un error no se han podido realizar los cambios intente nuevamente mas tarde'];
    $_SESSION['info_vieja']=$id_usuarios;
    header('location: ../index.php?s=cambiar-contraseña');
}

