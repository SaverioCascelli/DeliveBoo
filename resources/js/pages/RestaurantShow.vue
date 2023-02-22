<!-- componente/pagina per la gestione del dettaglio del ristorante -->

<!-- Pagina Menù Ristoratore Pubblica:
permette di visualizzare il menù di un particolare ristoratore.
È possibile scegliere i cibi desiderati e relativa quantità per inserirli nel carrello. Il carrello si popola con i cibi selezionati e le relative quantità. -->

<script>

    import axios from 'axios';

    import { store } from '../data/store';

    import FoodItem from '../components/FoodItem.vue';

    export default {

        name: 'RestaurantShow',

        components:{

            FoodItem

        },

        data() {
            return {

                restaurant: {},
                foods: [],
                store

            }
        },

        methods: {

            apiCallFoods() {
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

            this.apiCallFoods();

        }
    }


</script>


<template>

    <div class="container-fluid p-0">

        <div class="p-2 p-lg-4">

            <div class="d-flex align-items-center">
                <h2 class="title display-6 mb-0 me-2">{{restaurant.name}}</h2>
                <i v-if="restaurant.free_delivery" class="fa-solid fa-bicycle fs-1 text-primary"></i>
            </div>

            <p class="mb-0">{{restaurant.address}}</p>

        </div>

        <div class="row px-2 px-lg-4 ">

            <div class="col-12 col-md-8">

                <div class="row row-cols-2 row-cols-sm-3 row-cols-xl-4">

                    <FoodItem v-for="(food,index) in foods" :key="index" :food="food"/>

                </div>

            </div>

        </div>

        <div>

            <div class="col-12 col-md-4">

                Componente carrello

            </div>

        </div>

    </div>

</template>


<style lang="scss" scoped>

    @use '../../scss/partialsVue/vars' as *;

    .title {
        color: &black;
    }


</style>
