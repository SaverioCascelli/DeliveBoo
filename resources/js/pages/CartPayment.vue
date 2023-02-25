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

            name: 'saverio',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            cart: JSON.stringify(store.orderItems),
            note: 'prova nota',
            phoneNumber: '3124569552',
            email: 'maildiprova@test.it',
            address: 'via dei platani 22',
            surname: 'cascelli',
            token: '',

        }


    },
    methods: {
        startForm() {
            const form = document.getElementById('payment-form');

            braintree.dropin.create({
                authorization: this.token,
                container: '#dropin-container'
            }).then((dropinInstance) => {
                form.addEventListener('submit', (event) => {
                    event.preventDefault();

                    dropinInstance.requestPaymentMethod().then((payload) => {
                        // Step four: when the user is ready to complete their
                        //   transaction, use the dropinInstance to get a payment
                        //   method nonce for the user's selected payment method, then add
                        //   it a the hidden field before submitting the complete form to
                        //   a server-side integration
                        document.getElementById('nonce').value = payload.nonce;
                        this.sendNonce();
                        form.submit();
                    }).catch((error) => {
                        throw error;
                    });
                });
            }).catch((error) => {
                // handle errors
            });
        },
        apiToken() {
            const config = {
                headers: {
                    csrf: this.csrf,
                }
            };
            const url = "http://127.0.0.1:8000/get-token";
            axios.get(url, config)
                .then(res => {
                    console.log(res.data);
                    this.token = res.data.token;
                    this.startForm();

                })
                .catch(err => console.log(err))
        },
        sendNonce() {
            const config = {
                headers: {
                    csrf: this.csrf,
                }
            };
            const url = "http://127.0.0.1:8000/nounce";

            const data = {
                nonce: document.getElementById('nonce').value,
                cart: this.cart,
                name: this.name,
                surname: this.surname,
                email: this.email,
                note: this.note,
                phoneNumber: this.phoneNumber,
                address: this.address,

            }
            axios.post(url, data, config)
                .then(res => {
                    console.log(res.data);
                    this.clearOrder();

                })
                .catch(err => console.log(err))
        }
    },
    mounted() {
        this.apiToken();
    }

}


</script>


<template>
    <h1>CARRELLO E PAGAMENTO</h1>

    <form id="payment-form" action="/" method="post">

        <input type="hidden" name="_token" :value="csrf">
        <div id="dropin-container"></div>
        <input type="submit" />
        <input type="hidden" id="nonce" name="payment_method_nonce" />
    </form>


    <div class="col-12 col-lg-4 pt-2">

        <Cart />

    </div>

    <form action="/payment" method="post">
        <input type="hidden" name="_token" :value="csrf">
        <input type="hidden" name="order" :value="cart">

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" class="" name="email" :value="email" placeholder="Inserisci la tua email">
        </div>
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input id="nome" type="text" class="" name="name" :value="name" placeholder="Inserisci il tuo nome">
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Cognome</label>
            <input id="surname" type="text" class="" name="surname" :value="surname" placeholder="Inserisci il tuo cognome">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Indirizzo</label>
            <input id="address" type="text" class="" name="address" :value="address"
                placeholder="Inserisci il tuo indirizzo">
        </div>
        <div class="mb-3">
            <label for="phoneNumber" class="form-label">Nome</label>
            <input id="phoneNumber" type="text" class="" name="phoneNumber" :value="phoneNumber"
                placeholder="Inserisci il tuo numero di telefono">
        </div>
        <div class="mb-3">
            <label for="note" class="form-label">Nome</label>
            <input id="note" type="text" class="" name="note" :value="note" placeholder="Note">
        </div>

        <button @click="payment()" type="submit" class="btn btn-primary">Submit</button>
    </form>
</template>


<style lang="scss" scoped></style>
