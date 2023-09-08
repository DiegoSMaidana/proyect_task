<?php
$host = "localhost";
$usuario = "root";
$contraseña = "";
$base_de_datos = "proyecto_tareas";

$conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
   
    $query = "SELECT * FROM taks WHERE id = $id";
    $resultado = $conexion->query($query);
    
    if ($resultado->num_rows == 1) {
       
        $fila = $resultado->fetch_assoc();
        
        
        if (isset($_POST['nombre']) && isset($_POST['estado'])) {
            $nuevoNombre = $_POST['nombre'];
            $nuevoEstado = $_POST['estado'];
            
            // Actualizar el registro en la base de datos
            $query = "UPDATE taks SET nombre = '$nuevoNombre', estado = '$nuevoEstado' WHERE id = $id";
            
            if ($conexion->query($query) === TRUE) {
                echo "Registro actualizado con éxito.";
            } else {
                echo "Error al actualizar el registro: " . $conexion->error;
            }
        }
        
        
        echo '<form method="post" action="">'; 
        echo '<input type="hidden" name="id" value="' . $fila['id'] . '">';
        echo 'Nombre: <input type="text" name="nombre" value="' . $fila['nombre'] . '"><br>';
        echo 'Estado: <input type="text" name="estado" value="' . $fila['estado'] . '"><br>';
        echo '<input type="submit" value="Guardar cambios">';
        echo '</form>';
    } else {
        echo "Registro no encontrado.";
    }
} else {
    echo "ID de registro no proporcionado.";
}


$conexion->close();
?>
