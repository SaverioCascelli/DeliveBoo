const imageForm = document.getElementById('img_url');

if(imageForm) {

    imageForm.addEventListener('change', function(event){

        showImage(event);

    })

}

function showImage(event){
    const tagImage = document.getElementById('output-image');
    const wrapperImage = document.getElementById('wrapper-image');
    wrapperImage.classList.remove('d-none');
    tagImage.src = URL.createObjectURL(event.target.files[0]);
}


