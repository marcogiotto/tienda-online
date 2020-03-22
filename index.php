<?php  

require 'boostrap/conexiones.php';
require_once 'funciones/autenticacion.php';

$seccion=$_GET['s'] ?? 'home';



$seccionesPermitidas= [
		'home' =>[
		'title' =>	'Prisma | Home'
		],
		'productos' =>[
		'title'=>	'Primsa | Lista de productos'
		],
		'contacto' =>[
			'title' =>	'Prisma | Contactanos'
		],
		'404' =>[
			'title' =>	'Prisma | Error404'
		],
		'detalle-producto' =>[
			'title' => 'Prisma | Detalle del producto'
		],
		'gracias'=>[
			'title' => 'Prisma | Mensaje Enviados'
		],
		'login'=>[
        'title' => 'Prisma | Login'
        ],
        'registro'=>[
        'title' => 'Prisma | Registro de Usuario'
        ],
        'perfil'=>[
            'title' => 'Prisma | Mi Perfil'
        ],
        'editar-perfil'=>[
            'title' => 'Prisma | Editar  Mi Perfil'
        ],
        'cambiar-contraseña'=>[
            'title' => 'Prisma | Cambiar Mi Perfil'
        ],
        'carrito'=>[
            'title' => 'Prisma | Mi carrito'
        ],

        [

        ]
];


if(!isset($seccionesPermitidas[$seccion])){

$seccion = "404";
}



?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title><?= $seccionesPermitidas[$seccion]['title']; ?></title>
</head>
<body>
<header>
	<div class="container">

        <a href="index.php?s=home" class="link"><h1>Prisma</h1></a>

		<div class="row">
			 <?php require 'templates/nav.php' ?>
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

<footer>
	<?php require 'templates/footer.php' ?>

</footer>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.js"></script>	
<script src="js/animaScroll.js"></script>
<script src="js/script.js"></script>
</body>
</html>