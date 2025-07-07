<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión - Inkspira</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/yourfontawesomekit.js" crossorigin="anonymous"></script> <!-- Si quieres usar íconos -->
</head>

<body>
    <div class="container">
        
        <div class="panel-izquierdo">
            <div class="logo">
                <!-- <img src="./iconos/logo_Inkspira.png" alt="Logo Inkspira" class="logoLogin"> -->
                <h1>Inkspira</h1>
            </div>

            <h2>¡Hola!, ¿qué nueva historia traes hoy?</h2>
            
            <form method="POST">
                <div class="formulario">
                    <input type="email" name="correo" placeholder="Email" required>
                </div>

                <div class="formulario">
                    <input type="password" name="clave" placeholder="Contraseña" required>
                </div>

                <div class="botones">
                    <button type="submit">Iniciar sesión</button>
                    <a href="registro.php" class="enlace-boton">Crear cuenta</a>
                </div>
            </form>
        </div>

        <div class="panel-derecho">
            <img src="./iconos/imgPanel.jpg" alt="Ilustración login">
        </div>
    </div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];

    $stmt = $conn->prepare("SELECT id, nombre_usuario, contrasena FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($usuario = $result->fetch_assoc()) {
        if (password_verify($clave, $usuario['contrasena'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre_usuario'];
            header("Location: inicio.php");
        } else {
            echo "<p>Contraseña incorrecta</p>";
        }
    } else {
        echo "<p>Correo no registrado</p>";
    }
}
?>
</body>
</html>