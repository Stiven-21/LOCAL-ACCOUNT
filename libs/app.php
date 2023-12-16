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

            /*if(!empty($url[3])){//EN ALGUNAS URL ES HAS 2 EN OTRAS HASTA 3 EN INDEX ES HASTA 1
                $controller = new Failed();
                die;
            }*/

            $routeController = 'controllers/'.$url[0].'Controller.php';
            if(file_exists($routeController)){
                require_once($routeController);
                if($url[0] == 'index'){
                    if(empty($url[1])){
                        $controller = new $url[0];
                        if(!isset($controller)){$controller = new Failed();
                        }else{$controller->render();}
                    }else{ $controller = new Failed(); }
                }else{
                    if(!empty($url[1])){
                        $controller = new $url[0];
                        if(isset($controller)){
                            $controller->loadModel($url[0]);
                            //FALTA VALIDAR QUE LA FUNCION EXISTA
                            if(!empty($url[2])){$controller->{$url[1]}($url[2]);
                            }else{$controller->{$url[1]}();}
                        }else{ $controller = new Failed();}
                    }else { $controller = new Failed(); }
                }
            }else{ $controller = new Failed(); }
        }
    }
?>