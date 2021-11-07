<?php
    require_once dirname( __DIR__ ) .'\model\Conexion.php';
    function main(){
        $conexion = new Conexion();
        if(isset($_GET['action'])){
            switch($_GET['action']){
                case 'users':
                    $data = $conexion->getUsers();
                    require dirname( __DIR__ ) . '/view/gestionUsuarios.php';
                    break;
                case 'state':
                    if($conexion->modificarEstado($_GET['s'])){
                        $data = $conexion->getAccessData();
                        require dirname( __DIR__ ) . '/view/index.php';
                    }
                    break;
                case 'max':
                    if($conexion->modificarMaximo($_POST['maximo'])){
                        $data = $conexion->getAccessData();
                        require dirname( __DIR__ ) . '/view/index.php';
                    }
                    break;
            }
        }else if(isset($_GET['user'])){
            switch($_GET['user']){
                case 'create_screen':
                    require dirname( __DIR__ ) . '/view/form_crear.php';
                    break;
                case 'create':
                    if($conexion->crearUsuario($_POST['id'], $_POST['idtarjeta'], $_POST['pass'], $_POST['nombres'])){
                        $data = $conexion->getUsers();
                        require dirname( __DIR__ ) . '/view/gestionUsuarios.php';
                    }
                    break;
                case 'delete':
                    if($conexion->eliminarUsuario($_GET['id'])){
                        $data = $conexion->getUsers();
                        require dirname( __DIR__ ) . '/view/gestionUsuarios.php';
                    }
                    break;
            }
        }else{
            $data = $conexion->getAccessData();
            require dirname( __DIR__ ) . '/view/index.php';
        }
    }
    main();
?>