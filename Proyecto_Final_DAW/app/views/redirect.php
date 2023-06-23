<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout</title>

    <!--Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="shortcut icon" href="app/img/favicon-32x32.png" type="image/x-icon">
    <!--Box icons-->
    <link rel="shortcut icon" href="app/img/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../../web/css/redirect.css">
</head>

<body>
<!--begin::Page loading(append to body)-->
<div class="page-loader flex-column">
    <span class="spinner-border text-primary" role="status"></span>
    <span class="text-muted fs-6 fw-semibold mt-5">Cargando...</span>
</div>
<?php
include "../models/Productos.php";
session_start();
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    $mensajeError = "No hay productos en el carrito.";
    header('Location: ../../carrito.php?error=' . $mensajeError);
    exit(); // Detener la ejecución del script
}else{
    $productos = $_SESSION['carrito'];


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


$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$direccion = $_POST['direccion'];


$nombre = $conexion->real_escape_string($nombre);
$apellido = $conexion->real_escape_string($apellido);
$email = $conexion->real_escape_string($email);
$direccion = $conexion->real_escape_string($direccion);

// Generar un ID único para el pedido
$pedidoId = uniqid();
$totalPrecio = 0;
$stockInsuficiente = array();


foreach ($productos as $producto) {
    // Obtener los datos del producto
    $producto = unserialize($producto);

    // Verificar el stock antes de realizar la actualización
    $sqlStock = "SELECT `stock` FROM `productos` WHERE `id` = $producto->id";
    $resultStock = $conexion->query($sqlStock);

    if ($resultStock !== FALSE && $resultStock->num_rows > 0) {
        $row = $resultStock->fetch_assoc();
        $stock = $row['stock'];

        // Verificar la cantidad de productos en el pedido
        $cantidadProducto = 0;
        foreach ($productos as $productoEnPedido) {
            if (unserialize($productoEnPedido)->id == $producto->id) {
                $cantidadProducto++;
            }
        }

        if ($cantidadProducto > $stock) {
            // No hay suficiente stock para el producto en el pedido
            $stockInsuficiente[$producto->id] = $stock;
        }
    }
}
$productosT = $_SESSION['carrito'];

foreach ($productosT as $productoSerializado) {
    $productoT = unserialize($productoSerializado);
    $totalPrecio += $productoT->price;
}

if (empty($stockInsuficiente)) {
    foreach ($productos as $producto) {
        // Obtener los datos del producto
        $producto = unserialize($producto);

        // Preparar la consulta SQL para actualizar el stock
        $sqlUpdateStock = "UPDATE `productos` SET `stock` = `stock` - 1 WHERE `id` = $producto->id";

        // Ejecutar la consulta y manejar errores
        if ($conexion->query($sqlUpdateStock) !== TRUE) {
            $mensajeError = "Error al comprar: " . $conexion->error;
            header('Location: compraProducto.php?error=' . $mensajeError);
            exit(); // Detener la ejecución del script
        }

        // Preparar la consulta SQL para insertar el pedido
        $sql = "INSERT INTO pedidos (`idPedido`, `fechaPedido`, `nombreCliente`, `precioTotal`, `direccionEnvio`, `email`, `productoId`)
                VALUES ('$pedidoId', NOW(), '$nombre-$apellido', '$totalPrecio', '$direccion', '$email', '$producto->id')";

        // Ejecutar la consulta y manejar errores
        if ($conexion->query($sql) !== TRUE) {
            $mensajeError = "Error al comprar: " . $conexion->error;
            header('Location: compraProducto.php?error=' . $mensajeError);
            exit(); // Detener la ejecución del script
        }

     
    }
} else {
    // Cancelar el pedido y redirigir con el mensaje de error
    $mensajeError = "El pedido se ha cancelado debido a falta de stock en los siguientes productos:";
    foreach ($stockInsuficiente as $productoId => $stock) {
        $producto = unserialize($productoId);
        $mensajeError .= " " . $productoT->title . " (quedan " . $stock . "),";
    }
    
    header('Location: compraProducto.php?error=' . $mensajeError);
    exit(); // Detener la ejecución del script
}

// Eliminar el carrito de la sesión después de insertar los pedidos
unset($_SESSION['carrito']);

header('Location: ../../index.php');
}

?>
  
<script>
        document.addEventListener("DOMContentLoaded", function() {
            // Esperar 3 segundos (3000 ms) antes de redirigir
            setTimeout(function() {
                // Redirigir a otra página
                window.location.href = "../../index.php";
                // Reemplazar la entrada actual en el historial con la página de inicio
            history.replaceState(null, '', '../../index.php');
            }, 4000);
        });
    </script> 
  <!--
end::Page loading-->


</body>

</html>