<?php
    $icss = new startSession();
    if(empty($_SESSION['email']) && empty($_SESSION['token'])){
        $icss -> redirectSignIn(); 
    }
    
    class index extends Controller{
        function __construct(){
            parent::__construct();
        }

        function render(){
            validate_status();
            $this -> view -> render('index');
        }
    }