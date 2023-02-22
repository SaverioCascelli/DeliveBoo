<!-- componente/pagina per la gestione del carrello e del pagamento -->

<!-- Pagina carrello/checkout:
permette di modificare le quantità dei cibi e di procedere all’ordine.
È possibile acquistare solo da un ristoratore alla volta.
Tramite questo pannello è possibile pagare inserendo i dettagli della carta di credito. -->

<script>

import axios from 'axios';
import { setLocalStorage, getLocalStorage, getQuantity, removeFood, addFood, clearOrder, apiOrderRestaurant } from '../data/function';
import { store } from '../data/store';
import { isProxy, toRaw } from 'vue';

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
            apiOrderRestaurant,
            //***fine funzioni chiamate da function.js */

            //serve per le funzioni di aggiunta in localstorage

            foods: {},
        }
    },
    methods: {
        getFood(id) {
            let raw = [];

            raw = toRaw(this.foods);

            let food = raw.find(element => element.id == id);
            // console.log(food);
            return food
        },

        apiCall() {
            this.getLocalStorage();
            axios.get('http://127.0.0.1:8000/api/restaurants/show', {
                params: {

                    name: this.store.orderRestaurantSlug
                }
            })
                .then(result => {
                    store.currentRestaurant = result.data.restaurant;
                    this.foods = store.currentRestaurant.foods;
                    // console.log(this.foods);
                })
        },


        getFirstIndex(foodId) {

            var index = this.store.orderItems.findIndex(element => element == foodId);
            return index;
        }
    },
    mounted() {
        this.apiCall();
    }

}


</script>


<template>
    <h1>CARRELLO E PAGAMENTO</h1>
    <div class="cart">

        <div v-for="(food, key) in store.orderItems">

            <div v-if="key == getFirstIndex(food)" class="food" :id="food" :name="getFood(food).name">
                <span>{{ getFood(food).name }}</span>
                <button @click="removeFood(food)">remove</button>
                <span>quantity : {{ getQuantity(food) }}</span>
                <button @click="addFood(food)">add</button>
            </div>
        </div>

    </div>



    <button @click="clearOrder()">clear localStorage</button>
</template>


<style lang="scss" scoped></style>
