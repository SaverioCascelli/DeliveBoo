<!-- componente per la gestione delle card dei ristoranti -->

<script>

    import {checkRestaurant, setLocalStorage} from '../data/function';

    import {store} from '../data/store';

    export default {

        name:'RestaurantItem',

        props: {

            restaurant: Object

        },

        data(){
            return{

                checkRestaurant,
                setLocalStorage,
                store
            }
        },

        methods: {
            check(item){
                this.checkRestaurant(item);
            }
        }

    }

</script>


<template>

    <div class="col mb-2 mb-md-3">

        <router-link :to="{name: 'restaurant', params: {slug: restaurant.slug}}" @click="check(restaurant)">
            <div class="card restaurant overflow-hidden h-100 bg-success">
                <div class="restaurant-image">
                    <img :src="restaurant.img_url" :alt="restaurant.name">
                    <h6 v-if="restaurant.free_delivery" class="free-delivery bg-danger">CONSEGNA GRATUITA</h6>
                </div>
                <p class="mb-0 text-center pt-1">{{ restaurant.name }}</p>
                <small class="address text-center pb-1">{{ restaurant.address }}</small>
            </div>
        </router-link>


    </div>

</template>


<style lang="scss" scoped>

    .restaurant {
        cursor: pointer;
        .restaurant-image{
            width: 100%;
            height: 200px;
            overflow: hidden;
            position: relative;
            img{
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
            .free-delivery {
                position: absolute;
                top: 10px;
                left: 50%;
                transform: translateX(-50%);
                white-space: nowrap;
                color:white;
                font-weight: bold;
                padding: 3px 6px;
                border-radius: 5px;

            }
        }
        .address {
            font-size: 0.7rem
        }
    }

</style>
