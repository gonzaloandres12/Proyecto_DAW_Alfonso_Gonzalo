<?php
include "app/helpers/generaDetalles.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Productos detalles</title>

  <!--Google fonts-->
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
  <link rel="shortcut icon" href="app/img/favicon-32x32.png" type="image/x-icon">

  <!--Box icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />

  <link rel="stylesheet" href="web/css/style.css" />
  <script>function goBack() {
  window.location.href = "index.php"; // Reemplaza "ruta_del_archivo" con la ruta al archivo deseado
}</script>
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
        <a href="carrito.php"><i class="bx bx-cart"></i></a>
        </div>
      </ul>
    </div>
  </nav>

  <main class="container detalles" id="detalles">
    <?=detalleProducto(isset($_GET['id']) ? $_GET['id'] : '');?>
  </main>

  <!--Carrito-->

  <section class="carrito__overlay">
    <div class="carrito">
      <span class="close__carrito">
        <i class="bx bx-x"></i>
      </span>
      <h1>Su Carrito</h1>

      <div class="carrito__center"></div>

      <div class="carrito__footer">
        <h3>Total: $ <span class="carrito__total">0</span></h3>
        <button class="clear__carrito btn">remover carrito</button>
      </div>
    </div>
  </section>
  <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">© 2023-2023 Sneaker shop</p>
        </footer>

  <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>
</body>

</html>