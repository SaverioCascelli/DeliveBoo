<!-- componente/pagina per la gestione del carrello e del pagamento -->

<!-- Pagina carrello/checkout:
permette di modificare le quantità dei cibi e di procedere all’ordine.
È possibile acquistare solo da un ristoratore alla volta.
Tramite questo pannello è possibile pagare inserendo i dettagli della carta di credito. -->

<script>

import Cart from '../components/Cart.vue';
import axios from 'axios';
import { setLocalStorage, removeFood, addFood, clearOrder, foodTotalPrice, totalCartPrice } from '../data/function';
import { store } from '../data/store';
import { registerRuntimeHelpers } from '@vue/compiler-core';

export default {

    name: 'CartPayment',

    components: {

        Cart,

    },

    data() {
        return {

            store,
            //****funzioni richiamate da function.js***
            setLocalStorage,
            // getLocalStorage,

            removeFood,
            addFood,
            clearOrder,

            foodTotalPrice,
            totalCartPrice,
            //***fine funzioni chiamate da function.js */

            //per aspetta la chiamata axios di braintree
            isBraintreeLoaded: false,

            //in caso di errore del pagmento (viene messo a true solo se la carta non va bene)
            paymentError: false,

            //dopo che viene fatto il pagamento, durante il tempo di verifica di braintree e mentre carica il pagamento
            //non è indicativo del pagamento andato a buon fine ma solo dell'avvenuta chiamata axios
            paymentDone: false,


            name: '',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            cart: '',
            note: '',
            phoneNumber: '',
            email: '',
            address: '',
            surname: '',
            token: '',
            nonce: '',

            // cartError: []
            nameError: '',
            surnameError: '',
            addressError: '',
            phoneError: '',
            emailError: '',
            noteError: '',

        }


    },
    methods: {
        // costruzione del form di braintree, ha bisogno del container con id "payment-form" nel quale è il container id:"dropin-contaier"
        startForm() {
            this.isBraintreeLoaded = true;
            this.paymentError = false;
            const form = document.getElementById('payment-form');

            braintree.dropin.create({
                authorization: this.token,
                container: '#dropin-container',
                locale: 'it_IT'
            }).then((dropinInstance) => {
                form.addEventListener('submit', (event) => {
                    event.preventDefault();

                    dropinInstance.requestPaymentMethod().then((payload) => {
                        // Step four: when the user is ready to complete their
                        //   transaction, use the dropinInstance to get a payment
                        //   method nonce for the user's selected payment method, then add
                        //   it a the hidden field before submitting the complete form to
                        //   a server-side integration
                        // form.submit();
                        document.getElementById('nonce').value = payload.nonce;
                        this.nonce = payload.nonce;
                        // console.log('nonce');
                        // console.log(this.nonce);
                        this.sendNonce();
                    }).catch((error) => {
                        throw error;
                    });
                });
            }).catch((error) => {
                // handle errors
            });
        },
        // primo token di scambio con braintree,invio una chiamata al mio server e monto il form form(fornito da braintree ). Il server mi fornisce un token con il quale si builda il form
        apiToken() {
            const config = {
                headers: {
                    csrf: this.csrf,
                }
            };
            const url = "http://127.0.0.1:8000/get-token";
            axios.get(url, config)
                .then(res => {
                    // console.log(res.data);
                    this.token = res.data.token;
                    this.startForm();

                })
                .catch(err => console.log(err))
        },
        // il form per la convalida del pagamento ha bisogno del token nonce. Token fornito da braintree dopo la validazione e successivamente inviato al server per la trandazione.Se il token non è valido la transazione non avviene.
        //In caso positiovo pulisco il localstorage e spedisco alla pagina di ThankYou.
        //In caso negativo ricarico la pagina di pagamento per ricreare il form.
        sendNonce() {
            const config = {
                headers: {
                    csrf: this.csrf,
                }
            };
            const url = "http://127.0.0.1:8000/nounce";

            const data = {
                nonce: this.nonce,
                cart: JSON.stringify(store.orderItems),
                name: this.name,
                surname: this.surname,
                email: this.email,
                note: this.note,
                phoneNumber: this.phoneNumber,
                address: this.address,

            }
            this.isBraintreeLoaded = false;
            this.paymentDone = true;

            const input = {
                name: this.name,
                surname: this.surname,
                email: this.email,
                address: this.address,
                phoneNumber: this.phoneNumber,
                note: this.note
            };

            let inputJson = JSON.stringify(input);
            window.localStorage.setItem('input', inputJson);

            axios.post(url, data, config)
                .then(res => {
                    console.log(res.data);
                    if (res.data.status == 'submitted_for_settlement') {
                        console.log('pagamento avvenuto');
                        this.$router.push({ name: 'thankYou' });
                        this.clearOrder();
                    } else {

                        this.paymentError = true;
                        this.isBraintreeLoaded = false;
                        this.paymentDone = false;
                        console.log(err);
                        //faccio ricaricare la pagina in caso di errore sulla carta così da ricaricare il form di pagamento
                        setTimeout(this.pageReload, 2000);
                    }
                    // this.clearOrder();
                    //pagina vue di redirect dopo il pagamento

                    // console.log(res);
                    // console.log('errori pagamento');
                    // this.paymentError = true;
                    // this.isBraintreeLoaded = false;
                    // this.paymentDone = false;
                    // console.log(err);
                    // //faccio ricaricare la pagina in caso di errore sulla carta così da ricaricare il form di pagamento
                    // setTimeout(this.pageReload, 2000);
                })
                .catch(err => {
                    // se ci sono errori con il pagmento, faccio veder un messaggio di errore e ricarico la pagina
                    console.log(err);
                    console.log('errori pagamento');
                    this.paymentError = true;
                    this.isBraintreeLoaded = false;
                    this.paymentDone = false;
                    console.log(err);
                    //faccio ricaricare la pagina in caso di errore sulla carta così da ricaricare il form di pagamento
                    setTimeout(this.pageReload, 2000);

                    // console.log(err);
                    // console.log('pagamento avvenuto');
                    // this.clearOrder();
                    // //pagina vue di redirect dopo il pagamento
                    // this.$router.push({ name: 'thankYou' });
                })
        },
        //ricarica la pagina
        pageReload() {
            this.$router.go();
        },

        inputEmailCheck() {
            if (!this.email.length) {
                this.emailError = "L\'email è un campo obbligatorio";
            } else if (this.email.length < 5) {
                this.emailError = "L\'email può avere minimo 5 caratteri";
            } else if (!this.email.includes('@') || !this.email.includes('.')) {
                this.emailError = "Il formato dell\'email non è corretto";
            } else {
                this.emailError = "";
                return true;
            }
        },

        inputNameCheck() {
            if (!this.name.length) {
                this.nameError = "Il nome è un campo obbligatorio";
            } else if (this.name.length < 2) {
                this.nameError = "Il nome può avere minimo 2 caratteri";
            } else if (this.name.length > 100) {
                this.nameError = "Il nome può avere al massimo 100 caratteri";
            } else {
                this.nameError = "";
                return true;
            }
        },

        inputSurnameCheck() {
            if (!this.surname.length) {
                this.surnameError = "Il cognome è un campo obbligatorio";
            } else if (this.surname.length < 2) {
                this.surnameError = "Il cognome può avere minimo 2 caratteri";
            } else if (this.surname.length > 100) {
                this.surnameError = "Il cognome può avere al massimo 100 caratteri'";
            } else {
                this.surnameError = "";
                return true;
            }
        },

        inputAddressCheck() {
            if (!this.address.length) {
                this.addressError = "L\'indirizzo è un campo obbligatorio";
            } else if (this.address.length < 5) {
                this.addressError = "L\'indirizzo può avere minimo 5 caratteri";
            } else if (this.address.length > 255) {
                this.addressError = "L'indirizzo può avere al massimo 255 caratteri'";
            } else {
                this.addressError = "";
                return true;
            }
        },

        inputPhoneCheck() {
            const regex = /^[0-9]+$/;

            if (!this.phoneNumber.length) {
                this.phoneError = "Il numero di telefono è un campo obbligatorio";
            } else if (!regex.test(this.phoneNumber)) {
                this.phoneError = "Il numero di telefono può contenere solo numeri";
            } else if (this.phoneNumber.length < 5) {
                this.phoneError = "Il numero di telefono può avere minimo 5 caratteri";
            } else if (this.phoneNumber.length > 15) {
                this.phoneError = "Il numero di telefono inserito non è valido'";
            } else {
                this.phoneError = "";
                return true;
            }
        },

        inputNoteCheck() {
            if (this.note.length > 255) {
                this.noteError = "Le note possono avere al massimo 255 caratteri";
            } else if (this.note.length >= 0) {
                this.noteError = "";
                return true;
            }
        },

        checkInput() {
            if (this.inputEmailCheck() && this.inputNameCheck() && this.inputSurnameCheck() && this.inputAddressCheck() && this.inputPhoneCheck() && this.inputNoteCheck()) {
                return true;
            }
        }

    },

    mounted() {
        this.apiToken();

        store.openModal = false;
        store.resturantShow = [];

        let inputString = localStorage.getItem('input');
        if (inputString) {
            let input = JSON.parse(inputString);
            this.name = input.name;
            this.email = input.email;
            this.surname = input.surname;
            this.address = input.address;
            this.phoneNumber = input.phoneNumber;
            this.note = input.note;

        }

    }

}


