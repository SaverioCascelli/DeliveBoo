const foodForm = document.getElementById('foodForm');

foodForm.addEventListener('submit', function(event){

    // controllo nome piatto

    if( foodForm.name.value == '') {

        displayError('foodName', 'name', 'Il nome è un campo obbligatorio');

        event.preventDefault();

    } else if( foodForm.name.value.length > 100 ) {

        displayError('foodName', 'name', 'Il nome non può superare i 100 caratteri');

        event.preventDefault();

    } else {

        removeError('foodName', 'name');

    }

    // controllo descrizione piatto

    if( foodForm.description.value == '') {

        displayError('foodDescription', 'description', 'La descrizione è un campo obbligatorio');

        event.preventDefault();

    } else if( foodForm.description.value.length > 255 ) {

        displayError('foodDescription', 'description', 'La descrizione non può superare i 255 caratteri');

        event.preventDefault();

    } else {

        removeError('foodDescription', 'description');

    }

    // controllo prezzo piatto

    const decimalPrice = foodForm.price.value.toString().split('.');

    if( foodForm.price.value == '') {

        displayError('foodPrice', 'price', 'Il prezzo è un campo obbligatorio');

        event.preventDefault();

    }
    else if( foodForm.price.value == '0' ) {

        displayError('foodPrice', 'price', 'Il prezzo deve essere maggiore di &euro;0');

        event.preventDefault();

    } else if( foodForm.price.value > 999.99) {

        displayError('foodPrice', 'price', 'Il prezzo deve essere inferiore a &euro;999,99');

        event.preventDefault();

    } else if( decimalPrice[1].length > 2 ) {

        displayError('foodPrice', 'price', 'Il prezzo non può avere più di 2 decimali');

        event.preventDefault();

    } else {

        removeError('foodPrice', 'price');

    }

    // controllo immagine piatto

    if( foodForm.img_url.value == '') {

        displayError('foodImage', 'img_url', 'L\'immagine è un campo obblighatorio');

        event.preventDefault();

    } else {

        removeError('foodImage', 'img_url');

    }

})


function displayError(errorId, inputId, errorMessage) {

    const inputError = document.getElementById(errorId);
    const inputType = document.getElementById(inputId);

    inputType.classList.add("is-invalid");
    inputType.classList.remove("is-valid");

    inputError.classList.remove("d-none");
    inputError.innerHTML = errorMessage;

}

function removeError(errorId, inputId) {

    const inputError = document.getElementById(errorId);
    const inputType = document.getElementById(inputId);

    inputType.classList.remove("is-invalid");
    inputType.classList.add("is-valid");

    inputError.classList.add("d-none");

}


