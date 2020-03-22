<?php
require '../funciones/funciones.php';



$productos = TraerProductos($db);

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
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Descripción Corta</th>
                <th scope="col">Descripción Larga</th>
                <th scope="col">Etiquetas</th>
                <th scope="col">Imagen</th>
                <th scope="col">Acciones</th>

            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($productos as $producto):
            ?>

            <tr>
                <th scope="row"><?= $producto['nombre']; ?>  </th>
                <td><?= $producto['precio'] ;?> </td>
                <td><?= $producto['descripcionCorta']; ?> </td>
                <td><?= $producto['descripcionLarga']; ?> </td>
                <td>
                <?php
                foreach ($producto['etiquetas'] as $etiqueta):
                ?>
                <span class="etiquetas-listado"><?= $etiqueta['nombre']; ?> | </span>
                <?php
                endforeach;
                ?>
                </td>
                <td><img src="../img/cuadrados/<?= $producto['imagenChica']; ?>" alt="<?= $producto['imagenAlt']; ?>" > </td>
                <td>
                    <a href="index.php?s=editar-productos&id=<?= $producto['id_Productos']; ?>" class="btn btn-lg btn-editar">Editar</a>
                    <a href="acciones/eliminar-producto.php?id=<?= $producto['id_Productos'] ;?>" data-nombre="<?= $producto['nombre']; ?>" class="btn btn-lg btn-eliminar">Eliminar</a>

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