<?php
//conexion
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'gambito1_contactos';
$bd = mysqli_connect($host, $user, $password, $database);
mysqli_query($bd, "SET NAMES 'utf8'");