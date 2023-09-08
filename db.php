<?php
// Conexión a la base de datos (ajusta los valores según tu configuración)
$host = "localhost";
$usuario = "root";
$contraseña = "";
$base_de_datos = "proyecto_tareas";

$conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Procesar el formulario
if (isset($_POST['nombre']) && isset($_POST['estado'])) {
    $nombre = $_POST['nombre'];
    $estado = $_POST['estado'];

    // Insertar en la base de datos
    $query = "INSERT INTO taks ( nombre, estado) VALUES ('$nombre', '$estado')";

    if ($conexion->query($query) === TRUE) {
        echo "Registro insertado con éxito.";
    } else {
        echo "Error: " . $query . "<br>" . $conexion->error;
    }
}

$query = "SELECT * FROM taks";  

$resultado = $conexion->query($query);

if ($resultado->num_rows > 0) {
    // Hay registros en la base de datos
    while ($fila = $resultado->fetch_assoc()) {
       
        echo "ID: " . $fila['id'] . "<br>";
        echo "Nombre: " . $fila['nombre'] . "<br>";
        echo "Estado: " . $fila['estado'] . "<br>";
            
    echo '<form method="post" action="modificar_eliminar.php">';
    echo '<input type="hidden" name="id" value="' . $fila['id'] . '">';
    echo '<input type="submit" name="modificar" value="Modificar">';
    echo '<input type="submit" name="eliminar" value="Eliminar">';
    echo '</form>';
    
    echo "<hr>";
    }
} else {
   
    echo "No se encontraron registros en la base de datos.";
}


$conexion->close();
?>