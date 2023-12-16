<?php
    require_once('models/accountModel.php');

    class registerModel extends Model{
        public function __construct(){
            parent::__construct();
        }
        
        public function insertAccount($datos){
            try{
                $query = $this -> db -> connect() -> prepare('INSERT INTO cuentaslocales.accounts(email, password) VALUES(:email, :password);');
                $query -> execute(['email' => $datos['email'], 'password' => $datos['password']]);
                
                $show = new accountModel();
                $show = $show->getAccountWithEmail($datos['email']);
                include_once 'models/account.php';
                foreach($show as $row){
                    $dato = new Account();
                    $dato = $row;
                }

                if($this->insertUser($datos, $dato->id_account)) return true;
                return false;
            }catch(PDOException $e){
                $e -> getMessage();
                return false;
            }
        }

        public function insertUser($datos, $account_id){
            try{
                $query = $this -> db -> connect() -> prepare('INSERT INTO cuentaslocales.users(account_id, role_id, admin_of_user_id) VALUES(:account_id, :role, :add);');
                $query -> execute(['account_id' => $account_id,'role' => $datos['role'], 'add' => $datos['add']]);
                return true;
            }catch(PDOException $e){
                $e -> getMessage();
                return false;
            }
        }
    }
