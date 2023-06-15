<?php
include "app/helpers/generaDetalles.php";
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
          <span class="item__total">0</span>
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

  <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>
  <script src="./js/scripts.js"></script>
</body>

</html>