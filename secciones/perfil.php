<?php

require_once 'funciones/autenticacion.php';
$usuario= UsuarioAutenticado($db);
if(!empty($_SESSION['success'])){
    $success=$_SESSION['success'];
    unset($_SESSION['success']);
}
?>

<section>
    <div  class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 m-auto ">
                <h2 class="text-center">Mi Perfil</h2>
                <?php
                if(!empty($success)):
                    ?>

                    <p class="success"><?=  $success; ?> </p>
                <?php
                endif;
                ?>
            </div>
            <div class="col-sm-12 col-md-8 m-auto">
                <a href="index.php?s=editar-perfil&id=<?= $usuario['id_usuarios']; ?>">Editar Perfil</a> <a href="index.php?s=cambiar-contraseña&id=<?= $usuario['id_usuarios']; ?>">Cambiar Contraseña</a> <a href="acciones/salir.php">Cerras Sesion</a>

                <ul>
                    <li><?= $usuario['usuario']; ?></li>
                    <li><?= $usuario['email']; ?></li>
                </ul>

            </div>

        </div>

    </div>




</section>
