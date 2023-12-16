<?php
    include_once 'models/account.php';

    class accountModel extends Model{
        public function __construct(){
            parent::__construct();
        }
        
        public function getAccountWithEmail($email){
            try{
                $query = $this -> db -> connect() -> query('SELECT * FROM cuentaslocales.accounts WHERE email = "'.$email.'"');
                return create_array_account($query);
            }catch(PDOException $e){
                return [];
            }
        }

        public function getAccountWithId($id){
            $datos = [];
            try{
                $query = $this -> db -> connect() -> query('SELECT * FROM cuentaslocales.accounts WHERE id_account = "'.$id.'"');
                return create_array_account($query);
            }catch(PDOException $e){
                return [];
            }
        }

        public function logLastConnection($email){
            try{
                $query = $this -> db -> connect() -> prepare('UPDATE cuentaslocales.accounts SET last_connection = current_timestamp WHERE email = :email');
                $query -> execute(['email' => $email]);
                return true;
            }catch(PDOException $e){ 
                return false;
            }
        }
    }
?>