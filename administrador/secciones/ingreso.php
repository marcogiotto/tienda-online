<?php

if(isset($_SESSION['errores'])){
    $errores = $_SESSION['errores'];
    unset($_SESSION['errores']);
}else{

    $errores=[];
}

?>
<section id="ingreso">
    <div class="container">
        <div class="row">

            <div class="col-sm-12 col-lg-4 m-auto  fondo-usuario">
                <h2 class="text-center">Inicio de Sesion</h2>
                <?php
                if(isset($errores['aut'])):
                    ?>

                    <div class="form-error"><p><?= $errores['aut']?></p></div>
                <?php
                endif;
                ?>
                <form action="acciones/inicio.php" method="POST">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email"  placeholder="Ingrese su email">

                    </div>
                    <?php
                    if(isset($errores['email'])):
                        ?>

                        <div class="form-error"><p><?= $errores['email']?></p></div>
                    <?php
                    endif;
                    ?>
                    <div class="form-group">
                        <label for="contraseña">Contraseña</label>
                        <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Contraseña">
                    </div>
                    <?php
                    if(isset($errores['contraseña'])):
                        ?>

                        <div class="form-error"><p><?= $errores['contraseña']?></p></div>
                    <?php
                    endif;
                    ?>
                    <?php
                    if(isset($errores['login'])):
                        ?>

                        <div class="form-error"><p><?= $errores['login']?></p></div>
                    <?php
                    endif;
                    ?>


                    <button type="submit" class="btn btn-primary">INGRESAR</button>

                </form>

            </div>

        </div>

    </div>


</section>