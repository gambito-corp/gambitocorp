<?php
$servidor = "localhost";
$bd = "monzon_test1";
$usuario = "monzon_root";
$contraseña = "c4tntnox*+";
// se crea la conexion
$con = mysqli_connect($servidor, $usuario, $contraseña, $bd);
// comprobar conexion
if (!$con) {
      die("Fallo de conexion: " . mysqli_connect_error());
}
 
echo "Conexion Exitosa";
// declaro las n variables
    $nombre=$_POST['nombre'];
    $email=$_POST['email'];
    $comentario=$_POST['comentario'];
 //inserto los datos
$sql = "INSERT INTO aaa (nombre, email, comentario) VALUES ('$nombre', '$email', '$comentario')";
if (mysqli_query($con, $sql)) {
      echo "Nuevo registro creado";
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
mysqli_close($con);
?>