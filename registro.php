<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Registro</title></head>
<body>
<h2>Registrarse</h2>
<form method="POST">
    Nombre de usuario:<br>
    <input type="text" name="nombre" required><br>
    Correo:<br>
    <input type="email" name="correo" required><br>
    Contraseña:<br>
    <input type="password" name="clave" required><br>
    <button type="submit">Crear cuenta</button>
</form>
<a href="login.php">¿Ya tienes cuenta? Inicia sesión</a>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre_usuario, correo, contrasena) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $correo, $clave);

    if ($stmt->execute()) {
        echo "<p>Usuario registrado correctamente. <a href='login.php'>Inicia sesión</a></p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}
?>
</body>
</html>

