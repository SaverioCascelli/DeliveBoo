<!-- componente per la gestione delle card dei foods -->

<script>

import { setLocalStorage, getLocalStorage, getQuantity, removeFood, addFood, clearOrder, getFood, foodTotalPrice, totalCartPrice } from '../data/function';
import { store } from '../data/store';

export default {

    name: 'FoodItem',

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
        }
    },

    props: {

        foods: Object

    }

}

</script>


<template>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4">


        <div v-for="(food, index) in foods" :key="index" class="col">

            <div class="card h-100" id="{{food.id}}" name="{{food.name}}">

                <div class="image">
                    <img :src="food.img_url" :alt="food.name">
                </div>


                <span>{{ food.name }}</span>
                <button @click="removeFood(food.id)">remove</button>
                <span>quantity : {{ getQuantity(food.id) }}</span>
                <button @click="addFood(food.id)">add</button>


            </div>

        </div>




    </div>
</template>


<style lang="scss" scoped>
.image {
    width: 100%;

}
</style>
