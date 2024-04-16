<?php
// Configuración de la conexión a la base de datos
$servername = "localhost"; // Cambia esto por la dirección de tu servidor de base de datos
$username = "root"; // Cambia esto por tu nombre de usuario de base de datos
$password = ""; // Cambia esto por tu contraseña de base de datos
$dbname = "formulario"; // Cambia esto por el nombre de tu base de datos

// Crear la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar datos del formulario si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $telefono = mysqli_real_escape_string($conn, $_POST["telefono"]);
    $asunto = mysqli_real_escape_string($conn, $_POST["asunto"]);
    $mensaje = mysqli_real_escape_string($conn, $_POST["mensaje"]);

    // Insertar datos en la base de datos
    $sql = "INSERT INTO contacts (nombre, email, telefono, asunto, mensaje) VALUES ('$nombre', '$email', '$telefono', '$asunto', '$mensaje')";

    if ($conn->query($sql) === TRUE) {
        echo "¡Formulario enviado correctamente!";
    } else {
        echo "Error al enviar el formulario. Por favor, inténtalo de nuevo más tarde.";
        error_log("Error en la inserción de datos en la base de datos: " . $conn->error);
    }
}

// Cerrar la conexión
$conn->close();
?>
