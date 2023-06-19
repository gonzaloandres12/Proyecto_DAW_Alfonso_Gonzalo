<?php

session_start();


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



function generarElementos()
{
    include_once 'app/models/AccesoDatos.php';
    $categoria = isset($_POST['category']) ? $_POST['category'] : "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
        $productoID = $_POST['add_to_cart'];
        $db = AccesoDatos::getModelo();
        $producto = $db->getProductoPorID($productoID);

        if ($producto) {
            guardarProductoEnCarrito($producto);
        }
    }

    var_dump($categoria);
    $db = AccesoDatos::getModelo();
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
    
        // Recargar la página después de generar los elementos
    echo $result;
}

?>
