<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Foro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bodyInicio">

    <header class="barra-navegacion">
  <div class="barra-contenido">
    <h1 class="titulo-logo">Inkspira</h1>

    <nav class="nav-links">
      <?php if (isset($_SESSION['usuario_id'])): ?>
        <span class="usuario-nombre">Hola, <?php echo $_SESSION['usuario_nombre']; ?></span>
        <a href="crear_tema.php" class="nav-btn">Crear nueva historia</a>
        <a href="logout.php" class="nav-btn">Cerrar sesión</a>
      <?php else: ?>
        <a href="login.php" class="nav-btn">Iniciar sesión</a>
        <a href="registro.php" class="nav-btn">Registrarse</a>
      <?php endif; ?>
    </nav>
  </div>
</header>



    <main class="containerInicio">
        <section class="temas-recientes">
            <h2>Temas recientes</h2>
            <div class="lista-temas">
                <?php
                $temas = $conn->query("SELECT t.id, t.titulo, t.fecha_creacion, u.nombre_usuario 
                                        FROM temas t 
                                        JOIN usuarios u ON t.id_usuario = u.id 
                                        ORDER BY t.fecha_creacion DESC");

                while ($tema = $temas->fetch_assoc()) {
                     echo "<div class='tema-item'>";
                     echo "<a href='tema.php?id={$tema['id']}' class='tema-titulo'>" . htmlspecialchars($tema['titulo']) . "</a>";
                     echo "<p class='tema-meta'>por <strong>{$tema['nombre_usuario']}</strong> — " . date('d/m/Y', strtotime($tema['fecha_creacion'])) . "</p>";
                     echo "</div>";
                 }
                 ?>
            </div>
        </section>
    </main>
</body>
</html>
