<?php

require '../funciones/etiquetas.php';
$etiquetas=TraerEtiquetas($db);

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
    $info_vieja = [];
}


?>




<section id="cargar-productos">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2>Cargar Productos</h2>

            </div>
            <div class="col-sm-12 col-md-8 m-auto">
                <form action="acciones/cargar-producto.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nombre">Nombre del Producto</label>
                        <input type="text" class="form-control" name="nombre" value="<?= $info_vieja['nombre'] ?? '';?>" id="nombre" >
                        <?php
                        if(isset($errores['nombre'])):
                        ?>

                        <div class="form-error "> <p><?= $errores['nombre'];  ?> </p></div>
                        <?php
                        endif;
                        ?>

                    </div>

                    <div class="form-group">
                        <label for="precio">Precio del Producto</label>
                        <input type="number" class="form-control" name="precio" value="<?= $info_vieja['precio'] ?? '';?>" id="precio" >

                        <?php
                        if(isset($errores['precio'])):
                            ?>

                            <div class="form-error "><p> <?= $errores['precio'];  ?></p> </div>
                        <?php
                        endif;
                        ?>




                    </div>
                    <div class="form-group">
                        <label for="descripcionCorta">Descripcion Corta</label>
                        <input type="text" class="form-control" value="<?= $info_vieja['descripcionCorta'] ?? '';?>" name="descripcionCorta" id="descripcionCorta" >


                        <?php
                        if(isset($errores['descripcionC'])):
                            ?>

                            <div class="form-error "> <p><?= $errores['descripcionC'];  ?></p> </div>
                        <?php
                        endif;
                        ?>


                    </div>

                    <div class="form-group">
                        <label for="descripcionLarga">Descripcion Larga</label>
                        <textarea class="form-control" name="descripcionLarga" id="descripcionLarga" rows="3"> <?= $errores['descripcionLarga'] ?? '';  ?></textarea>

                        <?php
                        if(isset($errores['descripcionL'])):
                            ?>

                            <div class="form-error "> <p><?= $errores['descripcionL'];  ?></p> </div>
                        <?php
                        endif;
                        ?>



                    </div>

                        <div class="form-group">
                            <label for="imagen">Cargar Imagen</label>
                            <input type="file" name="imagen" id="imagen" class="form-control-file" >


                            <?php
                            if(isset($errores['imagen'])):
                                ?>

                                <div class="form-error "><p> <?= $errores['imagen'];?></p></div>
                            <?php
                            endif;
                            ?>
                        </div>

                    <div class="form-group">
                        <label for="imagenAlt">Descripcion de la Imagen</label>
                        <input type="text" class="form-control" name="imagenAlt" value="<?= $info_vieja['imagenAlt'] ?? '';?>" id="imagenAlt" >

                        <?php
                        if(isset($errores['imagenAlt'])):
                            ?>

                            <div class="form-error "><p> <?= $errores['imagenAlt'];?></p></div>
                        <?php
                        endif;
                        ?>


                    </div>



                    <div class="form-group">
                        <?php
                        foreach ($etiquetas as $etiqueta):
                        ?>
                        <label for="etiquetas"><input type="checkbox" name="etiquetas[]" value="<?=$etiqueta['id_etiquetas'] ?>"  ><?=$etiqueta['nombre'] ?></label>
                        <?php
                        endforeach;
                        ?>

                    </div>

                    <button type="submit" class="btn btn-lg " >CARGAR PRODUCTO</button>
                </form>

            </div>

        </div>

    </div>
</section>

