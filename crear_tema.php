<?php include 'db.php';
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Nuevo Tema</title></head>
<body>
<h2>Crear nuevo tema</h2>
<form method="POST">
    Título del tema:<br>
    <input type="text" name="titulo" required><br>
    Mensaje inicial:<br>
    <textarea name="mensaje" required></textarea><br>
    <button type="submit">Publicar</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $mensaje = $_POST['mensaje'];
    $id_usuario = $_SESSION['usuario_id'];

    $stmt = $conn->prepare("INSERT INTO temas (titulo, id_usuario) VALUES (?, ?)");
    $stmt->bind_param("si", $titulo, $id_usuario);
    $stmt->execute();
    $id_tema = $conn->insert_id;

    $stmt = $conn->prepare("INSERT INTO mensajes (id_tema, id_usuario, contenido) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $id_tema, $id_usuario, $mensaje);
    $stmt->execute();

    header("Location: tema.php?id=$id_tema");
}
?>
</body>
</html>
