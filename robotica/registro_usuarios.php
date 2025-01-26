<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action']; // Determinar si es "registro" o "login"

    if ($action === 'registro') {
        // Campos para registro
        $nombre = $_POST['nombre'] ?? null;
        $apellido = $_POST['apellido'] ?? null;
        $gmail = $_POST['gmail'] ?? null;
        $contraseña = $_POST['contraseña'] ?? null;

        if ($nombre && $apellido && $gmail && $contraseña) {
            $contraseña_hashed = password_hash($contraseña, PASSWORD_DEFAULT);

            $sql = "INSERT INTO Usuarios (Nombre, Apellido, Gmail, Contraseña) 
                    VALUES ('$nombre', '$apellido', '$gmail', '$contraseña_hashed')";

            if ($conex->query($sql) === TRUE) {
                // Redirige al usuario a la página de contenido
                header('Location: TECHHOMEWEBNUEVO/TECHHOMEWEB/index.html'); // Cambia "contenido.html" por tu página deseada
                exit;
            } else {
                echo "Error: " . $conex->error;
            }
        } else {
            echo "Todos los campos son requeridos para el registro.";
        }
    } elseif ($action === 'login') {
        // Campos para iniciar sesión
        $gmail = $_POST['gmail'] ?? null;
        $contraseña = $_POST['contraseña'] ?? null;

        if ($gmail && $contraseña) {
            $sql = "SELECT Contraseña FROM Usuarios WHERE Gmail = '$gmail'";
            $result = $conex->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($contraseña, $row['Contraseña'])) {
                    // Inicio de sesión exitoso, redirigir
                    header('Location: TECHHOMEWEBNUEVO/TECHHOMEWEB/index.html'); // Cambia "contenido.html" por tu página deseada
                    exit;
                } else {
                    // Contraseña incorrecta
                    header('Location: index.html?error=incorrect_password');
                    exit;
                }
            } else {
                // Usuario no encontrado
                header('Location: index.html?error=user_not_found');
                exit;
            }
        } else {
            echo "Correo y contraseña son requeridos para iniciar sesión.";
        }
    } else {
        echo "Acción no válida.";
    }
}
