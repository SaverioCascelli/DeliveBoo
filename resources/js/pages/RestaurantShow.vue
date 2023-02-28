<!-- componente/pagina per la gestione del dettaglio del ristorante -->

<!-- Pagina Menù Ristoratore Pubblica:
permette di visualizzare il menù di un particolare ristoratore.
È possibile scegliere i cibi desiderati e relativa quantità per inserirli nel carrello. Il carrello si popola con i cibi selezionati e le relative quantità. -->

<script>

    import axios from 'axios';

    import { store } from '../data/store';

    import FoodItem from '../components/FoodItem.vue';
    import Cart from '../components/Cart.vue';

    export default {

        name: 'RestaurantShow',

        components:{

            FoodItem,
            Cart

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
                        this.restaurant = result.data.restaurant;
                        this.foods = result.data.restaurant.foods;
                        store.resturantShow = result.data.restaurant;
                    })
            }
        },

        mounted() {

            this.apiCallFoods();

        }
    }


</script>


<template>

    <div class="container-fluid p-0 mb-2 mb-lg-4">

        <div v-if="foods.length">

            <div class="p-2 p-lg-4">

                <div class="d-flex flex-column flex-md-row align-items-center-md flex-wrap">
                    <h2 class="title display-6 mb-2 mb-md-0 me-2">{{restaurant.name}}</h2>
                    <div v-if="restaurant.free_delivery" class="bike position-relative">
                        <i class="fa-solid fa-bicycle fs-1 text-primary "></i>
                        <small class="position-absolute top-0 start-100 badge rounded-pill bg-danger text-white" >
                            CONSEGNA GRATUITA!
                        </small>
                    </div>

                </div>

                <p class="mb-0">{{restaurant.address}}</p>

            </div>

            <div class="row px-2 px-lg-4 ">

                <div class="col-12 col-lg-8">

                    <div class="row row-cols-2 row-cols-md-3 row-cols-xl-4">

                        <FoodItem v-for="(food,index) in foods" :key="index" :food="food" :restaurant="restaurant" :id="food.id"/>

                    </div>

                </div>

                <div class="col-12 col-lg-4 pt-2">

                    <Cart/>

                </div>

            </div>

        </div>

    </div>

</template>


<style lang="scss" scoped>

    @use '../../scss/partialsVue/vars' as *;

    .title {
        color: &black;
    }
    .bike{
        display:block;
        width: 45px;
    }



</style>
