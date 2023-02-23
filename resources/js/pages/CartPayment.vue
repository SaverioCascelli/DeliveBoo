<!-- componente/pagina per la gestione del carrello e del pagamento -->

<!-- Pagina carrello/checkout:
permette di modificare le quantità dei cibi e di procedere all’ordine.
È possibile acquistare solo da un ristoratore alla volta.
Tramite questo pannello è possibile pagare inserendo i dettagli della carta di credito. -->

<script>

import Cart from '../components/Cart.vue';
import axios from 'axios';
import { setLocalStorage, getLocalStorage, getQuantity, removeFood, addFood, clearOrder, getFood, foodTotalPrice, totalCartPrice } from '../data/function';
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
            getQuantity,
            removeFood,
            addFood,
            clearOrder,
            getFood,
            foodTotalPrice,
            totalCartPrice,
            //***fine funzioni chiamate da function.js */

            //serve per le funzioni di aggiunta in localstorage

        }


    },



    // methods: {

    //     getRestaurant() {
    //         this.getLocalStorage();

    //     },

    // },
    // mounted() {
    //     this.getRestaurant();
    // }

}


</script>


<template>
    <h1>CARRELLO E PAGAMENTO</h1>




    <div class="col-12 col-lg-4 pt-2">

        <Cart />

    </div>

    <button @click="clearOrder()">clear localStorage</button>
</template>


<style lang="scss" scoped></style>
