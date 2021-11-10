<?php
    require_once dirname( __DIR__ ) .'\model\Conexion.php';

    if(isset($_GET['rfid'])&&isset($_GET['pass'])){
        $tarjeta = $_GET['rfid'];
        $pass = $_GET['pass'];
        $conexion = new Conexion();
        $resultado = $conexion->verificarCredenciales($tarjeta,$pass);
        header('Content-type: text/html');
        echo $resultado; 
    }
?>