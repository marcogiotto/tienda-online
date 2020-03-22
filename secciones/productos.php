 <?php
// require 'data/data-producto.php';

 require 'funciones/funciones.php';
 $productos = TraerProductos($db);

?>

<section id="productos">
	<div class="container">
		<div class="row">

			<div class="col-sm-12 m-5">
				<h2>NUESTROS PRODUCTOS</h2>
			</div>
			<?php  
			foreach($productos as $producto):
			?>
			<div class="col-sm-12  col-md-4 col-lg-3 mt-5   ">
				<div class="m-auto d-flex justify-content-center imagen-producto">
					<img src="img/cuadrados/<?= $producto['imagenGrande'] ?>" alt="<?= $producto['imagenAlt'] ?>">
				</div>
				<div class="des-producto  ">
					<p class="nombre-producto"><?= $producto['nombre'] ?></p>
					<p class="descrip-producto"><?= $producto['descripcionCorta'] ?></p>
					<p><span>$ <?= $producto['precio'] ?></span></p>


                    <div class="d-flex justify-content-center my-4">
                        <a href="acciones/carrito.php?&id=<?=$producto['id_Productos']; ?>" class='btn bnt-lg btn-detalle ' >AGREGAR AL CARRITO</a>

                    </div>
				
				<div class="d-flex justify-content-center my-4">
					<a href="index.php?s=detalle-producto&id=<?=$producto['id_Productos']; ?>" class='btn bnt-lg btn-detalle ' >DETALLE</a>
				
				</div>

				</div>
			</div>
			<?php 
		endforeach;
			?>
			
		</div>
		
	</div>
</section>