document.getElementById('showpassword').addEventListener('input', function(evt) {
    campo = evt.target;
    password = document.getElementById('password');
    icono = document.getElementById('icon-show');

    if(campo.checked){
        password.type = 'text';
        password.autocomplete = "off";
        icono.innerHTML = '<i class="fa-sharp fa-solid fa-eye-slash"></i>';
    }else{
        password.type = 'password';
        icono.innerHTML = '<i class="fa-solid fa-eye"></i>';
    }
});