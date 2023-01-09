import Dropzone from "dropzone";

Dropzone.autoDiscover=false;
if(document.getElementById("dropzone")) {
    const dropzone = new Dropzone('#dropzone', {
        dictDefaultMessage: 'Sube tu imagen aquí',
        acceptedFiles: ".jpeg,.png,.gif, .jpg, .webp",
        addRemoveLinks:true,
        dictRemoveFile:'Borrar Archivos',
        maxFiles:1,
        uploadMultiple:false, 
    
        init: function(){
            if(document.querySelector('[name="image"]').value.trim()){
                const imagenPublicada = {};
                imagenPublicada.size=1234;
                imagenPublicada.name= document.querySelector('[name="image"]').value;
                this.options.addedfile.call(this, imagenPublicada);
                this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);

                imagenPublicada.previewElement.classList.add("dz-sucsess","dz-complete");


            }
        },
    });

    // dropzone.on('sending', function(file, xhr, formData){
    //     console.log(formData); 
    // });

    //asignar el nombre de la imagen al hiden del formulario del post
    dropzone.on('success', function(file, response){
        //console.log(response.image); 
        document.querySelector('[name="image"]').value=response.image;
    });

    // dropzone.on('error', function(file, message){
    //     console.log(message); 
    // });
    // se activa cuando le das a borrar imagen
    dropzone.on('removedfile', function(){
        document.querySelector('[name="image"]').value='';
    });
}