<script>

    import axios from 'axios';

    import {store} from './data/store';
    import {BASE_URL} from './data/data';


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
                store,

            }
        },

        methods:{

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

            //prende il localStorage e lo mette in store, in localstorage troviamo il ristorante dell'ordine(completo di foods), lo slug del ristorante dell'ordine e gli item messi nel carrello
            getLocalStorage() {

                if (window.localStorage.order) {

                    //prende currentRestaurant e orderItems da localstorage in formato JSON e li trasforma in array e li salva in store
                    let orderString = localStorage.getItem('order');
                    store.orderItems= JSON.parse(orderString);
                    store.orderRestaurantId = localStorage.getItem('restaurantId');
                    let modalString = localStorage.getItem('modal');
                    store.openModal = JSON.parse(modalString);
                    let resturantShowString = localStorage.getItem('resturantShow');
                    store.resturantShow = JSON.parse(resturantShowString);

                    if(store.currentRestaurant.length == undefined){

                        let restaurant = localStorage.getItem('currentRestaurant');
                        store.currentRestaurant = JSON.parse(restaurant);

                    }

                }
            }

        },

        mounted(){

            this.getAuth();

            this.getLocalStorage();

        }


    }

</script>


<template>

    <div class="container-xxl p-0">

        <Header />


        <main class="container-fluid p-0">

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
