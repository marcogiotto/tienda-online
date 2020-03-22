<?php

require '../boostrap/conexiones.php';
require '../funciones/autenticacion.php';

$seccion=$_GET['s'] ?? 'listado-productos';



$seccionesPermitidas= [
    'listado-productos' =>[
        'title' =>	'Listado de Productos | Home',
        'autenticacion' => true,
    ],
    'cargar-productos' =>[
        'title'=>	'Primsa | Lista de productos',
        'autenticacion' => true,
    ],
    'editar-productos' =>[
        'title' =>	'Prisma | Contactanos',
        'autenticacion' => true,
    ],
    'ingreso' =>[
        'title' =>	'Inicios de Sesion | Sesion',
        'autenticacion' => false,
    ],
    '404' =>[
        'title' =>	'Prisma | Error404',
        'autenticacion' => true,
    ],

];


if(!isset($seccionesPermitidas[$seccion])){

    $seccion = "404";
}

if(isset($_SESSION['success'])){
    $mensajeExito = $_SESSION['success'];
    unset($_SESSION['success']);

}else{
    $mensajeExito= '';

}



if($seccionesPermitidas[$seccion]['autenticacion']){
    if(!Autenticar() || !esAdministrador()){

        header('location: index.php?s=ingreso');

        exit;
    }

}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title><?= $seccionesPermitidas[$seccion]['title']; ?></title>
</head>
<body>
<header>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 my-2">

                <a href="../index.php?s=home"><h1 >Prisma</h1></a>
            </div>

        </div>
        <div class="row">
            <?php
            if(Autenticar() && esAdministrador()):
                ?>

                <div class="sub-menu">

                    <ul class="nav ">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php?s=listado-productos">Listado de Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?s=cargar-productos">Cargar Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="acciones/salir.php">Cerrar Sesion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../index.php?s=home">Ver Sitio</a>
                        </li>

                    </ul>

                </div>
            <?php
            endif;
            ?>

        </div>
    </div>


</header>

<main>
    <?php
    if(file_exists('secciones/'.$seccion .'.php')){
        require 'secciones/'.$seccion . '.php';
    }else{
        require 'secciones/404.php';
    }
    ?>

</main>

<footer class="footer-admin">
    <div class="container">
        <div class="row">
            <div class="pre-footer">


                        <div class="col-sm-12">
                            <p>©2019 Primsa | Diseño Web Marco Giotto</p>
                        </div>
                    </div>




            </div>

    </div>

</footer>

<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.bundle.js"></script>
<script src="../js/animaScroll.js"></script>
<script src="../js/script.js"></script>
</body>
</html>