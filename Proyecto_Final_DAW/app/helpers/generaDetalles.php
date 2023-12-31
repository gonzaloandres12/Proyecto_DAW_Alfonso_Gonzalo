<?php
include "app/helpers/generarCarrito.php";
include 'app/models/AccesoDatos.php';

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


function detalleProducto($id) {
    $db = AccesoDatos::getModelo();
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
        $productoID = $_POST['add_to_cart'];
        $producto = $db->getProductoPorID($productoID);

        if ($producto) {
            guardarProductoEnCarrito($producto);
        }
    }
    $idCheck = isset($id) ? $id : null;
    $producto = $db->getProductoPorId($idCheck);

    $result = "";

    $result .= '
        <article class="detalle-grid">
            <img src="' . $producto->image . '" alt="' . $producto->title . '" class="img-fluid">
            <div class="detalles-content">
                <h3>' . $producto->title . '</h3>
                <div class="rating">
                    <span>
                        <i class="bx bxs-star"></i>
                    </span>
                    <span>
                        <i class="bx bxs-star"></i>
                    </span>
                    <span>
                        <i class="bx bxs-star"></i>
                    </span>
                    <span>
                        <i class="bx bxs-star"></i>
                    </span>
                    <span>
                        <i class="bx bx-star"></i>
                    </span>
                </div>
                <p class="price"><b>Precio: </b> $' . $producto->price . '</p>
                <p class="description">
                    <b>Descripcion: </b> <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta quae ad ex sint expedita perspiciatis odit eligendi! Et quia ex aperiam dolorum sunt omnis maiores. Repudiandae delectus iste exercitationem vel?</span>
                </p>
                <p class="description">
                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque voluptates consequuntur in assumenda odit hic, aut cupiditate dolorem aspernatur! Quibusdam iusto magnam vero maxime quisquam voluptatibus minima aliquam molestias, iure ratione commodi, reiciendis quasi.</span>
                </p>
                <button onclick="goBack()" class="btn btn-outline-light btn-lg px-5">Volver</button>
            </div>
        </article>
    ';

    return $result;
}
?>
