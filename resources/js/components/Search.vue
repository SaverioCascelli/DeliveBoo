<!-- componente per la gestione della ricerca -->

<script>

import axios from 'axios';
import {store} from '../data/store'
import {BASE_URL} from '../data/data'

    export default {
        name:'Search',
        data(){
            return{
                store,
                tosearch: '',
                selectedTypes: [],
            }
        },
        methods:{
            getRestaurants(){
                // creo l'oggetto di parametri della rotta API, se non esistono tipologie selezionate la ricerca avviene solo tramite testo, e il parametro typeIds viene eliminato dalla URL
                let params = {tosearch: this.tosearch};
                if (this.selectedTypes.length > 0) {
                    params.typeIds = this.selectedTypes.join(',')
                }
                axios.get( BASE_URL + 'restaurants/search', {
                    params:params
                })
                .then(result => {
                    this.tosearch = '';
                    this.typeIds = [];
                    store.restaurants = result.data.restaurants;
                    //console.log(store.restaurants);
                })
            }
        }
    }

</script>


<template>

    <h1>SEARCH</h1>
    <div class="">
        <small class="">Inserisci una o più tipologie di cucina</small>
        <form>
            <div v-for="kind in store.types" :key="kind.id">
                <input type="checkbox"
                    :id="kind.id"
                    :value="kind.id"
                    v-model="selectedTypes">
                <label :for="kind.id">{{ kind.name }}</label>
            </div>

            <input v-model.trim="tosearch" @keyup.enter="getRestaurants" type="text" placeholder="Cerca ristorante">

            <button @click.prevent="getRestaurants">Invia</button>
        </form>
    </div>


    <h2>Risultati della Ricerca:</h2>

    <ul v-for="restaurant in store.restaurants" :key="restaurant.id">
        <li>{{ restaurant.name }}</li>
    </ul>

</template>


<style lang="scss" scoped>


</style>
