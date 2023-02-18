const userFormRegister = document.getElementById('userRegister');


document.addEventListener('DOMContentLoaded', function(){

    const errorServerRegister = document.getElementById('errorServerRegister');

    if(errorServerRegister) {

        nameCheckRegister(userFormRegister);

        emailCheckRegister(userFormRegister);

        nameRestaurantCheckRegister(userFormRegister);

        pivaCheck(userFormRegister);

        addressCheckRegister(userFormRegister);

        passwordCheckRegister(userFormRegister);
    }

})


if(userFormRegister) {

    userFormRegister.addEventListener('submit', function(event){

        nameCheckRegister(userFormRegister, event);

        emailCheckRegister(userFormRegister, event);

        nameRestaurantCheckRegister(userFormRegister, event);

        pivaCheck(userFormRegister, event);

        addressCheckRegister(userFormRegister, event);

        passwordCheckRegister(userFormRegister, event);

    })

}


// funzione che mostra l'errore lato client
function displayErrorRegister(errorId, inputId, errorMessage) {

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
function removeErrorRegister(errorId, inputId) {

    const inputError = document.getElementById(errorId);
    const inputType = document.getElementById(inputId);

    if(inputType.classList.contains('is-invalid')){
        inputType.classList.remove("is-invalid");
    }

    inputType.classList.add("is-valid");

    inputError.classList.add("d-none");

}


// controllo del nome
function nameCheckRegister(element, event = null){

    if( element.name.value == '') {

        displayErrorRegister('registerName', 'name', 'Il nome è un campo obbligatorio');

        if(event) event.preventDefault();

    } else if( element.name.value.length > 100 ) {

        displayErrorRegister('registerName', 'name', 'Il nome deve avere massimo 100 caratteri');

        if(event) event.preventDefault();

    } else if( element.name.value.length < 2 ) {

        displayErrorRegister('registerName', 'name', 'Il nome deve avere minimo 2 caratteri');

        if(event) event.preventDefault();

    } else {

        removeErrorRegister('registerName', 'name');

    }

}


// controllo dell'email
function emailCheckRegister(element, event = null){

    if( element.email.value == '') {

        displayErrorRegister('registerEmail', 'email', 'L\'email è un campo obbligatorio');

        if(event) event.preventDefault();

    } else if( element.email.value.length > 100 ) {

        displayErrorRegister('registerEmail', 'email', 'L\'email deve avere massimo 100 caratteri');

        if(event) event.preventDefault();

    } else if( !element.email.value.includes('@') || !element.email.value.includes('.')) {

        displayErrorRegister('registerEmail', 'email', 'Il formato dell\'email non è corretto');

        if(event) event.preventDefault();

    } else {

        removeErrorRegister('registerEmail', 'email');

    }

}


// controllo del nome del ristorante
function nameRestaurantCheckRegister(element, event = null){

    if( element.restaurantName.value == '') {

        displayErrorRegister('registerRestaurantName', 'restaurantName', 'Il nome del ristorante è un campo obbligatorio');

        if(event) event.preventDefault();

    } else if( element.restaurantName.value.length > 100 ) {

        displayErrorRegister('registerRestaurantName', 'restaurantName', 'Il nome del ristorante deve avere massimo 100 caratteri');

        if(event) event.preventDefault();

    } else if( element.restaurantName.value.length < 2 ) {

        displayErrorRegister('registerRestaurantName', 'restaurantName', 'Il nome del ristorante deve avere minimo 2 caratteri');

        if(event) event.preventDefault();

    } else {

        removeErrorRegister('registerRestaurantName', 'restaurantName');

    }

}


// controllo della partita iva
function pivaCheck(element, event = null){

    if( element.piva.value == '') {

        displayErrorRegister('registerPiva', 'piva', 'La Partita IVA è un campo obbligatorio');

        if(event) event.preventDefault();

    } else if( element.piva.value.length != 11 ) {

        displayErrorRegister('registerPiva', 'piva', 'La Partita IVA deve avere 11 caratteri');

        if(event) event.preventDefault();

    }  else {

        removeErrorRegister('registerPiva', 'piva');

    }

}


// controllo dell'indirizzo
function addressCheckRegister(element, event = null){

    if( element.address.value == '') {

        displayErrorRegister('registerAddress', 'address', 'L\'indirizzo è un campo obbligatorio');

        if(event) event.preventDefault();

    } else if( element.address.value.length > 100 ) {

        displayErrorRegister('registerAddress', 'address', 'L\'indirizzo deve avere massimo 100 caratteri');

        if(event) event.preventDefault();

    } else if( element.address.value.length < 10 ) {

        displayErrorRegister('registerAddress', 'address', 'L\'indirizzo deve avere minimo 10 caratteri');

        if(event) event.preventDefault();

    } else {

        removeErrorRegister('registerAddress', 'address');

    }

}


// controllo della password
function passwordCheckRegister(element, event = null){

    const confirmPassword = document.getElementById('password-confirm');

    if( element.password.value == '') {

        displayErrorRegister('registerPassword', 'password', 'La password è un campo obbligatorio');

        if(event) event.preventDefault();

    } else if( element.password.value.length < 8 ) {

        displayErrorRegister('registerPassword', 'password', 'La password deve avere minimo 8 caratteri');

        if(event) event.preventDefault();

    } else if( element.password.value != confirmPassword.value ) {

        displayErrorRegister('registerPassword', 'password', 'La password non corrisponde');

        displayErrorRegister('registerPasswordConfirm', 'password-confirm', 'La password non corrisponde');

        if(event) event.preventDefault();

    } else {

        removeErrorRegister('registerPassword', 'password');

        removeErrorRegister('registerPasswordConfirm', 'password-confirm');

    }

}





