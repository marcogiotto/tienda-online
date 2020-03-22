<?php

require 'funciones/funciones.php';

$id=$_GET['id'];

$producto= ObtenerId($db,$id);
$relacionados = TraerProductos($db,4);
?>

<section id="detalle-productos">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-6 d-flex justify-content-center">
				<img src="img/cuadrados/<?= $producto['imagenGrande'] ?>" alt=" <?= $producto['imagenAlt'] ?>">
				
			</div>
			<div class="col-sm-12 col-md-6">
			<h2 class="nombre-producto-detalle"><?= $producto['nombre'] ?></h2>	
			<div>

                <?php
                foreach ($producto['etiquetas'] as $etiquetas):
                    ?>

                    <span class="etiquetas-productos"><?= $etiquetas['nombre'] ?></span>

                <?php
                endforeach;
                ?>

				<p><?= $producto['descripcionLarga'] ?></p>
				<p class="precio-producto-detalle"><span>$<?=$producto['precio'] ?></span></p>

			</div>
			<div class="boton" >
				<a href="index.php?s=productos" class="btn-mas">Ver Más Productos</a>
			</div>
				
				
			
			</div>

			
			
		</div>
		
	</div>
</section>


<section id="destacados" >
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Productos Relacionados</h2>

            </div>
            <?php
            foreach ($relacionados as $producto):

                ?>
                <div class="col-sm-6 col-lg-3 mt-3">
                    <div class="card" style="width: 100%;">
                        <img src="img/cuadrados/<?= $producto['imagenGrande'] ?>" class="card-img-top" alt="<?= $producto['imagenAlt'] ?>">
                        <div class="card-body">
                            <h5 class="card-title py-2"><?= $producto['nombre'] ?></h5>
                            <a href="index.php?s=detalle-producto&id=<?= $producto['id_Productos'] ?>" class="btn btn-vermas">Ver mas</a>
                        </div>
                    </div>
                </div>
            <?php

            endforeach;
            ?>
        </div>

    </div>
    </section>