$(document).ready(function(){
    $('body').on('click', '#list-users div.data-user', function(){
        id_user = $(this).attr('id');
        search_user_chat(id_user);
    })

    $('body').on('click', '#container-scroll-chats div.modal-target-user', function(){
        id_user = $(this).attr('id');
        search_user_chat(id_user);
    })

    function search_user_chat(id_user_chat){
        if(id_user_chat == undefined){
            alert("An error occurred when entering the conversation");
            location.reload();
        }else{
            if(id_user_chat != '-1'){
                localStorage.setItem("__openChat__", true);
                localStorage.setItem("__chatOtherId__", id_user_chat);
                var formData = new FormData();
                formData.append('otherID', id_user_chat);
                $.ajax({
                    type: "POST",
                    url: "http://localhost/cuentas-locales/controllers/openChatController.php",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        $('#container-menssages').fadeIn(1000).html(response);
                        objDiv = document.getElementById("container-menssages");
                        objDiv.scrollTop = objDiv.scrollHeight;
                    }
                });
            }
        }
    }
})