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

            //per aspetta la chiamata axios di braintree
            isBraintreeLoaded: false,

            //in caso di errore del pagmento (viene messo a true solo se la carta non va bene)
            paymentError: false,

            //dopo che viene fatto il pagamento, durante il tempo di verifica di braintree e mentre carica il pagamento
            //non è indicativo del pagamento andato a buon fine ma solo dell'avvenuta chiamata axios
            paymentDone: false,


            name: '',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            cart: JSON.stringify(store.orderItems),
            note: '',
            phoneNumber: '',
            email: '',
            address: '',
            surname: '',
            token: '',
            nonce: '',

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
                nonce: document.getElementById('nonce').value,
                cart: this.cart,
                name: this.name,
                surname: this.surname,
                email: this.email,
                note: this.note,
                phoneNumber: this.phoneNumber,
                address: this.address,

            }
            this.isBraintreeLoaded = false;
            this.paymentDone = true;
            axios.post(url, data, config)
                .then(res => {
                    console.log('pagamento avvenuto');


                    this.clearOrder();



                    //pagina vue di redirect dopo il pagamento
                    this.$router.push({ name: 'thankYou' });

                })
                .catch(err => {
                    // se ci sono errori con il pagmento, faccio veder un messaggio di errore e ricarico la pagina
                    console.log('errori pagamento');
                    this.paymentError = true;
                    this.isBraintreeLoaded = false;
                    this.paymentDone = false;
                    console.log(err);
                    //faccio ricaricare la pagina in caso di errore sulla carta così da ricaricare il form di pagamento
                    setTimeout(this.pageReload, 2000);
                })
        },
        //ricarica la pagina
        pageReload() {
            this.$router.go();
        }
    },
    mounted() {
        this.apiToken();

        store.openModal = false;

    }

}


</script>


<template>

    <div class="container-fluid p-0 mb-2 mb-lg-4">

        <h2 class="p-2 p-lg-4 mb-0">CARRELLO E PAGAMENTO</h2>

        <div class="row px-2 px-lg-4 ">

            <div v-if="store.orderItems.length == 0" class="empty-cart col-12 mb-3">
                <Cart/>
            </div>

            <div v-if="store.orderItems.length > 0" class="col-12 col-lg-7 mb-3">

                <Cart/>

                <div class="card p-2 ">

                    <h5>INFORMAZIONI DI PAGAMENTO </h5>

                    <input type="hidden" name="_token" :value="csrf">
                    <input type="hidden" name="order" :value="cart">

                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input id="email" type="email" class="form-control" v-model.trim="email" placeholder="Inserisci la tua email">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome *</label>
                        <input id="name" type="text" class="form-control" v-model.trim="name" placeholder="Inserisci il tuo nome">
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Cognome *</label>
                        <input id="surname" type="text" class="form-control" v-model.trim="surname" placeholder="Inserisci il tuo cognome">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Indirizzo *</label>
                        <input id="address" type="text" class="form-control" v-model.trim="address"
                            placeholder="Inserisci il tuo indirizzo">
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Numero di telefono *</label>
                        <input id="phoneNumber" type="text" class="form-control" v-model.trim="phoneNumber" placeholder="Inserisci il tuo numero di telefono">
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Note</label>
                        <input id="note" type="text" class="form-control" name="note" v-model.trim="note" placeholder="Inserisci eventuali note per la consegna">
                    </div>

                </div>

            </div>

            <div v-if="store.orderItems.length > 0" class="col-12 col-lg-5 mb-3">

                <div class="card payment p-2 pb-0">
                    <h5>DETTAGLI PAGAMENTO</h5>

                    <div v-show="isBraintreeLoaded && !paymentDone">

                        <!-- il v-if da problemi se dato al form  -->
                        <form id="payment-form" method="post">

                            <input type="hidden" name="_token" :value="csrf">
                            <div id="dropin-container"></div>
                            <input class="btn btn-primary text-white" type="submit"/>
                            <input type="hidden" id="nonce" name="payment_method_nonce" />

                        </form>

                    </div>

                    <div v-show="!isBraintreeLoaded && !paymentError && !paymentDone">
                        loading braintree
                    </div>

                    <div v-show="paymentError" style="background-color: red;">
                        errore nel pagamento reinserisci carta
                    </div>

                    <div v-show="paymentDone" style="background-color: green;">
                        pagamento loading....
                    </div>

                </div>

            </div>

        </div>

    </div>

</template>


<style lang="scss" scoped>

    @use '../../scss/partialsVue/vars' as *;

    .empty-cart{
        height: $jumbo-height;
    }

    .card {
        background-color: $bg-light;
        #payment-form {
            position: relative;
            top: -20px;

        }
    }

</style>
