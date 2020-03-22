<?php

/**
 * Validamos al usuario si se encuentra registrado y sus datos.
 *
 * @param $db
 * @param $email
 * @param $contraseña
 * @return bool|string[]|null
 */

function ValidarUsuario($db,$email,$contraseña){

    $email= mysqli_real_escape_string($db,$email);

    $query = "SELECT * FROM 
             usuarios WHERE email ='$email'";

    $res=mysqli_query($db,$query);

    if($fila = mysqli_fetch_assoc($res)){

        if(password_verify($contraseña,$fila['contraseña'])){

            $_SESSION['id_usuario']= $fila['id_usuarios'];
            $_SESSION['id_rol'] = $fila['id_roles'];
            $_SESSION['email']= $fila['email'];
            return $fila;
        }

    }
    return false;

}

/**
 * Vemos si el usuario esta logeado o no.
 *
 * @return bool
 */

function Autenticar () {

    return isset($_SESSION['id_usuario']);


}

/**
 * @return mixed
 */

function emailAutenticado () {
    return $_SESSION['email'];
}



function UsuarioAutenticado($db)
{

    if (!Autenticar()) {
        return null;
    }

    $query = "SELECT * FROM  usuarios 
             WHERE id_usuarios= " . $_SESSION['id_usuario'];

    $res=mysqli_query($db,$query);

    if($fila=mysqli_fetch_assoc($res)){

        return $fila;


        }
    return null;
}



//function usuarioAcceder(){
//    if(!isset($_SESSION['id_usuario']) || empty($_SESSION['email'])){
//        header(' location: ../index.php?s=home');
//
//    }
//}





function esAdministrador() {
    return $_SESSION['id_rol'] == 1;
}


function autenticacionObtenerId() {
    return $_SESSION['id_usuario'];
}




/**
 * Funcion para desloguear al usuario.
 *
 */
function desloguear(){
    unset($_SESSION['id_usuario'],$_SESSION['id_rol'],$_SESSION['email']);

}