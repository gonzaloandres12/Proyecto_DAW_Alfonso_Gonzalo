<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../web/css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">

</head>
<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">
      
                  <div class="mb-md-5 mt-md-4 pb-5">
      
                    <h2 class="fw-bold mb-2 text-uppercase">Registro</h2>
                    <p class="text-white-50 mb-5">Por favor introduce user y contraseña</p>
                    <p style="color: red;"><?php echo !empty($_GET['error']) ? $_GET['error']: ''; ?></p>
                    <form method="POST" action="../helpers/loginCheck.php">
                    <div class="form-outline form-white mb-4">
                      <input type="text" id="typeUserX" class="form-control form-control-lg"  name="username" required/>
                      <label class="form-label" for="typeUserX">Nombre de usuario</label>
                    </div>
      
                    <div class="form-outline form-white mb-4">
                      <input type="password" id="typePasswordX" class="form-control form-control-lg" name="password" required/>
                      <label class="form-label" for="typePasswordX">Contraseña</label>
                    </div>
      
      
                    <button class="btn btn-outline-light btn-lg px-5" type="submit" name="register">Registrame</button>


                </form>
      
                  </div>
      
                  <div>
                    <p class="mb-0">Tienes cuenta? <a href="/app/views/inicioSesion.phps" class="text-white-50 fw-bold">Iniciar Sesion</a>
                    </p>
                  </div>
      
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</body>
</html>