<?php
session_start();
if ($_SESSION['rol' ] == "usuario") {
    echo "Bienvenido administrador";
    echo $_SESSION["usuario"];
}else {
    if ($_SESSION['rol' ] == 'profesor') {
        echo "Bienvenido a la sesio de ventas";
        echo $_SESSION["usuario"];
    }else {
        echo "Iniciar nesion";
        header('location: iniciosesion.html');
    }
    
}

?>