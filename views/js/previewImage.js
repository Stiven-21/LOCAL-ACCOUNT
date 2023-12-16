message = document.getElementById("info-modal-body");
showImageEdit = document.querySelector('.show-image-edit');

$('#file').on('change', function(e) {
    let file = this.files[0];
    if(file && this.files[0].type.indexOf("image") != -1) {
        let size = this.files[0].size;
        // Crear imagen
        let img = new Image();
        // Crear URL del archivo seleccionado
        let objectUrl = URL.createObjectURL(file);
        // Ejecutar cuando la imagen se cargue
        img.onload = function () {
            // Compara peso (tamaño), alto y ancho
            if(size <= 2700000 && this.width == this.height) { 
                showImageEdit.style.border = "1px solid green";
                previewImage(e);
            }else{
                message.innerHTML = "Image dimensions "+this.width+"x"+this.height+" are not allowed <br> Image ratio allowed 1:1";
                showAlert();
                showImageEdit.style.border = "1px solid red";
                document.getElementById('preview').src = "http://localhost/cuentas-locales/views/images/images/no_preview_image.png";
            }
        };
        img.src = objectUrl;
    } else {
        showImageEdit.style.border = "1px solid red";
        message.innerHTML = "The selected file is not a valid image or is another type of file";
        showAlert();
    }
});

function previewImage(e){
    reader = new FileReader();
    reader.readAsDataURL(e.target.files[0]);
    reader.onload = function(){
        document.getElementById('preview').src = reader.result
    }
}

function showAlert(){
    const myModal = new bootstrap.Modal('#alertpreview')
    myModal.show()
}