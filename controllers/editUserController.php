<?php
    require_once('../controllers/validations/functionsController.php');
    require_once('../controllers/validations/validationsController.php');
    require_once('../models/editUserModel.php');

    session_start();
    $save = false;
    $url_id = $_SESSION['id_url'];

    $id = $_SESSION['temp_user'];
    $name = ($_POST['name'])? $_POST['name'] : $_SESSION['name_temp'];
    $last_name = ($_POST['last_name'])? $_POST['last_name'] : $_SESSION['lastname_temp'];
    $identification = ($_POST['identification'])? $_POST['identification'] : $_SESSION['id_temp'];
    $phone_number = ($_POST['phone_number'])? $_POST['phone_number'] : $_SESSION['phone_temp'];

    if(ctype_digit($identification)){
        if(strlen($identification) > 8){
            if($identification != $_SESSION['id_temp']){
                if(!exist_user_identification($identification)){
                    echo 'The identification number is already in use';
                    return;
                }
            }
            
            if(ctype_digit($phone_number)){
                if(isset($_FILES['photo'])){
                    $type = explode("/",$_FILES['photo']['type']);
                    if($type[0] == 'image'){
                        $size = $_FILES['photo']['size'];
                        $temp = $_FILES['photo']['tmp_name'];
                        if(width_and_heigth_image($temp) && $size <= 2700000){
                            $route = 'views/images/server/'.$identification.'/photo_user.'.$type[1];
                            if(!save_image_server($route, $temp, $_SESSION['id_temp'], $identification)){
                                echo "An error occurred while uploading the file";
                            }else{ $save = true; }
                        }
                    }else{echo "The selected file is not of type image";}
                }else{ 
                    $route = modify_image_path($identification, $_SESSION['photo_temp']);
                    if(!directory_user_files($_SESSION['id_temp'], $identification)){
                        echo "An error occurred while creating the user directory";
                    }else{ $save = true; }
                }
            }else{ echo 'The phone number field can only contain numbers'; }
        }else{ echo 'Identification must contain at least 9 digits'; }
    }else{ echo 'The identification field can only contain numbers'; }

    if($save == true){
        $model = new editUser();
        echo ($model -> editDataUser($identification, $route, $name, $last_name, $phone_number, $id))? "true" : "An error occurred while saving user information";
        if($url_id == $_SESSION['id_user']){upload_data_session($identification);}
    }