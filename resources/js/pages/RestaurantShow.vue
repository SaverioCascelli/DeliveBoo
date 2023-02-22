<!-- componente/pagina per la gestione del dettaglio del ristorante -->

<!-- Pagina Menù Ristoratore Pubblica:
permette di visualizzare il menù di un particolare ristoratore.
È possibile scegliere i cibi desiderati e relativa quantità per inserirli nel carrello. Il carrello si popola con i cibi selezionati e le relative quantità. -->

<script>
import axios from 'axios';

import { setLocalStorage, getLocalStorage, getQuantity, removeFood, addFood, clearOrder } from '../data/function';
import { store } from '../data/store';


export default {

    name: 'RestaurantShow',
    data() {
        return {
            restaurant: {},
            foods: [],
            store,


            //****funzioni richiamate da function.js***
            setLocalStorage,
            getLocalStorage,
            getQuantity,
            removeFood,
            addFood,
            clearOrder,
            //***fine funzioni chiamate da function.js */

        }
    },
    methods: {
        apiCall() {
            axios.get('http://127.0.0.1:8000/api/restaurants/show', {
                params: {

                    name: this.$route.params.slug
                }
            })
                .then(result => {
                    store.currentRestaurant = result.data.restaurant;
                    this.restaurant = store.currentRestaurant;
                    this.foods = store.currentRestaurant.foods;
                    //console.log(store.currentRestaurant.foods);
                })
        }
    },
    mounted() {
        this.apiCall();
        this.getLocalStorage();
    }
}


</script>


<template>
    <h1>DETTAGLIO RISTORANTE</h1>
    <div v-for="food in foods">

        <div class="food" id="{{food.id}}" name="{{food.name}}">
            <span>{{ food.name }}</span>
            <button @click="removeFood(food.id)">remove</button>
            <span>quantity : {{ getQuantity(food.id) }}</span>
            <button @click="addFood(food.id)">add</button>
        </div>
    </div>
</template>


<style lang="scss" scoped></style>
