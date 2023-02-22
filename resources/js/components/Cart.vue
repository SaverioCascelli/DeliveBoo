<!-- componente per la gestione del carrello -->

<script>

    import { setLocalStorage, getLocalStorage, getQuantity, removeFood, addFood, clearOrder, getFood, foodTotalPrice, totalCartPrice } from '../data/function';
    import { store } from '../data/store';

    export default {

        name:'Cart',
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
            foodTotalPrice,
            totalCartPrice,
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

    <div class="card p-2">



        <div v-for="(food, key) in store.orderItems">
            <span>{{ getFood(food.id).name }}</span>
            <button @click="removeFood(food.id)">remove</button>
            <span>quantità : {{ getQuantity(food.id) }}</span>
            <button @click="addFood(food.id)">add</button>



            <div>
                <p>price : {{ getFood(food.id).price }} per pezzo </p>
                <p>totale articolo: {{ foodTotalPrice(food.id) }}</p>
            </div>




            <div>
                <span>totale complessivo: </span>
                <span>{{ totalCartPrice() }}</span>
            </div>
        </div>





        <button class="btn btn-danger" @click="clearOrder()">SVUOTA CARRELLO</button>



    </div>

</template>


<style lang="scss" scoped>


</style>
