$(document).ready(function(){
    let title = document.getElementById('titleAlertedit');
    let body = document.getElementById('textBodyAlert');
    let aSuccess = document.getElementById('textBodyAlertSuccess');

    $('#formDataUser').submit(function(e){
        e.preventDefault();
        title.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Error saving user data';
        let name = document.getElementById('name');
        let last_name =  document.getElementById('last_name');
        let identification = document.getElementById('identification');
        let phone_number = document.getElementById('phone_number');
        const regex = /^[0-9]*$/;

        if(name && last_name && identification && phone_number){
            if(name.value != ''){
                if(last_name.value != ''){
                    if(identification.value != ''){
                        if(regex.test(identification.value)){
                            if(identification.value.length > 8)
                                if(phone_number.value != ''){
                                    if(regex.test(phone_number.value)){
                                        var formData = new FormData();
                                        formData.append('name', name.value);
                                        formData.append('last_name', last_name.value);
                                        formData.append('identification', identification.value);
                                        formData.append('phone_number', phone_number.value);
                                        formData.append('photo', document.getElementById('file').files[0]);
                                        $.ajax({
                                            type: "POST",
                                            url: "http://localhost/cuentas-locales/controllers/editUserController.php",
                                            data: formData,
                                            contentType: false,
                                            processData: false,
                                            success: function(response){
                                                if(response == "true"){
                                                    aSuccess.innerHTML = 'User information updated successfully';
                                                    showAlertSuccessEdit();
                                                    return false;
                                                }else{ fill_alert_error(body, response); }
                                            }
                                        });
                                    }else{ fill_alert_error(body, 'The phone number field can only contain numbers'); }
                                }else{ fill_alert_error(body, 'The Phone number field cannot be sent empty'); }
                            else{ fill_alert_error(body, 'Identification must contain at least 9 digits'); }
                        }else{ fill_alert_error(body, 'The identification field can only contain numbers'); }
                    }else{ fill_alert_error(body, 'The identification field cannot be sent empty'); }
                }else{ fill_alert_error(body, 'The last name field cannot be sent empty');}
            }else{ fill_alert_error(body, 'The name field cannot be sent empty');}
        }else{fill_alert_error(body, 'An error has occurred in the form fields, please refresh the page');}
    })

    $('#formDataAccount').submit(function(e){
        e.preventDefault();
        title.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Error saving account data';
        let email = document.getElementById('email');
        let password =  document.getElementById('password');

        if(email && password){
            if(email.value != ''){
                const emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
                if(emailRegex.test(email.value)){
                    $.ajax({
                        type: "POST",
                        url: "http://localhost/cuentas-locales/controllers/editAccountController.php",
                        data: $('form').serialize(),
                        success: function(response){
                            console.log(response);
                            if(response == "true"){
                                aSuccess.innerHTML = 'Account information updated successfully';
                                showAlertSuccessEdit();
                                return;
                            }else{ fill_alert_error(body, response )}
                        }
                    });
                }else{ fill_alert_error(body, email.value + ' Is not a valid email'); }
            }else{ fill_alert_error(body, 'The email field cannot be sent empty');}
        }else{ fill_alert_error(body, 'An error has occurred in the form fields, please refresh the page');}
    })
});

function fill_alert_error(body, text){
    body.innerHTML =  text;
    showAlertErrorEdit()
}

function showAlertErrorEdit(){
    const myModal = new bootstrap.Modal('#alertError')
    myModal.show()
}
function showAlertSuccessEdit(){
    const myModal = new bootstrap.Modal('#alertSuccess')
    myModal.show()
}