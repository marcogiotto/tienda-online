<?php

session_start();

const DB_HOST = 'localhost';
const DB_USER ='root';
const DB_PASSWORD = '';
const DB_BASE = 'prisma';

$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_BASE);

if(!$db){
    require 'mantenimiento.php';
    exit;

}

mysqli_set_charset($db,'utf8mb4');