<?php
    require_once('../controllers/validations/functionsController.php');
    require_once('../controllers/validations/validationsController.php');
    require_once('../models/sendMessageModel.php');

    session_start();

    if($_SESSION['__openChat__']){
        if($_POST['chatOtherId']){
            if($_POST['chatOtherId'] == $_SESSION['__chatOtherId__']){
                if($_POST['message'] && $_POST['message'] != ''){
                    $chatMyId = $_SESSION['__chatMyId__'];
                    $chatOtherId = $_SESSION['__chatOtherId__'];
                    $message = encrypt_message($_POST['message']);
                    echo save_data_send_message($message, $chatOtherId, $chatMyId);
                }else{echo 0;}
            }else{echo 0;}
        }else{echo 0;}
    }else{echo 0;}
    

    //$openChat = $_SESSION['__openChat__'];
    //$myId = $_SESSION['__chatMyId'];
