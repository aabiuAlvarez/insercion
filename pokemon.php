<?php
require_once '../config/conexion.php';

$datos = json_decode(file_get_contents("php://input"), true);
$mensaje = "Datos guardados exitosamente.";

try {
    $sql = "INSERT INTO t_pokemon (nombre, altura, tipo, habilidad_1, habilidad_2, experiencia_base, movimiento_1, movimiento_2) 
            VALUES (:nombre, :altura, :tipo, :habilidad_1, :habilidad_2, :experiencia_base, :movimiento_1, :movimiento_2)";
    $stmt = $conexion->prepare($sql);

    foreach ($datos as $pokemon) {
        $stmt->execute([
            ':nombre' => $pokemon['nombre'],
            ':altura' => $pokemon['altura'],
            ':tipo' => $pokemon['tipo'],
            ':habilidad_1' => $pokemon['habilidad_1'],
            ':habilidad_2' => $pokemon['habilidad_2'],
            ':experiencia_base' => $pokemon['experiencia_base'],
            ':movimiento_1' => $pokemon['movimiento_1'],
            ':movimiento_2' => $pokemon['movimiento_2']
        ]);
    }
} catch (Exception $e) {
    $mensaje = "Error al guardar los datos: " . $e->getMessage();
}

echo json_encode(['mensaje' => $mensaje]);
?>
