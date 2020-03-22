<?php

require '../boostrap/conexiones.php';
require  '../funciones/usuario.php';

$email                  = $_POST['email'];
$contraseña             = $_POST['contraseña'];
$VerificarContraseña    = $_POST['Verificarcontraseña'];



$errores=[];



if(empty($email)) {
    $errores['email'] = "El email no puede estar vacío.";
} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errores['email'] = "El email no parece tener un formato válido.";
} else if(UsuarioPorEmail($db, $email)) {
    $errores['email'] = "El email ingresado ya está en uso. Por favor, seleccioná otro. Si sos vos, probá de recuperar contraseña.";
}

if(empty($contraseña)) {
    $errores['contraseña'] = "La contraseña no puede estar vacía.";
} else if(strlen($contraseña) < 3) {
    $errores['contraseña'] = "La contraseña debe tener al menos 3 caracteres.";
} else if($contraseña !== $VerificarContraseña) {
    $errores['contraseña'] = "La contraseña no coincide con su confirmación.";
}

if(count($errores) > 0) {
    $_SESSION['errores'] = $errores;
    $_SESSION['old_data'] = $_POST;
    header('Location: ../index.php?s=registro');
    exit;
}

$exito = crearUsuario($db, [
    'email' => $email,
    'contraseña' => password_hash($contraseña, PASSWORD_DEFAULT),
    'id_rol' => 2
]);


if($exito) {
    $_SESSION['exito'] = "Registro exitoso. Ya podés iniciar sesión ";
    header("Location: ../index.php?s=login");
} else {
    $_SESSION['errores'] = [ 'db' =>"Ocurrió un error en el servidor al procesar la información. Por favor, probá de nuevo más tarde."];
    $_SESSION['old_data'] = $_POST;
    header("Location: ../index.php?s=registro");
}

