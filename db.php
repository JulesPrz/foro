<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "foro";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
