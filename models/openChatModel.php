<?php
    require_once("../libs/database.php");
    require_once("../config/config.php");

    class openChat{
        public function getMessagesForChat($myId, $otherID, $messages){
            try{
                $this->db = new Database();
                $this -> insertMessageRead($myId, $otherID);
                $query = $this -> db -> connect() -> query('SELECT A.id_message, B.transmitter_id, B.reciver_id, C.description, A.sent_id, A.received_id, A.read_id, A.data_time FROM cuentaslocales.messages A, cuentaslocales.message_users B, cuentaslocales.messages_description C WHERE (B.transmitter_id = "'.$myId.'" AND B.reciver_id = "'.$otherID.'" OR B.transmitter_id = "'.$otherID.'" AND B.reciver_id = "'.$myId.'") AND A.users_id = B.id_message AND C.id_description = A.description_id ORDER BY A.id_message DESC');
                $messages = $this -> crate_arrays_message($query, $messages);

                return $messages;
            }catch(PDOException $e){return [];}
        }

        public function insertMessageRead($myId, $otherId){
            try{
                $query = $this -> db -> connect() -> prepare('UPDATE cuentaslocales.messages SET read_id = "1" WHERE users_id = (SELECT id_message FROM cuentaslocales.message_users WHERE transmitter_id = :transmitter_id AND reciver_id = :reciver_id) AND read_id = "2"');
                $query -> execute(['transmitter_id' => $otherId, 'reciver_id' => $myId]);
            }catch(PDOException $e){}
        }

        function crate_arrays_message($query, $messages){
            include_once '../models/message.php';
            while($row = $query->fetch()){
                $data = new chatUser();
                $data->id_message = $row['id_message'];
                $data->transmitter_id = $row['transmitter_id'];
                $data->reciver_id = $row['reciver_id'];
                $data->description = $row['description'];
                $data->sent_id = $row['sent_id'];
                $data->received_id = $row['received_id'];
                $data->read_id = $row['read_id'];
                $data->data_time = $row['data_time'];

                array_push($messages, $data);
            }
            return $messages;
        }
    }