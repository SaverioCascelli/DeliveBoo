<!-- componente per la gestione delle card dei ristoranti -->

<script>

    export default {

        name:'RestaurantItem',

        props: {

            restaurant: Object

        }

    }

</script>


<template>

    <div class="col mb-2 mb-md-3">

        <router-link :to="{name: 'restaurant', params: {slug: restaurant.slug}}">
            <div class="card restaurant overflow-hidden h-100 bg-success">
                <div class="restaurant-image">
                    <img :src="restaurant.img_url" :alt="restaurant.name">
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
            img{
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
        }
        .address {
            font-size: 0.7rem
        }
    }



</style>
