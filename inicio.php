<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Foro</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<h1>Foro Web</h1>

<?php if (isset($_SESSION['usuario_id'])): ?>
    <p>Bienvenido, <?php echo $_SESSION['usuario_nombre']; ?> | <a href="logout.php">Cerrar sesión</a></p>
    <a href="crear_tema.php">+ Crear nuevo tema</a>
<?php else: ?>
    <p><a href="login.php">Iniciar sesión</a> | <a href="registro.php">Registrarse</a></p>
<?php endif; ?>

<hr>
<h2>Temas recientes:</h2>

<?php
$temas = $conn->query("SELECT t.id, t.titulo, t.fecha_creacion, u.nombre_usuario 
                       FROM temas t 
                       JOIN usuarios u ON t.id_usuario = u.id 
                       ORDER BY t.fecha_creacion DESC");

while ($tema = $temas->fetch_assoc()) {
    echo "<p><a href='tema.php?id={$tema['id']}'>" . htmlspecialchars($tema['titulo']) . "</a> — por <strong>{$tema['nombre_usuario']}</strong></p>";
}
?>
</body>
</html>

