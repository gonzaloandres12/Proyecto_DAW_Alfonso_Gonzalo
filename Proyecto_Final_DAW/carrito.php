<?php
include "app/helpers/generaCuadros.php";
include "app/helpers/generarCarrito.php";


if (isset($_GET['remove_item'])) {
    $productoID = $_GET['remove_item'];

    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $key => $productoSerializado) {
            $producto = unserialize($productoSerializado);
            if ($producto->id == $productoID) {
                unset($_SESSION['carrito'][$key]);
                break;
            }
        }
    }

    header("Location: carrito.php");
    exit();
}

if (isset($_GET['clear_cart'])) {
    unset($_SESSION['carrito']);
    header("Location: carrito.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JSON DEV - Productos detalles</title>

    <!--Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="app/img/favicon-32x32.png" type="image/x-icon">

    <!--Box icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />

    <link rel="stylesheet" href="web/css/style.css" />
</head>

<body>
    <!--Navegation-->
    <nav class="nav">
        <div class="nav__center container">
            <a href="index.php">
                <div class="nav__logo">
                    <h1>ALFONSO <span>GONZALO</span></h1>
                </div>
            </a>
            <ul class="nav__list">
                <span class="login__icon">
                    <a href=".//resources/LoginPruabaForm.php"><i class='bx bx-user'></i></a>
                </span>
                <div class="carrito__icon">
                    <i class="bx bx-cart"></i>
                    <span id="item-total" class="item__total"><?=cantProductos(obtenerProductosDelCarrito());?></span>
                </div>
            </ul>
        </div>
    </nav>

    <div class="carrito show">
        <h1>Su Carrito</h1>

        <div class="carrito__center">
            <?= generarElementosCarrito(obtenerProductosDelCarrito()); ?>
        </div>

        <div class="carrito__footer">
            <h3>Total: € <span class="carrito__total"><?=calcularTotalCarrito(obtenerProductosDelCarrito())?></span></h3>
            <button class="comprar__carrito btn">Comprar</button>
            <button class="clear__carrito btn" onclick="clearCart()">Remover carrito</button>
        </div>
    </div>
    <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>
    <script src="web/js/funciones.js"></script>
</body>

</html>
