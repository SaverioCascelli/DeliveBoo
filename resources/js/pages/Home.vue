<!-- componente/pagina per la gestione della home -->

<!-- Homepage:
offre la possibilità di cliccare sulle tipologie di ristorante e senza il refresh della pagina ottenere una lista di ristoranti con le tipologie di appartenenza sotto ogni nome. -->

<script>

import axios from 'axios';

import { store } from '../data/store';
import { BASE_URL } from '../data/data';

import JumboSearch from '../components/JumboSearch.vue';
import Search from '../components/Search.vue';
import RestaurantItem from '../components/RestaurantItem.vue';

export default {

    name: 'Home',

    components: {

        JumboSearch,
        Search,
        RestaurantItem

    },

    data() {
        return {

            store,
            BASE_URL,
            typesString: '',
            params: {},
            paramsObj: {
                name: '',
                types: ''
            },
            isShow: false

        }
    },

    methods: {

        getTypes() {
            axios.get(BASE_URL + '/api/restaurants/types')
                .then(result => {
                    store.types = result.data.types
                    // console.log(result.data.types)
                    // console.log(store.types)
                    store.types.forEach(type => {
                        type.isClick = false;
                    })

                    // console.log(store.types);

                })
        },

        // fa una chiamata axios in cui restituisce i ristoranti applicando due filtri
        // restaurant.name in store.Input           stringa con lo slug del ristorante
        // resturant.types in store.searchArray     array con dentro lo slug della tipologia di ristorante
        getRestaurants() {



            //params è l'oggetto con i  parametri della chiamata axios: dentro vanno name(slug del ristorante da cercare ) e types(array dello slug dei types del ristorante da ricercare)
            this.params = { name: store.searchInput };

            // console.log(this.params)

            //se l'array in store dei tipi è popolato, gli aggiungo ai parametri di ricerca
            if (store.searchArray.length > 0) {
                //creo una stringa con lo slug dei tipi e la aggiungo all'oggetto params
                this.params.types = store.searchArray.join(',')
                // console.log(this.params);
            }

            this.paramsObj = this.params;

            //chiamata axios con i parametri nell'oggetto params
            axios.get(BASE_URL + '/api/restaurants/search', {
                params: this.params
            })
                //salva in store i ristoranti frutto della chiamata axios
                .then(result => {
                    //console.log(params);
                    store.restaurants = result.data.restaurants;
                    // console.log(store.restaurants);

                    //resetto lo store per una nuova chiamata
                    store.searchInput = '';
                    store.searchArray = [];

                    this.isShow = true;
                })
        },

        removeClass() {

            store.types.forEach(type => {
                type.isClick = false;
            })

        }

    },

    computed: {

        showSearch() {
            // console.log(this.paramsObj);
            return this.paramsObj.types.replace(/,/g, '/');
        }

    },

    mounted() {

        this.getTypes();

    }

}

</script>


<template>
    <JumboSearch @searchInput="getRestaurants(); removeClass()" />

    <div class="container-fluid p-0">

        <Search @searchInput="getRestaurants(); removeClass()" />

    </div>

    <div class="container-fluid p-0">

        <h3 v-if="isShow" class="py-5 text-center result" :class="store.restaurants.length ? 'd-none' : 'd-block'">La
            ricerca non ha prodotto alcun risultato...</h3>

        <div :class="store.restaurants.length ? 'd-block' : 'd-none'" class="p-2 p-lg-4">

            <h2 class="mb-1 result display-6 fw-bold mt-1 mt-lg-0 me-3">La selezione di deliveboo</h2>

            <h6 class="result mb-0">{{ store.restaurants.length }}
                <span>{{ store.restaurants.length == 1 ? 'risultato trovato' : 'risultati trovati' }}</span>
            </h6>

            <small v-if="paramsObj.types" class="text-primary">{{ showSearch }}</small>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 mt-2">

                <RestaurantItem v-for="restaurant in store.restaurants" :key="restaurant.id" :restaurant="restaurant" />

            </div>

        </div>

    </div>
</template>


<style lang="scss" scoped>
@use '../../scss/partialsVue/vars' as *;

.result {
    color: $black;
}
</style>
