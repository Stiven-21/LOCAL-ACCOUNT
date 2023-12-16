<?php
    require_once('../controllers/validations/functionsController.php');
    require_once('../controllers/validations/validationsController.php');
    require_once('../models/openChatModel.php');

    session_start();
    $myId = $_SESSION['id_user'];
    if($_POST['otherID']){
        $otherID = $_POST['otherID'];
        $messages = [];
        $model = new openChat();
        $data = $model -> getMessagesForChat($myId, $otherID, $messages);

        $_SESSION['__openChat__'] = true;
        $_SESSION['__chatMyId__'] = $myId;
        $_SESSION['__chatOtherId__'] = $otherID;

        $info = '<div class="chat-info"><span>'.
                    '<i class="fa-solid fa-lock"></i>'.
                    'Your messages are encrypted for greater security, no user outside of this chat can read or modify them'.
                '</span></div>';
        if(count($data) > 0){                    
            $show = '';
            include_once '../models/message.php';
            foreach($data as $row){
                $message = new chatUser();
                $message = $row;

                $show = '</div>'.$show;
                $show = ($message->read_id == 1)? '<b>Read</b>'.$show : '<b>Unread</b>'.$show;
                $show = '<span>'.decrypt_message($message->description).'</span>'.$show;
                $show = '<b>'.data_time_message($message->data_time).'</b>'.$show;
                if($message->transmitter_id == $otherID){$show = '<div class="menssage-recived">'.$show;
                }else if($message->transmitter_id == $myId){$show = '<div class="menssage-sent">'.$show;}
                
            }
            $show = $info.$show;
        }else{
            $show = $info.'<div class="start-chat">'.
                        '<span><i class="fa-solid fa-comments"></i> Be the first to say hello</span>'.
                    '</div>';
        }
    }else{
        $show = "MOSTRAR UN ERROR DEBIDO A QUE NO HAY UN ID";
    }
    echo $show;