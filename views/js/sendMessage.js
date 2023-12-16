$(document).ready(function(){
    $('#formMessageSend').submit(function(e){
        e.preventDefault();
        let message = document.getElementById('messageSend');
        if(message.value.length > 0){
            if(message.value.length < 501){
                if(localStorage.getItem('__openChat__') != undefined && localStorage.getItem('__chatOtherId__') != undefined && localStorage.getItem('__openChat__') == "true"){
                    var formData = new FormData();
                    formData.append('chatOtherId', localStorage.getItem('__chatOtherId__'));
                    formData.append('message', message.value);
                    $.ajax({
                        type: "POST",
                        url: "http://localhost/cuentas-locales/controllers/sendMenssageController.php",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response){
                            console.log(response)
                            if(response == 1){
                                message.value = '';
                            }else{
                                console.log("Error al enviar el mensaje")
                            }
                        }
                    });
                }else{
                    //--------------------------mostra modal
                    alert("No ha abierto ningun chat")
                }
            }else{
                //--------------------------mostra modal
                alert("Mas de 500 caracteres");
            }
        }else{
            //--------------------------mostra modal
            alert("Sin mensaje");
        }
    });
});