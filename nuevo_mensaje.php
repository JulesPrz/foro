<?php include 'db.php';
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$id_tema = $_POST['id_tema'];
$contenido = $_POST['contenido'];
$id_usuario = $_SESSION['usuario_id'];

$stmt = $conn->prepare("INSERT INTO mensajes (id_tema, id_usuario, contenido) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $id_tema, $id_usuario, $contenido);
$stmt->execute();

header("Location: tema.php?id=$id_tema");
