<?php
    class userModel extends Model{
        public function __construct(){
            parent::__construct();
        }
        
        public function getUserWithId($id_user){
            try{
                $query = $this -> db -> connect() -> query('SELECT * FROM cuentaslocales.users WHERE id_user = "'.$id_user.'"');
                return crate_arrays_user($query);
            }catch(PDOException $e){ return []; }
        }

        public function getUserAdmins(){
            try{
                $query = $this -> db -> connect() -> query('SELECT * FROM cuentaslocales.users WHERE status_id = "1" AND(role_id = "2" OR role_id = "1")' );
                return crate_arrays_user($query);
            }catch(PDOException $e){ return []; }
        }

        public function getAllUsers(){
            try{
                $query = $this -> db -> connect() -> query('SELECT * FROM cuentaslocales.users WHERE role_id != "1" ORDER BY id_user DESC' );
                return crate_arrays_user($query);
            }catch(PDOException $e){ return []; }
        }

        public function getUserWithIdAccount($idAccount){
            try{
                $query = $this -> db -> connect() -> query('SELECT * FROM cuentaslocales.users WHERE account_id = "'.$idAccount.'"');
                return crate_arrays_user($query);
            }catch(PDOException $e){ return []; }
        }

        public function getUserChats($myId){
            try{
                $query = $this -> db -> connect() -> query('SELECT DISTINCT B.id_user , B.photo_user, CONCAT(B.name_user," ",B.last_name_user) AS username FROM cuentaslocales.message_users A, cuentaslocales.users B WHERE (A.transmitter_id = "'.$myId.'" AND A.reciver_id = B.id_user OR A.transmitter_id = B.id_user AND A.reciver_id = "'.$myId.'") AND B.id_user != "'.$myId.'"');
                return crate_arrays_user_chat($query);
            }catch(PDOException $e){ return []; }
        }
    }
?>