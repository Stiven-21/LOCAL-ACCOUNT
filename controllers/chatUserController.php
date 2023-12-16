<?php
    require_once('../controllers/validations/functionsController.php');
    require_once('../controllers/validations/validationsController.php');
    require_once('../models/chatUserModel.php');
    
    session_start();
    $myId = $_SESSION['id_user'];
    $role = $_SESSION['role_id'];
    $search = ($_POST['search'])? $_POST['search'] : '';
    $data = get_users_chats($search, $myId, $role);
    
    if(count($data) > 0){
        $show = '';
        include_once '../models/user.php';
        foreach($data as $row){
            $user = new User();
            $user = $row;
            $show = $show.'<div class="modal-target-user" id="'.$user->id_user.'" data-bs-dismiss="modal">'.
                            '<div class="modal-img-user"><img src="'.constant("URL").$user->photo_user.'" alt=""></div>'.
                            '<div class="modal-data-user">'.$user->name_user.' '.$user->last_name_user.'</div>'.
                        '</div>';
        }
    }else{
        $show = '<div class="modal-target-user" id="-1" >'.
            '<div class="text-modal-not-user">No user has been found with the data entered</div>'.
        '</div>';
    }
    
    echo $show;