<?php
    class Conexion{
        
        private $conexion;

        public function __construct(){
            $this->conexion = new mysqli("localhost","root","","sca");
        }

        public function conectar(){
            return $this->conexion;
        }

        public function getUsers(){
            $consulta = "SELECT * FROM usuarios";
            $resultado = $this->conexion->query($consulta);
            $usuarios = array();
            while($row = $resultado->fetch_assoc()){
                array_push($usuarios, $row);
            }
            return $usuarios;
        }


    }
?>