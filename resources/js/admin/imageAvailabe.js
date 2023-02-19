const formUpdateArray = document.getElementsByClassName('form');


for(let form of formUpdateArray) {

    form.addEventListener('click', function(){

        const data = form.data;

        console.log('form.data');

    })

}



    // isAvailable.addEventListener('click', function(){
    //     formUpdate.submit();

    //     if(imageFood.classList.contains('food-not-available')){
    //         imageFood.classList.remove('food-not-available');
    //         console.log('contiene');
    //     } else {
    //         imageFood.classList.add('food-not-available');
    //         console.log('non-contiene');
    //     }
    // })
