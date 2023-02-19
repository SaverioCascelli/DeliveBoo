const inputUpdateArray = document.getElementsByClassName('input-update');
const imageArray = document.getElementsByClassName('image-available');
const formArray = document.getElementsByClassName('form');


for(let input of inputUpdateArray) {

    input.addEventListener('click', function(){

        const data = input.getAttribute('data');

        for (let form of formArray) {

            const formData = form.getAttribute('data');

            if(data == formData ) {

                for(let image of imageArray){

                    const imageData = image.getAttribute('data');

                    if(data === imageData) {

                        if(image.classList.contains('food-not-available')){
                            image.classList.remove('food-not-available');
                        } else {
                            image.classList.add('food-not-available');
                        }

                        form.submit();



                    }

                }


            }

        }


    })

}


