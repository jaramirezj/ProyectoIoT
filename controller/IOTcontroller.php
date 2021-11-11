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
    if(isset($_GET['salida'])){
        $conexion = new Conexion();
        $conexion->cambiarActual("-1");
    }
    if(isset($_GET['estado'])){
        $conexion = new Conexion();
        header('Content-type: text/html');
        echo $conexion->verificarEstado(); 
    }
?>