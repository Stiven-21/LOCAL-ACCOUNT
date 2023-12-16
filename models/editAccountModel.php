<?php
    require_once("../libs/database.php");
    require_once("../config/config.php");

    function save_data_account($email, $password, $id){
        $model = new editAccount();
        if($password){ return $model -> editDataAccount($email, $password, $id);
        }else{ return $model -> editEmailAccount($email, $id);}
    }

    class editAccount{

        public function editDataAccount($email, $password, $id){
            try{
                $this->db = new Database();
                $query = $this -> db -> connect() -> prepare('UPDATE cuentaslocales.accounts SET email = :email, password = :password WHERE id_account = :id_account');
                $query -> execute(['email' => $email, 'password' => $password, 'id_account' => $id]);
                return true;
            }catch(PDOException $e){
                $e -> getMessage();
                return false;
            }
        }

        public function editEmailAccount($email, $id){
            try{
                $this->db = new Database();
                $query = $this -> db -> connect() -> prepare('UPDATE cuentaslocales.accounts SET email = :email WHERE id_account = :id_account');
                $query -> execute(['email' => $email, 'id_account' => $id]);
                return true;
            }catch(PDOException $e){
                $e -> getMessage();
                return false;
            }
        }

        public function getAccountWithEmail($email){
            try{
                $this->db = new Database();
                $query = $this -> db -> connect() -> query('SELECT * FROM cuentaslocales.accounts WHERE email = "'.$email.'"');
                include_once '../models/account.php';
                $show = [];
                while($row = $query->fetch()){
                    $data = new Account();
                    $data->id_account = $row['id_account'];
                    $data->email_account = $row['email'];
                    $data->password_account = $row['password'];
                    $data->last_connection_account = $row['last_connection'];
                
                    array_push($show, $data);
                }
                return $show;
            }catch(PDOException $e){
                return [];
            }
        }
    }
