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

        // mounted(){
        //     console.log(this.$router);
        // }

    }

</script>


<template>

    <div class="card p-2 mb-3">

        <small v-if="store.openModal && $router.currentRoute._value.name != 'cartPayment'" class="text-danger">
            <i class="fa-solid fa-triangle-exclamation"></i>
            Attenzione! <br> Puoi ordinare da un solo ristorante alla volta
        </small>

        <div v-for="(food, key) in store.orderItems" :key="key" :class="{'mb-2 mt-2': $router.currentRoute._value.name !== 'cartPayment' }">

            <div class="d-flex align-items-center justify-content-between mb-2">
                <div class="d-flex align-items-center">

                    <!-- <div v-if="$router.currentRoute._value.name === 'cartPayment'" class="image rounded-1 overflow-hidden me-1">
                        <img v-if="food.img_url.includes('http')" :src="food.img_url" :alt="food.name">
                        <img v-else :src="getImagePathLAravel(food.img_url)" :alt="food.name">
                    </div> -->

                    <p class="d-block d-md-none mb-0">{{textTruncate(food.name,30)}}</p>
                    <p class="d-none d-md-block mb-0">{{textTruncate(food.name,50)}}</p>
                </div>
                <small v-if="$router.currentRoute._value.name !== 'cartPayment'" class="text-primary">&euro;{{ food.price.replace('.',',') }}</small>
                <p v-if="$router.currentRoute._value.name == 'cartPayment'" class="m-0">
                    <span class="text-danger fw-bold">{{ food.quantity }}</span>
                     X &euro;{{ food.price.replace('.',',') }} <span class="d-none d-sm-inline">= &euro;{{ foodTotalPrice(food.price, food.quantity).replace('.',',') }}</span>
                </p>
            </div>

            <div v-if="$router.currentRoute._value.name !== 'cartPayment'" class="d-flex align-items-center justify-content-between">

                <div class="buttons d-flex align-items-center justify-content-between mb-1">

                    <div class="add-remove d-flex align-items-center justify-content-between">

                        <button class="btn  btn-sm" :class="store.openModal ? 'btn-danger' : 'btn-outline-primary'" :disabled="store.openModal" @click=" removeFood(food.id)">
                            <i class="fa-solid fa-minus"></i>
                        </button>

                        <span> {{ food.quantity }}</span>

                        <button class="btn  btn-sm" :class="store.openModal ? 'btn-danger' : 'btn-outline-primary'" :disabled="store.openModal"  @click="addFood(food, store.currentRestaurant)">
                            <i class="fa-solid fa-plus"></i>
                        </button>

                    </div>

                    <p class="mb-0">
                        &euro;{{ foodTotalPrice(food.price, food.quantity).replace('.',',') }}
                    </p>

                </div>

            </div>

        </div>

        <div class="mt-2 text-end">

            <span v-if="Object.keys(store.currentRestaurant).length > 0">SPEDIZIONE:
                <strong v-if="store.currentRestaurant.free_delivery">
                    &euro;0,00
                </strong>
                <strong v-if="!store.currentRestaurant.free_delivery">
                    &euro;5,90
                </strong>
            </span>

            <span v-else-if="Object.keys(store.resturantShow).length > 0">SPEDIZIONE:
                <strong v-if="store.resturantShow.free_delivery">
                    &euro;0,00
                </strong>
                <strong v-if="!store.resturantShow.free_delivery">
                    &euro;5,90
                </strong>
            </span>

            <span v-else-if="$router.currentRoute._value.name !== 'cartPayment'">SPEDIZIONE:
                <strong>
                    &euro;0,00
                </strong>
            </span>

        </div>

        <div class="mt-2 text-end">
            <strong v-if="Object.keys(store.currentRestaurant).length > 0">TOTALE ORDINE: &euro;{{totalCartPrice(store.currentRestaurant.free_delivery).replace('.',',')  }}</strong>
            <strong v-else-if="Object.keys(store.resturantShow).length > 0">TOTALE ORDINE: &euro;{{ totalCartPrice(store.resturantShow.free_delivery).replace('.',',') }} </strong>
            <strong v-else>TOTALE ORDINE: &euro;0,00</strong>
        </div>


        <div class="d-flex align-items-center justify-content-end my-2">

            <div v-if="!store.openModal && store.orderItems.length > 0 && $router.currentRoute._value.name != 'cartPayment'">
                <router-link :to="{name: 'cartPayment'}">
                    <button class="btn btn-primary text-white">VEDI ORDINE</button>
                </router-link>
            </div>

            <div v-if="$router.currentRoute._value.name == 'cartPayment' && store.orderItems.length > 0 ">
                <router-link :to="{name: 'restaurant', params: {slug: store.currentRestaurant.slug}}">
                    <button class="btn btn-primary text-white">VEDI RISTORANTE</button>
                </router-link>
            </div>

            <button class="ms-3 btn btn-danger btn-sm" :disabled="store.orderItems.length == 0" @click="clearOrder()">CANCELLA E RICOMINCIA</button>

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
        .image {
            width: 65px;
            height: 65px;
            img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
        }
    }

</style>