</script>


<template>
    <div class="container-fluid p-0 mb-2 mb-lg-4">

        <h2 class="p-2 p-lg-4 mb-0 text-lg-center">CARRELLO E PAGAMENTO</h2>

        <div class="row px-2 px-lg-4 ">

            <div v-if="store.orderItems.length == 0" class="empty-cart col-12 col-lg-8 offset-lg-2 mb-3">
                <Cart />
            </div>

            <div v-if="store.orderItems.length > 0" class="col-12 col-lg-8 offset-lg-2 mb-3">

                <Cart />

                <div class="card p-2 ">

                    <h5 class="mb-0">INFORMAZIONI DI PAGAMENTO </h5>
                    <small class="mb-2">I campi contrasegnati con * sono obbligatori</small>

                    <input type="hidden" name="_token" :value="csrf">
                    <input type="hidden" name="order" :value="cart">

                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input @keyup="inputEmailCheck(), checkInput()" id="email" type="email" class="form-control"
                            :class="inputEmailCheck() ? 'is-valid' : 'is-invalid'" v-model.trim="email"
                            placeholder="Inserisci la tua email">
                        <p v-if="emailError.length" class="mb-0 invalid-feedback">{{ emailError }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome *</label>
                        <input @keyup="inputNameCheck(), checkInput()" id="name" type="text" class="form-control"
                            :class="inputNameCheck() ? 'is-valid' : 'is-invalid'" v-model.trim="name"
                            placeholder="Inserisci il tuo nome">
                        <p v-if="nameError.length" class="mb-0 invalid-feedback">{{ nameError }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="surname" class="form-label">Cognome *</label>
                        <input @keyup="inputSurnameCheck(), checkInput()" id="surname" type="text" class="form-control"
                            :class="inputSurnameCheck() ? 'is-valid' : 'is-invalid'" v-model.trim="surname"
                            placeholder="Inserisci il tuo cognome">
                        <p v-if="surnameError.length" class="mb-0 invalid-feedback">{{ surnameError }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Indirizzo *</label>
                        <input @keyup="inputAddressCheck(), checkInput()" id="address" type="text" class="form-control"
                            :class="inputAddressCheck() ? 'is-valid' : 'is-invalid'" v-model.trim="address"
                            placeholder="Inserisci il tuo indirizzo">
                        <p v-if="addressError.length" class="mb-0 invalid-feedback">{{ addressError }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Numero di telefono *</label>
                        <input @keyup="inputPhoneCheck(), checkInput()" id="phoneNumber" type="text" class="form-control"
                            :class="inputPhoneCheck() ? 'is-valid' : 'is-invalid'" v-model.trim="phoneNumber"
                            placeholder="Inserisci il tuo numero di telefono">
                        <p v-if="phoneError.length" class="mb-0 invalid-feedback">{{ phoneError }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="note" class="form-label">Note</label>
                        <input @keyup="inputNoteCheck(), checkInput()" id="note" type="text" class="form-control"
                            name="note" :class="inputNoteCheck() ? 'is-valid' : 'is-invalid'" v-model.trim="note"
                            placeholder="Inserisci eventuali note per la consegna">
                        <p v-if="noteError.length" class="mb-0 invalid-feedback">{{ noteError }}</p>
                    </div>

                </div>

            </div>

            <div v-if="store.orderItems.length > 0" class="col-12 col-lg-8 offset-lg-2 mb-3">

                <div class="card payment p-2 pb-0">
                    <h5>DETTAGLI PAGAMENTO</h5>

                    <div v-show="isBraintreeLoaded && !paymentDone">

                        <!-- il v-if da problemi se dato al form  -->
                        <form id="payment-form" method="post">

                            <input type="hidden" name="_token" :value="csrf">
                            <div id="dropin-container"></div>
                            <input class="btn btn-primary text-white" type="submit" :disabled="!checkInput()" />
                            <input type="hidden" id="nonce" name="payment_method_nonce" />

                        </form>

                    </div>

                    <div v-show="!isBraintreeLoaded && !paymentError && !paymentDone"
                        class="bg-primary text-white px-2 rounded-2 mb-2">
                        <div class="lds-ellipsis">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>

                    <div v-show="paymentError" class="bg-danger text-white px-2 py-1 rounded-2 mb-2">
                        <p class="mb-0">Errore nell'esecuzione del pagamento</p>
                    </div>

                    <div v-if="paymentDone" class="bg-primary text-white px-2 rounded-2 mb-2 d-flex align-items-center">
                        <p class="mb-0 me-2">Pagamento in corso</p>
                        <div class="lds-ellipsis">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</template>


<style lang="scss" scoped>
@use '../../scss/partialsVue/vars' as *;

.empty-cart {
    height: $jumbo-height;
}

.card {
    background-color: $bg-light;

    #payment-form {
        position: relative;
        top: -20px;

    }
}

.lds-ellipsis {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 40px;
}

.lds-ellipsis div {
    position: absolute;
    top: 17px;
    width: 13px;
    height: 13px;
    border-radius: 50%;
    background: white;
    animation-timing-function: cubic-bezier(0, 1, 1, 0);
}

.lds-ellipsis div:nth-child(1) {
    left: 8px;
    animation: lds-ellipsis1 0.6s infinite;
}

.lds-ellipsis div:nth-child(2) {
    left: 8px;
    animation: lds-ellipsis2 0.6s infinite;
}

.lds-ellipsis div:nth-child(3) {
    left: 32px;
    animation: lds-ellipsis2 0.6s infinite;
}

.lds-ellipsis div:nth-child(4) {
    left: 56px;
    animation: lds-ellipsis3 0.6s infinite;
}

@keyframes lds-ellipsis1 {
    0% {
        transform: scale(0);
    }

    100% {
        transform: scale(1);
    }
}

@keyframes lds-ellipsis3 {
    0% {
        transform: scale(1);
    }

    100% {
        transform: scale(0);
    }
}

@keyframes lds-ellipsis2 {
    0% {
        transform: translate(0, 0);
    }

    100% {
        transform: translate(24px, 0);
    }
}
</style>
