<?php
    $host = "localhost";
    $usuario = "root";
    $password = "";
    $db = "robotica";
    $conex = new mysqli($host,$usuario,$password,$db);

    if ($conex->connect_error){
        die("Error de conexion: " . $conex->connect_error);
    }else{
        echo "conexion exitosa";
    }
   
?>