<!-- componente per la gestione del carrello -->

<script>

    import { setLocalStorage, getLocalStorage, getQuantity, removeFood, addFood, clearOrder, getFood, foodTotalPrice, totalCartPrice } from '../data/function';
    import { truncateText } from '../data/functionComputed';
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
            truncateText

        }


        },

        methods: {

            getRestaurant() {
                this.getLocalStorage();

            },

            textTruncate(name, number = 20){

                return truncateText(name, number);

            }

        },

        mounted() {
            this.getRestaurant();
        }

    }

</script>


<template>

    <div class="card p-2 mb-3">


        <div v-for="(food, key) in store.orderItems" :key="key" class="mb-2">

            <div class="d-flex align-items-center justify-content-between">
                <p>{{ textTruncate(getFood(food.id).name) }}</p>
                <small class="text-primary">&euro;{{ getFood(food.id).price }}</small>
            </div>

            <div class="d-flex align-items-center justify-content-between">

                <div class="buttons d-flex align-items-center justify-content-between mb-1">

                    <div class="add-remove d-flex align-items-center justify-content-between">

                        <button class="btn btn-outline-primary btn-sm" @click="removeFood(food.id)">
                            <i class="fa-solid fa-minus"></i>
                        </button>

                        <span> {{ getQuantity(food.id) }}</span>

                        <button class="btn btn-outline-primary btn-sm" @click="addFood(food.id)">
                            <i class="fa-solid fa-plus"></i>
                        </button>

                    </div>

                    <p class="mb-0">
                        &euro;{{ foodTotalPrice(food.id) }}
                    </p>

                </div>

            </div>

        </div>

            <div class="mt-2 text-end">
                <span>TOTALE ORDINE:
                    <strong>
                        &euro;{{ totalCartPrice() }}
                    </strong>
                </span>
            </div>


            <div class="d-flex justify-content-end my-2">

                <router-link :to="{name: 'cartPayment'}">
                    <button class="btn btn-primary text-white">ORDINA</button>
                </router-link>

                <button class="ms-3 btn btn-danger" @click="clearOrder()">CANCELLA</button>

            </div>



    </div>

</template>


<style lang="scss" scoped>

    @use '../../scss/partialsVue/vars' as *;

    .card {
        background-color: $bg-light;
        color: $black;
        .buttons {
            width: 90%;
            margin: 0 auto;
            padding: 5px 10px;
            background-color: $success;
            border-radius: 10px;
            .add-remove {
                width: 40%;
            }

        }
    }


</style>
