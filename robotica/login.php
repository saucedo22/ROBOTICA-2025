<?php
//valida los credenciales del usuario e inicia secion
session_start();
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gmail = $_POST['gmail'];
    $contraseña = $_POST['contraseña'];

    // Verifica las credenciales del usuario
    $sql = "SELECT Usuario_id, Nombre, Roles_id FROM Usuarios WHERE Gmail = '$gmail'";
    $resultado = $conex->query($sql);

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        $rol_id = $usuario['Roles_id'];

        // Guarda los datos del usuario en la sesión
        $_SESSION['usuario_id'] = $usuario['Usuario_id'];
        $_SESSION['nombre'] = $usuario['Nombre'];
        $_SESSION['rol_id'] = $rol_id;

        // Redirige según el rol
        if ($rol_id == 1) {
            header("Location: admin.php"); // Página para administradores
        } elseif ($rol_id == 2) {
            header("Location: profesor.php"); // Página para profesores
        } else {
            header("Location: usuario.php"); // Página para usuarios normales
        }
        exit();
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
}
?>