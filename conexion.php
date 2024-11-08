<?php 
$user = "root";
$pass = "";
$server = "localhost";
$nameDB = "practica2";

try {
    $conexion = new PDO("mysql:host=$server;dbname=$nameDB", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa a la base de datos 'practica2'";  
} catch (PDOException $e) {
    die('Conexión fallida: ' . $e->getMessage());
}
?>
