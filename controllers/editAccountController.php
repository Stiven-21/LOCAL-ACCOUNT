<?php
    require_once('../controllers/validations/functionsController.php');
    require_once('../controllers/validations/validationsController.php');
    require_once('../models/editAccountModel.php');

    session_start();
    $save = false;
    $url_id = $_SESSION['id_url'];

    $id = $_SESSION['temp_account'];
    $email = ($_POST['email'])? $_POST['email'] : $_SESSION['email_temp'];
    $password = ($_POST['password'])? $_POST['password'] : '';

    if(is_valid_email($email)){
        if($email != $_SESSION['email_temp']){
            if(!valid_exist_email($email)){ 
                echo $email.' This email is already in use';
                return;
            }else{$save = true;}
        }
        if($password != ''){
            $save = false;
            if(is_valid_length($password)){
                $password = password_hash($_POST['password'],PASSWORD_ARGON2ID);
                $save = true;
            }else{  
                echo 'Password must contain between eight and sixteen characters';
                return;
            }
        }
    }else{ echo $email.' Is not a valid email'; }

    if($save == true){
        echo (save_data_account($email, $password, $id))? "true" : "An error occurred while saving account information";
        if($url_id == $_SESSION['id_user']){ $_SESSION['email'] = $email; }
    }
    