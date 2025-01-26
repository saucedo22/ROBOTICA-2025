<?php
    session_start();
    $_SESSION['usuario'] = $_POST['usuario'];
    $_SESSION['rol'] = $_POST['rol'];
    echo $_SESSION['usuario'];
    //header('Location: principal.php');
?>