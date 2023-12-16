<?php
    require_once("../libs/database.php");
    require_once("../config/config.php");

    function save_data_send_message($message, $chatOtherId, $chatMyId){
        $model = new sendMessage();
        $show = $model -> getCantMessageUsers($chatMyId, $chatOtherId);
        if($show != -1){
            if($show == 0) $model -> insertMessageUsers($chatMyId, $chatOtherId);
            $idMessageUsers = $model -> getIdMessageUsers($chatMyId, $chatOtherId);
            if($model -> insertDescriptionMessage($message)){
                $idDescriptionMessage = $model -> getIdDescriptionMessage($message);
                if($model -> insertMessageChat($idMessageUsers, $idDescriptionMessage)) return true;
            }
            return false;            
        }else{return false;}
    }

    class sendMessage{
        public function getCantMessageUsers($chatMyId, $chatOtherId){
            try{
                $this->db = new Database();
                $query = $this -> db -> connect() -> query('SELECT COUNT(id_message) AS cant FROM cuentaslocales.message_users WHERE transmitter_id = "'.$chatMyId.'" AND reciver_id = "'.$chatOtherId.'"');
                $show = $query -> fetch();
                return $show['cant'];
            }catch(PDOException $e){
                return -1;
            }
        }

        public function insertMessageUsers($chatMyId, $chatOtherId){
            try{
                $this->db = new Database();
                $query = $this -> db -> connect() -> prepare('INSERT INTO cuentaslocales.message_users(transmitter_id, reciver_id) VALUES(:transmitter_id, :reciver_id);');
                $query -> execute(['transmitter_id' => $chatMyId, 'reciver_id' => $chatOtherId]);
                return true;
            }catch(PDOException $e){
                $e -> getMessage();
                return false;
            }
        }

        public function getIdMessageUsers($chatMyId, $chatOtherId){
            try{
                $this->db = new Database();
                $query = $this -> db -> connect() -> query('SELECT id_message FROM cuentaslocales.message_users WHERE transmitter_id = "'.$chatMyId.'" AND reciver_id = "'.$chatOtherId.'"');
                $show = $query -> fetch();
                return $show['id_message'];
            }catch(PDOException $e){
                return -1;
            }
        }

        public function insertDescriptionMessage($message){
            try{
                $this->db = new Database();
                $query = $this -> db -> connect() -> prepare('INSERT INTO cuentaslocales.messages_description(description) VALUES(:description);');
                $query -> execute(['description' => $message]);
                return true;
            }catch(PDOException $e){
                $e -> getMessage();
                return false;
            }
        }

        public function getIdDescriptionMessage($message){
            try{
                $this->db = new Database();
                $query = $this -> db -> connect() -> query('SELECT id_description FROM cuentaslocales.messages_description WHERE description = "'.$message.'" ORDER BY id_description DESC LIMIT 1');
                $show = $query -> fetch();
                return $show['id_description'];
            }catch(PDOException $e){
                return -1;
            }
        }

        public function insertMessageChat($idMessageUsers, $idDescriptionMessage){
            try{
                $query = $this -> db -> connect() -> prepare('INSERT INTO cuentaslocales.messages(users_id, sent_id, received_id, description_id, read_id) VALUES(:users_id, 1, 2, :description_id, 2);');
                $query -> execute(['users_id' => $idMessageUsers, 'description_id' => $idDescriptionMessage]);
                return true;
            }catch(PDOException $e){
                $e -> getMessage();
                return false;
            }
        }
    }