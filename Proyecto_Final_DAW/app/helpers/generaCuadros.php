<?php
include "app/models/AccesoDatos.php";

function generarElementos () {
    $db = AccesoDatos::getModelo();
    $productos = $db->getProductos();
    $result = "";

    foreach ($productos as $producto) {
        $result .= '
            <div class="producto">
                <div class="image__container">
                    <img src=' . $producto->image . ' alt="">
                </div>
                <div class="producto__footer card-title">
                    <h1>' . $producto->title . '</h1>
                    <div class="price">$' . $producto->price . '</div>
                    <div class="stock">Quedan ' . $producto->stock . '</div>
                </div>
                <div class="bottom">
                    <div class="btn__group">
                        <button class="btn btn-primary addToCart" data-id=' . $producto->id . '>Añadir carrito</button>
                        <a href="detalles.php?id=' . $producto->id . '" class="btn btn-primary view">Vista</a>
                    </div>
                </div>
            </div>
        ';
    }

    return $result;
}
?>
