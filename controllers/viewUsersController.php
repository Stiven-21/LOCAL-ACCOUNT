<?php
    $icss = new startSession();
    if(empty($_SESSION['email']) && empty($_SESSION['token'])){
        $icss -> redirectSignIn(); 
    }

    class viewUsers extends Controller{
        function __construct(){
            parent::__construct();
            //$this -> view -> allUsers = [];
        }
        
        function all(){
            validate_status();
            if($_SESSION['role_id'] != '1' && $_SESSION['role_id'] != '2') header('location: '.constant('URL').'viewusers/profile');
            $this -> view -> allUsers = $this -> model -> all();
            $this -> view -> render('templates/user/all');
        }
        
        public function edit($id){
            //require ('controllers/validations/functionsController.php');
            $this -> view -> id_url = $id;
            $this -> view -> dataUser = $this -> model -> editUser($id);
            $this -> view -> dataAccount = $this -> model -> editAccount(get_id_account_of_user($id));
            //echo var_dump(editUser($id));
            $this -> view -> render('templates/user/edit');
        }

        public function register(){
            if($_SESSION['role_id'] != '1' && $_SESSION['role_id'] != '2') header('location: '.constant('URL').'viewusers/profile');
            $show = new userModel();

            $this -> view -> message = '';
            $failed = true;
            $save = false;
            $email = (!empty($_POST['email']))? $_POST['email'] : '';
            $password = (!empty($_POST['password']))? $_POST['password'] : "";
            $role = (!empty($_POST['role']))? $_POST['role'] : "Select user role";
            $add = 'Select the administrator';
            
            if(!empty($_POST)){
                if($email != ''){
                    if(is_valid_email($email)){
                        if(exist_email($email)){
                            if(is_valid_length($password)){
                                $password = password_hash($_POST['password'],PASSWORD_ARGON2ID);
                                $save = true;
                            }else{ $this -> view -> message = "Password must contain between eight and sixteen characters"; }
                        }else{ $this -> view -> message = "This email is already registered"; }
                    }else{ $this -> view -> message = "This email is invalid"; }
                }else{ $this -> view -> message = "You must enter an email";}

                if($_SESSION['role_id'] == '1'){
                    $save = false;

                    if($role == '2' || $role == '3'){
                        if($role == '3'){
                            $add = $_POST['add'];
                            if($add != 'Select the administrator'){
                                if(!exist_user_id($add)){
                                    $save = true;
                                }else{$save = false; $this -> view -> message = "The selected administrator does not exist";}
                            }else{ $save = false; $this -> view -> message = "You must select a administrator for the user"; }
                        }else{ $save=true; $add='0';}

                    }else{ $this -> view -> message = "You must select a role for the user"; }

                }else{
                    $role = '3';
                    $add = $_SESSION['id_user'];
                    $save = true;
                }

                if($save==true){
                    require 'models/registerModel.php';
                    $saveAccount = new registerModel;
                    if($saveAccount -> insertAccount(['email' => $email, 'password' => $password, 'role' => $role, 'add' => $add])){
                        $failed = false;
                        $email = '';
                        $save == false;
                        if($_SESSION['role_id'] == '1'){
                            $role = 'Select user role';
                            $add = 'Select the administrator';
                        }
                        $this -> view -> message = "Account created successfully";

                    }else{ $this -> view -> message = "Failed creating account"; }
                }else{ $this -> view -> message = "save no"; }
            }

            $this -> view -> role = $role;
            $this -> view -> add = $add;
            $this -> view -> admins = $show -> getUserAdmins();
            $this -> view -> failed = $failed;
            $this -> view -> email = $email;
            $this -> view -> render('templates/user/register');
        }

        public function delete($id){
            if($_SESSION['role_id'] != '1' && $_SESSION['role_id'] != '2') header('location: '.constant('URL').'viewusers/profile');
            //EL ROL ( SOLO PUEDEN ELINAR LOS ADMINS Y EL SUPER ADMIN) && SI UN ADMIN ELIMINA, VALIDAR QUE EL USUARIO SEA DE ESE ADMIN
            //SI UN SUPER ADMIN VA A ELIMINAR UN ADMIN, VALIDAR QUE ESE ADMIN NO TENGA USUARIOS REGISTRADOS
            //$this -> view -> allUsers = $this -> model -> edit();
            echo "ELIMINAR CONTROLLER ".$id;
        }

        public function menssages(){
            validate_status();
            $this -> view -> dataChats = $this -> model -> menssages($_SESSION['id_user']);
            $this -> view -> render('templates/menssages/menssages');
        }
        
        public function profile(){
            validate_status();
            $this -> view -> render('templates/user/profile');
        }

        function logout(){
            session_destroy();
            header('location: '.constant('URL').'signin/signin');
        }
    }