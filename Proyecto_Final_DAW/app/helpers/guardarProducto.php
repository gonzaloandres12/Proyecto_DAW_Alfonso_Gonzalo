<?php
// Datos de conexión a la base de datos

$host = 'localhost'; // Ejemplo: localhost
$usuario = 'root';
$contrasena = 'root';
$nombre_bd = 'tienda';
// Conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contrasena, $nombre_bd);

// Verificar si hubo un error en la conexión
if ($conexion->connect_error) {
    die('Error en la conexión a la base de datos: ' . $conexion->connect_error);
}

// Obtener los datos del formulario
$title = $_POST['title'];
$price = $_POST['price'];
$image = $_POST['image'];
$category = $_POST['category'];
$stock = $_POST['stock'];
$size = $_POST['size'];

// Validar los datos (ejemplo de validación básica, personaliza según tus necesidades)
$errors = [];

if (empty($title)) {
    $mensajeError = "El campo 'title' es obligatorio.";
    header('Location: ../views/addProductos.php?error=' . urlencode($mensajeError));
    exit(); // Detener la ejecución del script
}

if (!is_numeric($price)) {
    $mensajeError = "El campo 'price' debe ser un valor numérico.";
    header('Location: ../views/addProductos.php?error=' . urlencode($mensajeError));
    exit(); // Detener la ejecución del script
}

// Agrega más validaciones según tus requisitos


// Escapar los datos antes de insertarlos en la consulta SQL
$title = $conexion->real_escape_string($title);
$image = $conexion->real_escape_string($image);
$category = $conexion->real_escape_string($category);
$size = $conexion->real_escape_string($size);

// Preparar la consulta SQL para insertar los datos en la tabla
$sql = "INSERT INTO productos (`title`, `price`, `image`, `category`, `stock`, `size`)
        VALUES ('$title', $price, '$image', '$category', $stock, '$size')";

// Ejecutar la consulta y manejar errores
if ($conexion->query($sql) === TRUE) {
    header("Location: ../../index.php");
} else {
    $mensajeError = "Error al registrar al usuario: " . $conn->error;
        header('Location: ../views/addProductos.php?error=' . urlencode($mensajeError));
        exit(); // Detener la ejecución del script
}


// Cerrar la conexión
$conexion->close();
?>
