<script>

    import axios from 'axios';
    import {store} from './data/store';
    import {BASE_URL} from './data/data'
    import Footer from './partials/Footer.vue';

    export default {

        name:'App',

        components: {

            Footer

        },

        data(){
            return{

                BASE_URL,
                store

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


        },

        mounted(){

            this.getAuth();

        }

    }

</script>


<template>

    <div class="container-xxl p-0">

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
