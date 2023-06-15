<?php
include "app/models/AccesoDatos.php";


function detalleProducto($id) {
    $db = AccesoDatos::getModelo();
    $idCheck = isset($id) ? $id : null;
    $producto = $db->getProductoPorId($idCheck);

    $result = "";

    $result .= '
        <article class="detalle-grid">
            <img src=' . $producto->image . ' alt="' . $producto->title . '" class="img-fluid">
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
                <div class="bottom">
                    <div class="btn__group">
                        <button class="btn addToCart" data-id=' . $producto->id . '>Añadir carrito</button>
                    </div>
                </div>
            </div>
        </article>
    ';

    return $result;
}
?>
