document.getElementById('email').addEventListener('input', function(evt) {
    campo = evt.target;
    text = document.getElementById('emailHelp');

    if(campo.value == ""){
        text.innerText = "";
        text.style.color = "gray"
    }else{   
        emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
        if(emailRegex.test(campo.value)) {
          text.innerText = "This email is valid";
          text.style.color = "Green"
        }else{;
          text.innerText = "This email is invalid";
          text.style.color = "Red";
        }
    }
});