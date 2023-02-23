<!-- componente per la gestione del carrello -->

<script>

    import { setLocalStorage, removeFood, addFood, clearOrder, foodTotalPrice, totalCartPrice } from '../data/function';
    import { truncateText } from '../data/functionComputed';
    import { store } from '../data/store';

    export default {

        name:'Cart',

        data() {
            return {

                store,
                //****funzioni richiamate da function.js***
                setLocalStorage,
                removeFood,
                addFood,
                clearOrder,
                foodTotalPrice,
                totalCartPrice,

                truncateText

            }


        },

        methods: {

            textTruncate(name, number){

                return truncateText(name, number);

            }

        },

    }

</script>


<template>

    <div class="card p-2 mb-3">

        <small v-if="store.openModal" class="text-danger">
            <i class="fa-solid fa-triangle-exclamation"></i>
            Attenzione! <br> Puoi ordinare da un solo ristorante alla volta
        </small>

        <div v-for="(food, key) in store.orderItems" :key="key" class="mb-2 mt-2">

            <div class="d-flex align-items-center justify-content-between">
                <p class="d-block d-lg-none">{{textTruncate(food.name,30)}}</p>
                <p class="d-none d-lg-block">{{textTruncate(food.name,20)}}</p>
                <small class="text-primary">&euro;{{ food.price }}</small>
            </div>

            <div class="d-flex align-items-center justify-content-between">

                <div class="buttons d-flex align-items-center justify-content-between mb-1">

                    <div class="add-remove d-flex align-items-center justify-content-between">

                        <button class="btn  btn-sm" :class="store.openModal ? 'btn-danger' : 'btn-outline-primary'" :disabled="store.openModal" @click=" removeFood(food.id)">
                            <i class="fa-solid fa-minus"></i>
                        </button>

                        <span> {{ food.quantity }}</span>

                        <button class="btn  btn-sm" :class="store.openModal ? 'btn-danger' : 'btn-outline-primary'" :disabled="store.openModal"  @click="addFood(food)">
                            <i class="fa-solid fa-plus"></i>
                        </button>

                    </div>

                    <p class="mb-0">
                        &euro;{{ foodTotalPrice(food.price, food.quantity) }}
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

            <div v-if="!store.openModal && totalCartPrice() != 0">
                <router-link :to="{name: 'cartPayment'}">
                    <button class="btn btn-primary text-white">VEDI ORDINE</button>
                </router-link>
            </div>

            <div v-if="store.openModal">
                <router-link :to="{name: 'restaurant', params: {slug: store.currentRestaurant.slug}}">
                    <button class="btn btn-primary text-white">MODIFICA ORDINE</button>
                </router-link>
            </div>

            <button class="ms-3 btn btn-danger" :disabled="totalCartPrice() == 0" @click="clearOrder()">CANCELLA E RICOMINCIA</button>

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
