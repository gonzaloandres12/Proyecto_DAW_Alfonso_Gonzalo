<?php
$servername = "localhost";
$username = "root";
$password = "7388";
$dbname = "tienda";

$conn = new mysqli($servername, $username, $password, $dbname);
$mensajeError = "x";
// Verificar si hay errores en la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Comprobar si se ha enviado el formulario de registro
if (isset($_POST['register'])) {
    // Obtener los datos del formulario
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Comprobar si el usuario y la contraseña están vacíos
    if (empty($username) || empty($password)) {
        $mensajeError="El usuario y la contraseña son campos obligatorios.";
        exit(); // Detener la ejecución del script
    }

    // Comprobar si el usuario ya existe en la base de datos
    $sql = "SELECT * FROM login WHERE user = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
       echo $mensajeError = "El usuario ya existe en la base de datos.";
       header('Location: ../resources/registrarPrueba.php?error=' . urlencode($mensajeError));
       exit(); // Detener la ejecución del script
    }

    // Cifrar la contraseña (puedes utilizar diferentes métodos de cifrado, este es solo un ejemplo)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario en la base de datos
    $sql = "INSERT INTO login (user, password) VALUES ('$username', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../index.html");
        exit;
        echo "Usuario registrado exitosamente!";
    } else {
        $mensajeError = "Error al registrar al usuario: " . $conn->error;
        header('Location: ../resources/registrarPrueba.php?error=' . urlencode($mensajeError));
        exit(); // Detener la ejecución del script
    }
}

// Comprobar si se ha enviado el formulario de inicio de sesión
// Comprobar si se ha enviado el formulario de inicio de sesión
if (isset($_POST['login'])) {
    // Obtener los datos del formulario de inicio de sesión
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Comprobar si el usuario y la contraseña están vacíos
    if (empty($username) || empty($password)) {
        $mensajeError= "El usuario y la contraseña son campos obligatorios.";
        header('Location: ../../inicioSesion.php?error='.$mensajeError);
        exit(); // Detener la ejecución del script
    }

    // Consultar la base de datos para verificar el usuario y la contraseña
    $sql = "SELECT * FROM login WHERE user = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        // Verificar la contraseña ingresada con la contraseña almacenada en la base de datos
        if (password_verify($password, $storedPassword)) {
            // Inicio de sesión exitoso
            // Iniciar sesión
            session_start();

            // Establecer variable de sesión para indicar que el usuario ha iniciado sesión
            $_SESSION['loggedin'] = true;

            // Establecer la duración de la sesión en 10 minutos (600 segundos)
            $_SESSION['expire'] = time() + 600;

            // Redirigir al usuario a la página principal
            
            header("Location: ../../index.php");
            exit;
            echo "Inicio de sesión exitoso para el usuario: " . $username;
            // Puedes redirigir al usuario a la página principal o realizar otras acciones necesarias
        } else {
            $mensajeError = "Contraseña incorrecta.";
            header('Location: ../../inicioSesion.php?error=' . urlencode($mensajeError));
            exit(); // Detener la ejecución del script
        }
    } else {
        $mensajeError = "Usuario no encontrado.";
        header('Location: ../../inicioSesion.php?error=' . urlencode($mensajeError));
        exit(); // Detener la ejecución del script
    }
}

$conn->close();
?>
