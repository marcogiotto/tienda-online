<?php

require 'funciones/funciones.php';
$productos = TraerProductos($db,4);


?>




<section id="banner">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  
  <div class="carousel-inner">
    <div class="carousel-item active" >
      <picture>
        <source srcset="img/banners/banner.jpg" media="(min-width: 650px )" >
      <img src="img/banners/bannerm.jpg" class="d-block w-100" alt="Banner de ofertas en prisma">
      </picture>
    </div>
  </div>
</div>
	
</section>
<section id="nosotros" >
  <div class="container">
    <div class="row">
      <div class="col-sm-12 py-5">
        <h2>Prisma Ropa Unisex</h2>
      </div>
      <div class="col-sm-12 col-md-9 m-auto">
        <p > Somos una empresa productora de ropa, contamos con los mas altos estandares a la hora de la producción.
          Nuestra ropa se caracteriza por la alta clidad de los materiales y una mano de obra muy especializada.
          Los diseños se encuentran realizados por nuestros diseñadores de alto nivel al rededor del mundo.
          
          
        </p>
        <div class='m-auto d-flex justify-content-center pt-5'>
          <a href="index.php?s=productos" class="btn btn-lg btn-success">Shop Now</a>
        </div>
      </div>
      
    </div>
    
  </div>
  
</section>

<section id="ofertas">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-6  mt-5 d-flex justify-content-center">
        <picture class="d-flex justify-content-center" >
          <source srcset="img/banners/mujer.png"  media="(min-width :970px)">
            <img src="img/banners/mujerc.png" alt="banner para ir a sección de mujeres">
        </picture>
        <div class="oferta-titulos">
          <h3>Mujeres</h3>
        </div>
      </div>
      <div class="col-sm-12 col-md-6 mt-5  d-flex justify-content-center">
        
        <div class="opacidad">
        <picture class="d-flex justify-content-center " >
          <source srcset="img/banners/hombre.png"  media="(min-width :970px)">
            <img src="img/banners/hombrec.png" alt="banner para ir a la sección de hombres."  >
        </picture>
        </div>
        <div class="oferta-titulos">
          <h3>Hombres</h3>
        </div>
      </div>

    
  </div>
  </div>

</section>

<section id="destacados" >
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Productos Destacados</h2>

            </div>
            <?php
            foreach ($productos as $producto):

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