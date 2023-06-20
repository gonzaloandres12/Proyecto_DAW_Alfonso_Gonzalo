<!DOCTYPE html>
<html>
<head>
  <title>Formulario para guardar Productos</title>
  <link rel="stylesheet" href="../../web/css/newProducto.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
</head>
<body>
  <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
              <div class="mb-md-5 mt-md-4 pb-5">
                <h2 class="fw-bold mb-2 text-uppercase">Guardar Productos</h2>
                <p style="color: red;">
                  <?php echo !empty($_GET['error']) ? $_GET['error'] : ''; ?>
                </p>
                <form method="POST" action="../helpers/guardarProducto.php" class="text-start">
                  <div class="form-outline form-white mb-4">
                    <label class="form-label" for="title">Título:</label>
                    <input type="text" id="title" class="form-control form-control-lg" name="title" >
                  </div>
                  <div class="form-outline form-white mb-4">
                    <label class="form-label" for="price">Precio:</label>
                    <input type="number" step="0.01" id="price" class="form-control form-control-lg" name="price" >
                  </div>
                  <div class="form-outline form-white mb-4">
                    <label class="form-label" for="image">Imagen:</label>
                    <input type="text" id="image" class="form-control form-control-lg" name="image" >
                  </div>
                  <div class="form-outline form-white mb-4">
                    <label class="form-label" for="category">Categoría:</label>
                    <input type="text" id="category" class="form-control form-control-lg" name="category" >
                  </div>
                  <div class="form-outline form-white mb-4">
                    <label class="form-label" for="stock">Stock:</label>
                    <input type="number" id="stock" class="form-control form-control-lg" name="stock" >
                  </div>
                  <div class="form-outline form-white mb-4">
                    <label class="form-label" for="size">Tamaño:</label>
                    <input type="text" id="size" class="form-control form-control-lg" name="size" >
                  </div>
                  <button class="btn btn-outline-light btn-lg px-5" type="submit">Guardar</button>
                  <button type="button" onclick="goBack()" class="btn btn-outline-light btn-lg px-5">Volver</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="../../web/js/funciones.js"></script>
</body>



</html>
