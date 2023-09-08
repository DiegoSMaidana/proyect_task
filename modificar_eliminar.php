<?php

$host = "localhost";
$usuario = "root";
$contraseña = "";
$base_de_datos = "proyecto_tareas";

$conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos);

$fila= isset($_POST['id']) ? $_POST['id'] : null;
$fila = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$fila = isset($_POST['estado']) ? $_POST['estado'] : null;


if (isset($_POST['modificar'])) {
    // Procesar la solicitud de modificación
    $id = $_POST['id'];
    // Redirige al usuario a la página de edición con el ID del registro a editar
    header("Location: editar_registro.php?id=$id");
    exit(); // Asegura que la redirección se ejecute y termina el script
} elseif (isset($_POST['eliminar'])) {
    // Procesar la solicitud de eliminación
    $id = $_POST['id'];

    // Realiza una consulta SQL para eliminar el registro con el ID proporcionado
    $query = "DELETE FROM taks WHERE id = $id";

    if ($conexion->query($query) === TRUE) {
        echo "Registro eliminado con éxito.";
    } else {
        echo "Error al eliminar el registro: " . $conexion->error;
    }
}

// Cerrar la conexión a la base de datos (si es necesario)
$conexion->close();
?>
