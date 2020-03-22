<?php
session_start();
require  '../funciones/autenticacion.php';

desloguear();


header("location: ../index.php?s=login");