fieldCharacters = document.getElementById('field-length');
input = document.getElementById('messageSend');

if(input){
    input.addEventListener('input', function(e){
        text = e.target.value;
        
        characters = text.length;
        if(characters > 500){
            input.value = text.slice(0, -1);
            characters = characters - 1;
        }
        fieldCharacters.innerHTML = characters+"/500";
    })
}