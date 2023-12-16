<?php
    require_once("../libs/database.php");
    require_once("../config/config.php");

    class countMessage{
        function countMessageUser($myId){
            try{
                $this->db = new Database();
                $query = $this -> db -> connect() -> query('SELECT COUNT(A.id_message) AS message FROM cuentaslocales.messages A, cuentaslocales.message_users B WHERE A.read_id = "2" AND A.users_id = B.id_message AND B.reciver_id = "'.$myId.'"');
                while($row = $query->fetch()){
                    $cant = $row['message'];
                }
                return $cant;
            }catch(PDOException $e){ return []; }
        }
    }