<?php
session_start();
include_once 'app/models/AccesoDatos.php';

function guardarProductoEnCarrito($producto){
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    $_SESSION['carrito'][] = serialize($producto);
}

function obtenerProductosDelCarrito(){
    $productos = array();

    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $productoSerializado) {
            $productos[] = unserialize($productoSerializado);
        }
    }

    return $productos;
}

function generarElementos($categoria)
{
    //$categoria = isset($_POST['category']) ? $_POST['category'] : "";
    $db = AccesoDatos::getModelo();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
        $productoID = $_POST['add_to_cart'];
        $producto = $db->getProductoPorID($productoID);

        if ($producto) {
            guardarProductoEnCarrito($producto);
        }
    }

    $productos = $db->getProductos($categoria);
    $result = "";

    foreach ($productos as $producto) {
        $result .= '
            <div class="producto">
                <div class="image__container">
                    <img src="' . $producto->image . '" alt="">
                </div>
                <div class="producto__footer card-title">
                    <h1>' . $producto->title . '</h1>
                    <div class="price">$' . $producto->price . '</div>
                    <div class="stock">Quedan ' . $producto->stock . '</div>
                </div>
                <div class="bottom">
                    <div class="btn__group">
                        <form method="post" action="">
                            <input type="hidden" name="add_to_cart" value="' . $producto->id . '">
                            <button type="submit" class="btn btn-primary addToCart" data-id="' . $producto->id . '">Añadir carrito</button>
                        </form>
                        <a href="detalles.php?id=' . $producto->id . '" class="btn btn-primary view">Vista</a>
                    </div>
                </div>
            </div>
        ';
    }

    // Imprimir el resultado para ser utilizado en la respuesta AJAX
    return  $result;
}

// Llamar a la función generarElementos()

?>
