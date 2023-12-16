window.onload = function(){
    setInterval(updateNotify, 1000);
    function updateNotify(){
        link = '<i class="fa-solid fa-message"></i>&nbsp;'+
                '<b class="text-hidden-profile">Messages</b>';
        $.ajax({
            url: "http://localhost/cuentas-locales/controllers/countNewMessageController.php",
            success: function(response){
                show = response + link;
                $('#menssages').fadeIn().html(show);
            }
        });
    }
}