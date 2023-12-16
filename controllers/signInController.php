<?php
    $icss = new startSession();
    if(!empty($_SESSION['email']) && !empty($_SESSION['token'])){
        $icss -> redirectIndex(); 
    }

    class SignIn extends Controller{
        function __construct(){
            parent::__construct();
            $this -> view -> message = '';
            $this -> view -> email = '';
        }
        
        function render(){
            $this -> view -> render('templates/user/signIn');
        }

        function signin(){
            $email = (!empty($_POST['email']))? $_POST['email'] : "";
            $password = (!empty($_POST['password']))? $_POST['password'] : "";
            
            if(!empty($_POST)){
                if($email != ''){
                    if(is_valid_email($email)){
                        if(!exist_email($email)){
                            if(is_password_correct($email, $password)){

                                $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                $_SESSION['email'] = $email;
                                $_SESSION['token'] = substr(str_shuffle($chars), 0, 50);

                                $user = get_users_whith_account_email($email);
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

                                logLastConnection($email);

                                header('location: '.constant('URL').'index');
                            }else{ $this -> view -> message = "Password is incorrect"; }
                        }else{ $this -> view -> message = "This email has not been registered"; }
                    }else{ $this -> view -> message = "This email is invalid"; }
                }else{ $this -> view -> message = "You must enter an email";}
            }

            $this -> view -> email = $email;
            $this->render();

        }
    }