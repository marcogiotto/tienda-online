<?php

    require_once 'funciones/autenticacion.php';
    require 'funciones/carrito.php';

    $productos= ObtenerProductosDelUsuario($db,autenticacionObtenerId());


    if(isset($_SESSION['success'])){
        $mensajeExito=$_SESSION['success'];
        unset($_SESSION['success']);
    }
    if(isset($_SESSION['errores'])){
        $error=$_SESSION['errores'];
        unset($_SESSION['errores']);
    }

?>


<section id="listado-productos">
    <div class="container">
        <div class="row">

            <?php
            if(!empty($mensajeExito)):
                ?>

                <p class="success"><?=  $mensajeExito; ?> </p>
            <?php
            endif;
            ?>
            <div class="table-responsive">
                <div class="col-sm-12 ">
                    <h2 class="text-center my-5">Mi Carrito</h2>

                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción Corta</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Acciones</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($productos as $producto):
                        ?>

                        <tr>
                            <th scope="row"> <img src="img/cuadrados/<?= $producto['imagenChica']; ?>" alt="<?= $producto['imagenAlt']; ?>" > </th>
                            <td><?= $producto['nombre']; ?> </td>
                            <td><?= $producto['precio'] ;?> </td>
                            <td><?= $producto['descripcionCorta']; ?> </td>
                            <td>1</td>
                            <td>
                                <a href="acciones/quitar-producto?id=<?= $producto['id_Productos'] ;?>" data-nombre="<?= $producto['nombre']; ?>" class="btn btn-lg btn-eliminar">Eliminar</a>

                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
