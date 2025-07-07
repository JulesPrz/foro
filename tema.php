<?php include 'db.php';
$id_tema = $_GET['id'];
$tema = $conn->query("SELECT * FROM temas WHERE id = $id_tema")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head><title><?php echo htmlspecialchars($tema['titulo']); ?></title></head>
<body>
<h2><?php echo htmlspecialchars($tema['titulo']); ?></h2>

<?php
$mensajes = $conn->query("
    SELECT m.contenido, m.fecha_creacion, u.nombre_usuario
    FROM mensajes m
    JOIN usuarios u ON m.id_usuario = u.id
    WHERE m.id_tema = $id_tema
    ORDER BY m.fecha_creacion ASC
");

while ($msg = $mensajes->fetch_assoc()) {
    echo "<p><strong>{$msg['nombre_usuario']}</strong>: " . nl2br(htmlspecialchars($msg['contenido'])) . "</p>";
}
?>

<?php if (isset($_SESSION['usuario_id'])): ?>
<hr>
<h3>Responder</h3>
<form method="POST" action="nuevo_mensaje.php">
    <input type="hidden" name="id_tema" value="<?php echo $id_tema; ?>">
    <textarea name="contenido" required></textarea><br>
    <button type="submit">Enviar respuesta</button>
    <a href="inicio.php" class="enlace-boton">Regresar al inicio</a>
</form>
<?php else: ?>
    <p><a href="login.php">Inicia sesión</a> para responder</p>
<?php endif; ?>



</body>
</html>
