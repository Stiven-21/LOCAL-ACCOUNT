<?php
    require_once('../controllers/validations/functionsController.php');
    require_once('../controllers/validations/validationsController.php');
    require_once('../models/countNewMessageModel.php');

    session_start();
    $myId = $_SESSION['id_user'];
    $count = new countMessage();
    $cant = $count->countMessageUser($myId);
    $show = '';
    if(intval($cant) > 0){
        $show = ($cant > 9)? '<span>9+</span>' : '<span>'.$cant.'</span>' ;
    }
    echo $show;
