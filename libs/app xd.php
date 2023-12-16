<?php
    require_once('controllers/errorController.php');

    class App{
        function __construct(){
            if(isset($_GET['url'])){
                $url = $_GET['url'];
                $url = rtrim($url, '/');
                $url = explode('/', $url);
            }else{ $url[0] = 'index'; }
            //return false; --> PARA FINALIZAR

            $routeController = 'controllers/'.$url[0].'Controller.php';
            if(file_exists($routeController)){
                require_once($routeController);
                $controller = new $url[0];
                if(isset($controller)){
                    if($url[0] == 'index'){
                        if(isset($url[1])){ $controller = new Failed();
                        }else{ //$controller->loadModel($url[0]); 
                        }
                    }else{
                        $controller->loadModel($url[0]);
                        $controller->{$url[1]}();
                        //FUNCIONAL SI HAY: NO HAY
                        /*if(!empty($url[1])){
                            $controller->loadModel($url[0]);
                            $controller->{$url[1]}();
                        }else {
                            $controller = new Failed();
                        }*/
                    }
                }
            }else{
                $controller = new Failed();
            }
        }
    }
?>