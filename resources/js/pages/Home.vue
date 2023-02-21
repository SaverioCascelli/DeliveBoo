<!-- componente/pagina per la gestione della home -->

<!-- Homepage:
offre la possibilità di cliccare sulle tipologie di ristorante e senza il refresh della pagina ottenere una lista di ristoranti con le tipologie di appartenenza sotto ogni nome. -->



<script>

    import {store} from '../data/store';

    export default {

        name:'Home',

        data(){
            return{
                store
            }
        },

    }

</script>


<template>

    <div class="container-fluid p-0">
        <div class="search-wrapper container-fluid p-2 p-lg-4">

            <h2 class="title display-6 fw-bold">I tuoi piatti preferiti, consegnati da noi</h2>

            <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6">

                <div class="col p-2" v-for="(type, index) in store.types" :key="index">
                    <div>
                        <img :src="{{type.img_url  }}" alt="">
                    </div>
                </div>

            </div>


        </div>
    </div>



    <main >
        <div class="container py-4">


            <h1>HOME</h1>

            <ul>
                <li v-for="restaurant in store.restaurants" :key="restaurant.id">{{ restaurant.name }}</li>
            </ul>

        </div>
    </main>

</template>


<style lang="scss" scoped>

    @use '../../scss/partialsVue/vars' as *;

    .search-wrapper {
        background-color: $pink;
        .title {
            color: &black;
        }
    }

</style>
