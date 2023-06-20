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
    <title>Carrito</title>

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
                <h1>SNEAKER <span>SHOP</span></h1> 
                </div>
            </a>
            <ul class="nav__list">
            <?php
         if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
          // Mostrar el botón adicional para los usuarios con rol de administrador
          if (isset($_SESSION['rol']) && $_SESSION['rol'] === '1') {
              echo '<span class="add__icon">
              <a href="app/views/addProductos.php"><i class="bx bx-plus-circle"></i></a>
            </span>';
            }
        ?>
        <span class="login__icon">
          <?php
          // Verificar si el usuario ha iniciado sesión
         
            
              // El usuario ha iniciado sesión, mostrar icono de cierre de sesión y texto correspondiente
              echo '<span class="login__icon">
                      <a href="app/helpers/cerrarSesion.php"><i class="bx bx-log-out"></i></a>
                    </span>
                    <p></p>';
          } else {
              // El usuario no ha iniciado sesión, mostrar icono de inicio de sesión
              echo '<span class="login__icon">
                      <a href="app/views/inicioSesion.php"><i class="bx bx-user"></i></a>
                    </span>';
          }
          ?>
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
            <?php $productos = obtenerProductosDelCarrito(); ?>
            <?php if (!empty($productos)) { ?>
                <h3>Total: € <span class="carrito__total"><?= calcularTotalCarrito($productos) ?></span></h3>
                <button class="comprar__carrito btn" onclick="comprar()">Comprar</button>
                <button class="clear__carrito btn" onclick="clearCart()">Remover carrito</button>
            <?php } else { ?>
                <p>No hay productos en el carrito.</p>
            <?php } ?>
        </div>
    </div>
    <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">© 2023-2023 Sneaker shop</p>
    </footer>
    <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>
    <script src="web/js/funciones.js"></script>
</body>

</html>
