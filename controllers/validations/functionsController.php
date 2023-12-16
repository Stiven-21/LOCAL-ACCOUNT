<?php
    //require_once('controllers/validations/validationsController.php');
    function crate_arrays_user($query){
        include_once 'models/user.php';
        $show = [];
        while($row = $query->fetch()){
            //echo var_dump($row);
            $data = new User();
            $data->id_user = $row['id_user'];
            $data->identification_user = $row['identification_user'];
            $data->photo_user = $row['photo_user'];
            $data->name_user = $row['name_user'];
            $data->last_name_user = $row['last_name_user'];
            $data->phone_user = $row['phone_user'];
            $data->account_id = $row['account_id'];
            $data->role_id = $row['role_id'];
            $data->last_update_user = $row['last_update_user'];
            $data->admin_of_user_id = $row['admin_of_user_id'];
            $data->status_id = $row['status_id'];
            
            array_push($show, $data);
        }
        return $show;
    }

    function create_array_account($query){
        include_once 'models/account.php';
        $show = [];
        while($row = $query->fetch()){
            //echo var_dump($row);
            $data = new Account();
            $data->id_account = $row['id_account'];
            $data->email_account = $row['email'];
            $data->password_account = $row['password'];
            $data->last_connection_account = $row['last_connection'];

            array_push($show, $data);
        }
        return $show;
    }

    function crate_arrays_user_chat($query){
        include_once 'models/user.php';
        $show = [];
        while($row = $query->fetch()){
            $data = new UserChat();
            $data->id_user = $row['id_user'];
            $data->photo_user = $row['photo_user'];
            $data->name_user = $row['username'];

            array_push($show, $data);
        }
        return $show;
    }

    function encrypt_message($str){
        for($i=0;$i<strlen($str);$i++){
            $str[$i]=chr(ord($str[$i])+3);
        }
        return $str;
    }
    
    function decrypt_message($str){
        for($i=0;$i<strlen($str);$i++){
            $str[$i]=chr(ord($str[$i])-3);
        }
        return $str;
    }

    function upload_data_session($str){
        require_once('../models/editUserModel.php');
        $show = new editUser();
        $show = $show->getUserWithIdentification($str);
        
        include_once '../models/user.php';
        foreach($show as $row){
            $user = new User();
            $user = $row;
        }

        $_SESSION['id_user'] = $user->id_user;
        $_SESSION['identification_user'] = $user->identification_user;
        $_SESSION['photo_user'] = $user->photo_user;
        $_SESSION['name_user'] = $user->name_user;
        $_SESSION['last_name_user'] = $user->last_name_user;
        $_SESSION['phone_user'] = $user->phone_user;
        $_SESSION['account_id'] = $user->account_id;
        $_SESSION['role_id'] = $user->role_id;
        $_SESSION['last_update_user'] = $user->last_update_user;
        $_SESSION['admin_of_user_id'] = $user->admin_of_user_id;
        $_SESSION['status_id'] = $user->status_id;
    }

    function get_users_whith_account_email($str){
        require_once 'models/accountModel.php';
        $show = new accountModel();
        $show = $show->getAccountWithEmail($str);

        include_once 'models/account.php';
        foreach($show as $row){
            $data = new Account();
            $data = $row;
        }

        require_once 'models/userModel.php';
        $show = new userModel();
        $show = $show->getUserWithIdAccount($data->id_account);

        include_once 'models/user.php';
        foreach($show as $row){
            $data = new User();
            $data = $row;
        }

        return $data;
    }

    function logLastConnection($email){
        require_once 'models/accountModel.php';
        $save = new accountModel;
        $save -> logLastConnection($email);
    }

    function get_id_account_of_user($str){
        require_once 'models/userModel.php';
        $user = new userModel();
        $user = $user->getUserWithIdAccount($str);

        include_once 'models/user.php';
        foreach($user as $data)
        //echo var_dump($user);
        return $data->account_id;
    }

    function month($str){
        switch($str){
            case '1':
                return 'January';
            case '2':
                return 'February';
            case '3':
                return 'March';
            case '4':
                return 'April';
            case '5':
                return 'May';
            case '6':
                return 'June';
            case '7':
                return 'July';
            case '8':
                return 'August';
            case '9':
                return 'September';
            case '10':
                return 'October';
            case '11':
                return 'November';
            case '12':
                return 'December';
        }
    }

    function date_view($str){
        $dataTime = explode(" ", $str);
        $data = explode("-", $dataTime[0]);
        return " ".month($data[1])." ".$data[2].", ".$data[0];
    }

    function data_time_message($str){
        $dataTime = explode(" ", $str);
        return date_view($str).' at '.extract_time($dataTime[1]);
    }

    function extract_time($str){
        $time = explode(":",$str);
        $hours = ($time[0] > 12)? $time[0] - 12 : $time[0];
        $format = ($time[0] > 12)? 'pm' : 'am';
        return $hours.':'.$time[1].' '.$format;
    }

    function create_directory($str){
        $directory = "../views/images/server/".$str;
        if(!mkdir($directory, 0777, true)) return false;
        return true;
    }

    function reename_directory($previois, $new){
        $previous_directory = "../views/images/server/".$previois;
        $new_directory = "../views/images/server/".$new;
        return rename($previous_directory, $new_directory);
    }

    function move_file_photo_user($route, $temp){
        return move_uploaded_file($temp, "../".$route);
    }

    function save_image_server($route, $temp, $last_id, $id){
        require_once('validationsController.php');
        if(validate_exist_directory($last_id)){
            if($last_id != $id){
                if(reename_directory($last_id, $id)){
                    return (move_file_photo_user($route, $temp))? true : false;
                }
            }else{ return (move_file_photo_user($route, $temp))? true : false; }
        }else{
            if(create_directory($id)){
                return (move_file_photo_user($route, $temp))? true : false;
            }
        }
        return false;
    }

    function directory_user_files($previois, $new){
        require_once('validationsController.php');
        if(validate_exist_directory($previois)){
            return (reename_directory($previois, $new))? true : false;
        }else{
            return (create_directory($new))? true : false;
        }
    }

    function width_and_heigth_image($temp){
        $dataFile = getimagesize($temp);
        $width = $dataFile[0];
        $heigth = $dataFile[1];
        if($width != $heigth){
            echo "Image dimensions ".$width."x".$heigth." are not allowed <br> Image ratio allowed 1:1";
            return false;
        }
        return true;
    }

    function modify_image_path($new, $route){
        if($route != "views/images/images/photo_user_default.png"){
            $dataRoute = explode("/", $route);
            return ($dataRoute[3] == $new)? $route : $dataRoute[0]."/".$dataRoute[1]."/".$dataRoute[2]."/".$new."/".$dataRoute[4];
        }else{ return $route; }
    }

    class startSession{
        public function __construct(){
            session_start();
        }

        public function redirectSignIn(){
            header('location: '.constant('URL').'signin/signin');
        }

        public function redirectIndex(){
            header('location: '.constant('URL').'index');
        }
    }