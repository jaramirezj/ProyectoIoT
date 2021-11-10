<?php
    class Conexion{

        private $conexion;

        public function __construct(){
            $this->conexion = new mysqli("localhost","root","","sca");
        }

        public function getUsers(){
            $consulta = "SELECT * FROM usuario";
            $resultado = $this->conexion->query($consulta);
            $usuarios = array();
            while($row = $resultado->fetch_assoc()){
                array_push($usuarios, $row);
            }
            return $usuarios;
        }

        public function getAccessData(){
            $id = 1;
            $consulta = "SELECT * FROM parqueadero WHERE idparqueadero = $id";
            $resultado = $this->conexion->query($consulta);
            $datos = array();
            while($row = $resultado->fetch_assoc()){
                return $row;
            }
        }

        public function modificarMaximo($maximo){
            $parqueadero = 1;
            $actualizacion = "UPDATE parqueadero SET maximo='$maximo' WHERE idparqueadero = '$parqueadero'";
            $resultadoInsercion = $this->conexion->query($actualizacion);
            if($actualizacion){
                return true;
            }else{return false;}
        }

        public function modificarEstado($estado){
            $parqueadero = 1;
            $actualizacion = "UPDATE parqueadero SET estado='$estado' WHERE idparqueadero = '$parqueadero'";
            $resultadoInsercion = $this->conexion->query($actualizacion);
            if($actualizacion){
                return true;
            }else{return false;}
        }

        public function crearUsuario($id, $idtarjeta,$contrasena,$nombres){
            $estado = 0;
            $idparqueadero = 1;
            $consulta = "INSERT INTO usuario (idusuario, idrfid, contrasena, nombre_apellidos, estado_actual,parqueadero_idparqueadero) 
                        VALUES('$id','$idtarjeta','$contrasena','$nombres','$estado','$idparqueadero')";
             $resultado = $this->conexion->query($consulta);
             if($resultado){
                 return true;
             }else{return false;}

        }

        public function eliminarUsuario($idUsuario){
            $consulta = "DELETE FROM usuario WHERE idusuario = '$idUsuario'";
            $resultado = $this->conexion->query($consulta);
             if($resultado){
                 return true;
             }else{return false;}
        }

        public function verificarCredenciales($idTarjeta,$pass){
            $consulta = "SELECT * FROM usuario WHERE idrfid = '$idTarjeta'";
            $resultado = $this->conexion->query($consulta);
            if($resultado){
                while($row = $resultado->fetch_assoc()){ 
                    if($row['contrasena']==$pass){
                        return "correct";
                    }else if($row['contrasena']!=$pass){
                        return "wrong_pass";
                    }
                }
            }
            return "wrong_card";
        }

    }

?>