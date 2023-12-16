<?php
    //require_once('controllers/validations/functionsController.php');
    function is_valid_email($str){
        $matches = null;
        return (1 === preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $str, $matches));
    }

    function is_valid_length($str){
        return (strlen($str)>7 && strlen($str)<17)? true : false;
    }

    function exist_email($str){
        require_once('models/accountModel.php');
        $show = new accountModel();
        $show = $show->getAccountWithEmail($str);
        if(count($show) > 0) return false;
        return true;
    }

    function exist_user_id($str){
        require_once('models/userModel.php');
        $show = new userModel();
        $show = $show->getUserWithId($str);
        if(count($show) > 0) return false;
        return true;
    }

    function exist_user_identification($str){
        require_once('../models/editUserModel.php');
        $show = new editUser();
        $show = $show->getUserWithIdentification($str);
        if(count($show) > 0) return false;
        return true;
    }

    function is_password_correct($str, $password){
        require_once('models/accountModel.php');
        $show = new accountModel();
        $show = $show->getAccountWithEmail($str);

        include_once 'models/account.php';
        foreach($show as $row){
            $dato = new Account();
            $dato = $row;
        }

        return (password_verify($password, $dato->password_account))? true  : false;
    }

    function validate_status(){
        if($_SESSION['status_id'] == 2) header('location: '.constant('URL').'viewusers/edit/'.$_SESSION['id_user']);
    }

    function validate_exist_directory($str){
        $directory = "../views/images/server/".$str;
        return (file_exists($directory))? true : false ;
    }

    function exist_directory($str){
        $directory = constant('URL')."views/images/server/".$str;
        if(!file_exists($directory)){
            if(!mkdir($directory, 0777, true)) return false;
        }
        return true;
    }

    function valid_exist_email($str){
        require_once('../models/editAccountModel.php');
        $show = new editAccount();
        $show = $show->getAccountWithEmail($str);
        if(count($show) > 0) return false;
        return true;
    }