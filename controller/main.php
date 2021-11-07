<?php
    function main(){
        if(isset($_GET['action'])){
            switch($_GET['action']){
                case 'start':
                    require dirname( __DIR__ ) . '/view/index.php';
                    break;
                case 'users':
                    require dirname( __DIR__ ) . '/view/gestionUsuarios.php';
                    break;
                case 'state':
                    break;
                case 'max':
                    break;
            }
        }else if(isset($_GET['user'])){
            switch($_GET['user']){
                case 'create':
                    require dirname( __DIR__ ) . '/view/index.php';
                    break;
                case 'delete':
                    require dirname( __DIR__ ) . '/view/gestionUsuarios.php';
                    break;
                case 'update':
                    break;
            }
        }
    }
    main();
?>