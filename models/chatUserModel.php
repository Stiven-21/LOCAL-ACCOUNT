<?php
    require_once("../libs/database.php");
    require_once("../config/config.php");

    function get_users_chats($search, $myId, $role){
        $model = new chatUser();
        switch($role){
            case '1':
                return $model -> getUsersChatsSuperAdmin($myId, $search);
                break;
            case '2':
                return $model -> getUsersChatsAdmin($myId, $search);
                break;
            case '3':
                return $model -> getUsersChatsUser($myId, $search);
                break;
            default:
                return [];
                break;
        }
    }

    class chatUser{
        public function getUsersChatsSuperAdmin($myId, $search){
            try{
                $this->db = new Database();
                $show = [];
                
                $query = $this -> db -> connect() -> query('SELECT * FROM cuentaslocales.users WHERE (identification_user LIKE "%'.$search.'%" OR name_user  LIKE "%'.$search.'%" OR last_name_user  LIKE "%'.$search.'%") AND status_id = "1" ORDER BY id_user DESC');
                $show = $this -> crate_arrays_user($query, $show, $myId);

                return $show;
            }catch(PDOException $e){return [];}
        }

        public function getUsersChatsAdmin($myId, $search){
            try{
                $this->db = new Database();
                $show = [];
                
                $query = $this -> db -> connect() -> query('SELECT * FROM cuentaslocales.users WHERE (identification_user LIKE "%'.$search.'%" OR name_user  LIKE "%'.$search.'%" OR last_name_user  LIKE "%'.$search.'%") AND role_id = "1"');
                $show = $this -> crate_arrays_user($query, $show, $myId);
                $query = $this -> db -> connect() -> query('SELECT * FROM cuentaslocales.users WHERE (identification_user LIKE "%'.$search.'%" OR name_user  LIKE "%'.$search.'%" OR last_name_user  LIKE "%'.$search.'%") AND admin_of_user_id = "'.$myId.'" ORDER BY id_user DESC');
                $show = $this -> crate_arrays_user($query, $show, $myId);
                
                return $show;
            }catch(PDOException $e){return [];}
        }

        public function getUsersChatsUser($myId, $search){
            try{
                $this->db = new Database();
                $show = [];

                $query = $this -> db -> connect() -> query('SELECT * FROM cuentaslocales.users WHERE (identification_user LIKE "%'.$search.'%" OR name_user  LIKE "%'.$search.'%" OR last_name_user  LIKE "%'.$search.'%") AND role_id = "1"');
                $show = $this -> crate_arrays_user($query, $show, $myId);
                $query = $this -> db -> connect() -> query('SELECT * FROM cuentaslocales.users WHERE (identification_user LIKE "%'.$search.'%" OR name_user  LIKE "%'.$search.'%" OR last_name_user  LIKE "%'.$search.'%") AND id_user = (SELECT admin_of_user_id FROM cuentaslocales.users WHERE id_user = "'.$myId.'")');
                $show = $this -> crate_arrays_user($query, $show, $myId);
                $query = $this -> db -> connect() -> query('SELECT * FROM cuentaslocales.users WHERE (identification_user LIKE "%'.$search.'%" OR name_user  LIKE "%'.$search.'%" OR last_name_user  LIKE "%'.$search.'%") AND admin_of_user_id = (SELECT admin_of_user_id FROM cuentaslocales.users WHERE id_user = "'.$myId.'") ORDER BY id_user DESC');
                $show = $this -> crate_arrays_user($query, $show, $myId);
                
                return $show;
            }catch(PDOException $e){return [];}
        }



        function crate_arrays_user($query, $show, $myId){
            include_once '../models/user.php';
            while($row = $query->fetch()){
                $data = new User();
                if($row['id_user'] != $myId){
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
            }
            return $show;
        }
    }