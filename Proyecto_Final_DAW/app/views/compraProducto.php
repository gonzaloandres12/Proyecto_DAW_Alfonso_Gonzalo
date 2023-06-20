<?php
include "../models/Productos.php";
include "../helpers/generarCarrito.php";
session_start();

// Verificar si el carrito tiene productos
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    $mensajeError = "No hay productos en el carrito.";
    header('Location: ../../carrito.php?error=' . $mensajeError);
    exit(); // Detener la ejecución del script
} else {
    // Aquí puedes realizar el procesamiento del checkout con los productos recibidos
    // Por ejemplo, puedes guardar los detalles de la compra en una base de datos y generar un comprobante

    // Acceder a los productos del carrito
    $productos = $_SESSION['carrito'];

    $totalPrecio = 0;
    foreach ($productos as $productoSerializado) {
        $producto = unserialize($productoSerializado);
        $totalPrecio += $producto->price;
    }
}
?>
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
    <link rel="stylesheet" href="web/css/style.css" />
</head>

<body class="bg-light">
<div class="container">
        <div class="py-5 text-center">
            <h2>Checkout</h2>
        </div>
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Tu carrito</span>
                    <span class="badge badge-secondary badge-pill"><?php echo count($productos); ?></span>
                </h4>
                <ul class="list-group mb-3">
                    <?php foreach ($productos as $productoSerializado) {
                        $producto = unserialize($productoSerializado);
                    ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?php echo $producto->title; ?></h6>
                                <small class="text-muted"><?php echo $producto->description; ?></small>
                            </div>
                            <span class="text-muted"><?php echo $producto->price; ?>€</span>
                        </li>
                    <?php } ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>€<?=$totalPrecio?></strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Dirección de facturación</h4>
                <form class="needs-validation was-validated" novalidate="" action="redirect.php">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Primer nombre</label>
                            <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Segundo nombre</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="" required="">
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted">(Opcional)</span></label>
                        <input type="email" class="form-control" id="email" placeholder="you@example.com">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Direccion</label>
                        <input type="text" class="form-control" id="address" placeholder="1234 Main St" required="">
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address2">Direccion 2 <span class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                    </div>

                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Pais</label>
                            <select class="custom-select d-block w-100" id="country" required="">
                                <option value="">Elige...</option>
                                <option></option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">Ciudad</label>
                            <select class="custom-select d-block w-100" id="state" required="">
                                <option value="">Elige...</option>
                                <option></option>
                            </select>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>

                    </div>

                    <hr class="mb-4">

                    <h4 class="mb-3">Payment</h4>

                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="">
                            <label class="custom-control-label" for="paypal">PayPal</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cc-name">Name on PayPal</label>
                            <input type="email " class="form-control" id="cc-name" placeholder="" required="">
                            <div class="invalid-feedback">
                                Name on card is required
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Pagar</button>
                </form>
            </div>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">© 2023-2023 Sneaker shop</p>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery.slim.min.js"><\/script>')
    </script>
    <script src="/docs/4.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="form-validation.js"></script>

</body>

</html>