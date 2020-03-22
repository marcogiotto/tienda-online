<?php


function usuarioId($db,$id){
    $id=mysqli_real_escape_string($db,$id);
    $query= "SELECT * FROM usuarios
             WHERE id_usuarios ='$id'  ";

    $res=mysqli_query($db,$query);
    $fila=mysqli_fetch_assoc($res);
    if($fila){
        return $fila;
    }
    return null;



}


function UsuarioPorEmail($db, $email) {
    $email = mysqli_real_escape_string($db, $email);

    $query = "SELECT * FROM usuarios
            WHERE email = '$email'";
    $res = mysqli_query($db, $query);


    $fila = mysqli_fetch_assoc($res);

    if($fila) {

        return $fila;
    }

    return null;
}




function crearUsuario($db,$data){

    $email =mysqli_real_escape_string($db,$data['email']);
    $contraseña = mysqli_real_escape_string($db,$data['contraseña']);
    $id_rol = mysqli_real_escape_string($db,$data['id_rol']);

    $query = "INSERT INTO usuarios (email, contraseña, id_roles)
            VALUES ('$email', '$contraseña' , '$id_rol')";
    $exito = mysqli_query($db, $query);
    return $exito;

}


function actualizarUsuario($db,$id,$datos){

    $email= mysqli_real_escape_string($db,$datos['email']);
    $usuario= mysqli_real_escape_string($db,$datos['usuario']);
    $id= mysqli_real_escape_string($db,$id);

    $query="UPDATE usuarios
            SET email='$email',
            usuario='$usuario'
            WHERE id_usuarios='$id'";

    $res=mysqli_query($db,$query);

    if($res){
        mysqli_query($db,"COMMIT");
        return true;
    }else{
        mysqli_query($db,'ROLLBACK');
        return  false;
    }


}


function validarContraseña($db,$id){

    $id= mysqli_real_escape_string($db,$id);

    $query="SELECT contraseña 
            FROM usuarios 
             WHERE id_usuarios='$id'";

    $res=mysqli_query($db,$query);
    $exito=mysqli_fetch_assoc($res);
        return $exito;




}

function cambiarContraseña($db,$id,$contraseña){

    $id=mysqli_real_escape_string($db,$id);
    $contraseña=mysqli_real_escape_string($db,$contraseña);

    $query= "UPDATE usuarios
             SET contraseña='$contraseña'
             WHERE id_usuarios='$id'";
    $res=mysqli_query($db,$query);


    if($res){
        mysqli_query($db,"COMMIT");
        return true;
    }else{
        mysqli_query($db,'ROLLBACK');
        return  false;
    }
}