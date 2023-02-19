<!-- componente/pagina per la gestione della home -->

<!-- Homepage:
offre la possibilità di cliccare sulle tipologie di ristorante e senza il refresh della pagina ottenere una lista di ristoranti con le tipologie di appartenenza sotto ogni nome. -->



<script>

import axios from 'axios';
import {store} from '../data/store';
import {BASE_URL} from '../data/data'
import {active_base_url} from '../data/data'
import Search from '../components/Search.vue';

    export default {

        name:'Home',
        components:{
            Search
        },
        data(){
            return{
                BASE_URL,
                active_base_url,
                store
            }
        },
        methods:{
            getApi(url){
                axios.get(url)
                    .then(result => {
                        store.restaurants = result.data.restaurant;
                        store.types = result.data.types;
                        //console.log(this.store.restaurants);
                        //console.log(this.store.types);
                    })
                },
        },
        mounted(){
            this.getApi(active_base_url);
        }
    }

</script>


<template>

    <main class="bg-success">
        <div class="container py-4">
            <h1>HOME</h1>
            <search/>
        </div>
    </main>

</template>


<style lang="scss" scoped>

main{
    height: calc(100vh - 40px);

}


</style>
