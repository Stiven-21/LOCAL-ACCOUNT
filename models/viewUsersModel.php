<?php
    require_once('models/userModel.php');

    class viewusersModel extends Model{
        public function __construct(){
            parent::__construct();
        }

        public function all(){
            $show = new userModel();
            return $show->getAllUsers();
        }

        public function editUser($id){
            $show = new userModel();
            return $show->getUserWithId($id);
        }

        public function editAccount($id){
            include 'models/accountModel.php';
            $show = new accountModel();
            return $show->getAccountWithId($id);
        }

        public function menssages($myId){
            $show = new userModel;
            return $show->getUserChats($myId);
        }
    }