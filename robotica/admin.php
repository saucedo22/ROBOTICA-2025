<?php
session_start();
// verifica el rol del usuario al cargar la pagina


// Verificar si el usuario tiene sesión iniciada
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html"); // Redirige al login si no está autenticado
    exit();
}

// Verificar si el usuario tiene el rol adecuado
if ($_SESSION['rol_id'] != 1) { // 1 = administrador según la base de datos
    header("Location: no_autorizado.php"); // Página de acceso denegado
    exit();
}

echo "Bienvenido, " . $_SESSION['nombre'] . " (Administrador)";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
</head>
<body>
    <h1>Panel de Administrador</h1>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>