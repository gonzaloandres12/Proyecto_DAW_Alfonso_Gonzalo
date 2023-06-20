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
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
<!--begin::Page loading(append to body)-->
<div class="page-loader flex-column">
    <span class="spinner-border text-primary" role="status"></span>
    <span class="text-muted fs-6 fw-semibold mt-5">Cargando...</span>
</div>
<?php
session_start();

// Eliminar el carrito de la sesión
unset($_SESSION['carrito']);
?>
<!--end::Page loading-->
<script>
        document.addEventListener("DOMContentLoaded", function() {
            // Esperar 3 segundos (3000 ms) antes de redirigir
            setTimeout(function() {
                // Redirigir a otra página
                window.location.href = "../../index.php";
                // Reemplazar la entrada actual en el historial con la página de inicio
            history.replaceState(null, '', '../../index.php');
            }, 3000);
        });
    </script>
</body>

</html>