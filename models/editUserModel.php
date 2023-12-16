<?php
    require_once("../libs/database.php");
    require_once("../config/config.php");

    class editUser{

        public function editDataUser($identification, $route, $name_user, $last_name, $phone, $id){
            try{
                $this->db = new Database();
                $query = $this -> db -> connect() -> prepare('UPDATE cuentaslocales.users SET identification_user = :identification, photo_user = :route, name_user = :name_user, last_name_user = :last_name, phone_user = :phone, status_id = "1", last_update_user = CURRENT_TIMESTAMP WHERE id_user = :id');
                $query -> execute(['identification' => $identification, 'route' => $route, 'name_user' => $name_user, 'last_name' => $last_name, 'phone' => $phone, 'id' => $id]);
                return true;
            }catch(PDOException $e){
                $e -> getMessage();
                return false;
            }
        }

        public function getUserWithIdentification($identification_user){
            try{
                $this->db = new Database();
                $query = $this -> db -> connect() -> query('SELECT * FROM cuentaslocales.users WHERE identification_user = "'.$identification_user.'"');
                
                include_once '../models/user.php';
                $show = [];
                while($row = $query->fetch()){
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
            }catch(PDOException $e){ return []; }
        }
    }
