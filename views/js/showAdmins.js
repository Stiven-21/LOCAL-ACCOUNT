document.getElementById('role').addEventListener('change',function(evt){
    role = evt.target;
    add = document.getElementById('add');
    if(role.value == '3'){ 
        add.removeAttribute('disabled');
        add.classList.remove('disabled');
        add.classList.add('enable');
    }else{ 
        add.setAttribute('disabled', 'disabled');
        add.classList.add('disabled');
        add.classList.remove('enable')
    }
});