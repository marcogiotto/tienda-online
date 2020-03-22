<?php

require 'funciones/usuario.php';


if(!empty($_SESSION['errores'])){
    $errores=$_SESSION['errores'];
    unset($_SESSION['errores']);

}else{

    $errores=[];
}

if(isset($_SESSION['info_vieja'])){

    $info_vieja = $_SESSION['info_vieja'];
    unset($_SESSION['info_vieja']);


}else{

    $info_vieja = $_GET['id'];


}


?>


<section>
    <div class="container my-5">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="text-center">Cambiar Contraseña</h2>

            </div>
            <div class="col-sm-12 col-md-8 m-auto">
                <form action="acciones/cambiar-contraseña.php" method="POST">
                    <input type="hidden" name="id_usuarios" value="<?= $info_vieja; ?>">
                    <div class="form-group">
                        <label for="contraseñaVieja">Contraseña Vieja</label>
                        <input type="password" class="form-control" name="contraseñaVieja" id="contraseñaVieja">

                        <?php
                        if(isset($errores['contraseñaVieja'])):
                            ?>

                            <div class="form-error "><p> <?= $errores['contraseñaVieja'];  ?></p> </div>
                        <?php
                        endif;
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="contraseñaNueva">Contraseña Nueva</label>
                        <input type="password" class="form-control" name="contraseñaNueva" id="contraseñaNueva">

                        <?php
                        if(isset($errores['contraseñaNueva'])):
                            ?>

                            <div class="form-error "><p> <?= $errores['contraseñaNueva'];  ?></p> </div>
                        <?php
                        endif;
                        ?>
                        <?php
                        if(isset($errores['contraseña'])):
                            ?>

                            <div class="form-error "><p> <?= $errores['contraseña'];  ?></p> </div>
                        <?php
                        endif;
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="contraseñaNueva1">Repetir contraseña Nueva</label>
                        <input type="password" class="form-control" name="contraseñanNueva1" id="contraseñaNueva1">
                    </div>




                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>

            </div>

        </div>

    </div>


</section>

