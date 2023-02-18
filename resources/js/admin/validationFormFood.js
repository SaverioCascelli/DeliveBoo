const foodFormCreate = document.getElementById('foodFormCreate');
const foodFormEdit = document.getElementById('foodFormEdit');

let foodForm;

if(foodFormCreate) {

    foodForm = foodFormCreate;

} else if(foodFormEdit) {

    foodForm = foodFormEdit;

}


document.addEventListener('DOMContentLoaded', function(){

    const errorServerFood = document.getElementById('errorServerFood');

    if(errorServerFood || foodFormEdit) {

        nameCheck(foodForm);

        descriptionCheck(foodForm);

        priceCheck(foodForm);

        // imageCheck(foodForm);

    }

})


if(foodForm) {

    foodForm.addEventListener('submit', function(event){

        nameCheck(foodForm, event);

        descriptionCheck(foodForm, event);

        priceCheck(foodForm, event);

        // imageCheck(foodForm, event);

    })

}


// funzione che mostra l'errore lato client
function displayError(errorId, inputId, errorMessage) {

    const inputError = document.getElementById(errorId);
    const inputType = document.getElementById(inputId);

    inputType.classList.add("is-invalid");

    if(inputType.classList.contains('is-valid')){
        inputType.classList.remove("is-valid");
    }

    if(inputError.classList.contains('d-none')){
        inputError.classList.remove("d-none");
    }

    inputError.innerHTML = errorMessage;

}


// funzione che rimuove l'errore lato client
function removeError(errorId, inputId) {

    const inputError = document.getElementById(errorId);
    const inputType = document.getElementById(inputId);

    if(inputType.classList.contains('is-invalid')){
        inputType.classList.remove("is-invalid");
    }

    inputType.classList.add("is-valid");

    inputError.classList.add("d-none");

}


// controllo del nome
function nameCheck(element, event = null){

    if( element.name.value == '') {

        displayError('foodName', 'name', 'Il nome è un campo obbligatorio');

        if(event) event.preventDefault();

    } else if( element.name.value.length > 100 ) {

        displayError('foodName', 'name', 'Il nome deve avere massimo 100 caratteri');

        if(event) event.preventDefault();

    } else if( element.name.value.length < 2 ) {

        displayError('foodName', 'name', 'Il nome deve avere minimo 2 caratteri');

        if(event) event.preventDefault();

    } else {

        removeError('foodName', 'name');

    }

}


// controllo della descrizione
function descriptionCheck(element, event = null){

    if( element.description.value == '') {

        displayError('foodDescription', 'description', 'La descrizione è un campo obbligatorio');

        if(event) event.preventDefault();

    } else if( element.description.value.length > 255 ) {

        displayError('foodDescription', 'description', 'La descrizione deve avere massimo 255 caratteri');

        if(event) event.preventDefault();

    } else if( element.description.value.length < 10 ) {

        displayError('foodDescription', 'description', 'La descrizione deve avere minimo 10 caratteri');

        if(event) event.preventDefault();

    } else {

        removeError('foodDescription', 'description');

    }

}


// controllo del prezzo
function priceCheck(element, event = null){

    const decimalPrice = element.price.value.toString().split('.');

    if( element.price.value == '') {

        displayError('foodPrice', 'price', 'Il prezzo è un campo obbligatorio');

        if(event) event.preventDefault();

    }
    else if( element.price.value == 0 ) {

        displayError('foodPrice', 'price', 'Il prezzo deve essere maggiore di &euro;0');

        if(event) event.preventDefault();

    } else if( element.price.value > 999.99) {

        displayError('foodPrice', 'price', 'Il prezzo deve essere inferiore a &euro;999,99');

        if(event) event.preventDefault();

    } else if( decimalPrice[1] && decimalPrice[1].length > 2 ) {

        displayError('foodPrice', 'price', 'Il prezzo non può avere più di 2 decimali');

        if(event) event.preventDefault();

    } else {

        removeError('foodPrice', 'price');

    }

}


// controllo immagine
// function imageCheck(element, event = null){

//     if( element.img_url.value == '') {

//         displayError('foodImage', 'img_url', 'L\'immagine è un campo obblighatorio');

//         if(event) event.preventDefault();

//     } else {

//         removeError('foodImage', 'img_url');

//     }

// }
