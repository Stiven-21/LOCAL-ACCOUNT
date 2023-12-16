list_user = document.getElementById('container-scroll-chats')

document.getElementById('search').addEventListener('input', function(e){
    search = e.target.value;

    if(search == ''){
        list_user.innerHTML = '<div class="modal-target-user" id="-1" >'+
            '<div class="text-modal-not-user">Enter the name or identification number</div>'+
        '</div>';
    }else{
        
        var formData = new FormData();
        formData.append('search', search);
        $.ajax({
            type: "POST",
            url: "http://localhost/cuentas-locales/controllers/chatUserController.php",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                list_user.innerHTML = '<div class="load-wrapp">'+
                                    '<div class="load">'+
                                        '<p>Loading Please wait</p>'+
                                        '<div class="line"></div>'+
                                        '<div class="line"></div>'+
                                        '<div class="line"></div>'+
                                    '</div>'+
                                '</div>';
            },
            success: function(response){
                $('#container-scroll-chats').fadeIn(1000).html(response);
            }
        });
    }
});