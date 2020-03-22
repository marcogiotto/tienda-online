<?php


require 'funciones/usuario.php';



if(isset($_SESSION['errores'])){
    $errores = $_SESSION['errores'];
    unset($_SESSION['errores']);
}else{

    $errores=[];
}

if(isset($_SESSION['info_vieja'])){

    $info_vieja = $_SESSION['info_vieja'];
    unset($_SESSION['info_vieja']);


}else{
    $info_vieja = usuarioId($db,$_GET['id']);


}



?>

<section>
    <div class="container my-5">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="text-center">Editar Mi Perfil</h2>

            </div>
            <div class="col-sm-12 col-md-8 m-auto">
                <form action="acciones/editar-perfil.php" method="POST">
                    <input type="hidden" name="id_usuarios" value="<?= $info_vieja['id_usuarios']; ?>">

                    <div class="form-group">
                        <label for="usuario">Nombre de Usuario</label>
                        <input type="text" class="form-control" name="usuario" value="<?= $info_vieja['usuario'] ?? '' ;?>" id="usuario" aria-describedby="emailHelp">

                        <?php
                        if(isset($errores['usuario'])):
                            ?>

                            <div class="form-error "><p> <?= $errores['usuario'];  ?></p> </div>
                        <?php
                        endif;
                        ?>



                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email"  name="email" value="<?= $info_vieja['email'] ?? ''; ?>" aria-describedby="emailHelp">


                        <?php
                        if(isset($errores['email'])):
                            ?>

                            <div class="form-error "><p> <?= $errores['email'];  ?></p> </div>
                        <?php
                        endif;
                        ?>



                    </div>


                    <button type="submit" class="btn btn-primary">Guardar</button>

                </form>

            </div>

        </div>

    </div>


</section>
