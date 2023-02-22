<!-- componente/pagina per la gestione del carrello e del pagamento -->

<!-- Pagina carrello/checkout:
permette di modificare le quantità dei cibi e di procedere all’ordine.
È possibile acquistare solo da un ristoratore alla volta.
Tramite questo pannello è possibile pagare inserendo i dettagli della carta di credito. -->

<script>

import axios from 'axios';
import { setLocalStorage, getLocalStorage, getQuantity, removeFood, addFood, clearOrder, getFood } from '../data/function';
import { store } from '../data/store';

export default {

    name: 'CartPayment',
    data() {
        return {
            store,
            //****funzioni richiamate da function.js***
            setLocalStorage,
            getLocalStorage,
            getQuantity,
            removeFood,
            addFood,
            clearOrder,
            getFood,
            //***fine funzioni chiamate da function.js */

            //serve per le funzioni di aggiunta in localstorage

        }
    },
    methods: {

        getRestaurant() {
            this.getLocalStorage();

        },

    },
    mounted() {
        this.getRestaurant();
    }

}


</script>


<template>
    <h1>CARRELLO E PAGAMENTO</h1>
    <div class="cart">

        <div v-for="(food, key) in store.orderItems">
            <span>{{ getFood(food.id).name }}</span>
            <button @click="removeFood(food.id)">remove</button>
            <span>quantity : {{ getQuantity(food.id) }}</span>
            <button @click="addFood(food.id)">add</button>
        </div>

    </div>



    <button @click="clearOrder()">clear localStorage</button>
</template>


<style lang="scss" scoped></style>
