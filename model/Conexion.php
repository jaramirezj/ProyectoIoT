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

        public function verificarParqueadero(){
            $consultaParqueo = "SELECT * FROM parqueadero WHERE idparqueadero = 1";
            $resultado = $this->conexion->query($consultaParqueo);
            if($resultado){
                while($row = $resultado->fetch_assoc()){ 
                    if($row['estado']==1 && ($row['actual'] < $row['maximo'])){
                        return true;
                    }else if($row['estado']==3){
                        return true;
                    }else if($row['estado']==2){return false;}
                }
            }
        }

        public function cambiarActual($cambio){
            $actualizacion = "";
            if($cambio == "+1"){
                $actualizacion = "UPDATE parqueadero SET actual=(SELECT actual+1 FROM parqueadero WHERE idparqueadero = 1)
                 WHERE idparqueadero = 1";
            }else if($cambio == "-1"){
                $actualizacion = "UPDATE parqueadero SET actual=(SELECT actual-1 FROM parqueadero WHERE idparqueadero = 1) 
                WHERE idparqueadero = 1";
            }
            $resultadoInsercion = $this->conexion->query($actualizacion);
            if($actualizacion){
                return true;
            }else{return false;}
        }

        public function verificarCredenciales($idTarjeta,$pass){
            $consulta = "SELECT * FROM usuario WHERE idrfid = '$idTarjeta'";
            $resultado = $this->conexion->query($consulta);
            if($resultado){
                while($row = $resultado->fetch_assoc()){ 
                    $estado = $this->verificarParqueadero();
                    if($row['contrasena']==$pass && $row['estado_actual']==0 && $estado){
                        $this->cambiarActual("+1");
                        return "correct";
                    }else if($row['estado_actual']==2){
                        return "denied";
                    }else if(!$estado){
                        return "full";
                    }else if($row['contrasena']!=$pass){
                        return "wrong_pass";
                    }
                }
            }
            return "wrong_card";
        }

        public function verificarEstado(){
            $consultaParqueo = "SELECT * FROM parqueadero WHERE idparqueadero = 1";
            $resultado = $this->conexion->query($consultaParqueo);
            if($resultado){
                while($row = $resultado->fetch_assoc()){ 
                    return $row['estado'];
                }
            }
        }

        public function cambiarEstado($estado,$idusuario){
            $actualizacion = "UPDATE usuario SET estado_actual='$estado' WHERE idusuario = '$idusuario'";
            $resultadoInsercion = $this->conexion->query($actualizacion);
            if($actualizacion){
                return true;
            }else{return false;}
        }



    }

?>