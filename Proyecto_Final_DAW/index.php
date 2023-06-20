<?php
include "app/helpers/generaCuadros.php";
include "app/helpers/generarCarrito.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gonzalo - Tienda de zapatillas</title>

  <!--Google fonts-->
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
  <!--Bootstrap CSS-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <link rel="shortcut icon" href="app/img/favicon-32x32.png" type="image/x-icon">
  <!--Box icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
  <link rel="stylesheet" href="web/css/style.css" />

</head>

<body>
  <!--Navegation-->
  <nav class="nav">
    <div class="nav__center container">
      <div class="nav__logo">
        <h1>ALFONSO <span>GONZALO</span></h1>
      </div>
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
  <section class="filter">
  <div class="grid">
    <div class="category">
      <form id="categoryForm" method="POST" action="">
        <select id="category" name="category">
          <option value="">Marcas</option>
          <option value="Nike">Nike</option>
          <option value="Puma">Puma</option>
          <option value="Adidas">Adidas</option>
          <option value="Salomon">Salomon</option>
          <option value="Fila">Fila</option>
          <option value="Under Armour">Under Armour</option>
          <option value="Vans">Vans</option>
          <option value="Converse">Converse</option>
          <option value="New Balance">New Balance</option>
        </select>
        <button type="submit" class="btn btn_filter">Filtrar</button>
      </form>
    </div>
  </div>
</section>

  <!--Productos-->
  <section class="productos">
    <div class="productos__center">
    <?php 
        $categoria = isset($_POST['category']) ? $_POST['category'] : "";
        echo generarElementos($categoria)
      
        ?>
    </div>
      <!--Generar los elementos -->
    </section>

  <!--Carrito-->

  <section class="carrito__overlay">
    <div class="carrito">
      <span class="close__carrito">
        <i class="bx bx-x"></i>
      </span>
      <h1>Su Carrito</h1>

      <div class="carrito__center">
      </div>
      <div class="carrito__footer">
        <h3>Total: € <span class="carrito__total"><?= calcularTotalCarrito(obtenerProductosDelCarrito()) ?></span></h3>
        <button class="comprar__carrito btn">Comprar</button>
        <button class="clear__carrito btn" onclick="clearCart()">Remover carrito</button>
      </div>
    </div>
  </section>

  <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>
  <script src="web/js/funciones.js"></script>

</body>

</html>