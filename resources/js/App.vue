<script>

    import axios from 'axios';
    import {store} from './data/store';
    import {BASE_URL} from './data/data'
    import Header from './partials/Header.vue';
    import Footer from './partials/Footer.vue';

    export default {

        name:'App',

        components: {

            Header,
            Footer

        },
        data(){
            return{
                BASE_URL,
                store
            }
        },
        methods:{
            mergedApi(){
                this.getAuth();
                this.getRestaurants();
            },

            //se l'utente è loggato ottiene l'id e setta lo store.isAuth a ture del ristorante altrimenti intercetta errore 401(utente senza autorizzazione) e setta store.isAuth a false
            getAuth(){
                axios.get(BASE_URL + '/admin/get-auth')
                    .then(result =>{
                        store.isAuth = true;
                        //console.log(store.isAuth);
                    })
                    //in caso di errore
                    .catch(error =>{
                        store.isAuth = false;
                        //console.log(store.isAuth);
                    })
            },

            // fa una chiamata axios in cui restituisce i ristoranti applicando due filtri
            // restaurant.name in store.Input           stringa con lo slug del ristorante
            // resturant.types in store.searchArray     array con dentro lo slug della tipologia di ristorante
            getRestaurants(){
                //resetto lo store per una nuova chiamata
                store.searchInput = '';
                store.searchArray = [];
                //params è l'oggetto con i  parametri della chiamata axios: dentro vanno name(slug del ristorante da cercare ) e types(array dello slug dei types del ristorante da ricercare)
                let params = {name: store.searchInput};

                //se l'array in store dei tipi è popolato, gli aggiungo ai parametri di ricerca
                if (store.searchArray.length > 0) {
                    //creo una stringa con lo slug dei tipi e la aggiungo all'oggetto params
                    params.types = store.searchArray.join(',')
                     //console.log(params);
                }
                //chiamata axios con i parametri nell'oggetto params
                axios.get( BASE_URL + 'api/restaurants/search', {
                    params:params
                })
                //salva in store i ristoranti frutto della chiamata axios
                .then(result => {
                     //console.log(params);
                    store.restaurants = result.data.restaurants;
                    //console.log(store.restaurants);
                })
            }
        },
        mounted(){
            //faccio partire tutte le api in App.vue
            this.mergedApi();
        }

    }

</script>


<template>

    <div class="container-xxl p-0">

        <header>

            <Header/>

        </header>

        <main class="container-fluid p-0 bg-danger">

            <router-view></router-view>

        </main>

        <footer>

            <Footer/>

        </footer>

    </div>

</template>


<style lang="scss">

    @use '../scss/appVue.scss';

</style>
