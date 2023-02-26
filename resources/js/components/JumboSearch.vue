<!-- componente per la gestione del Header -->

<script>

    import {store} from '../data/store';

    export default {

        name:'JumboSearch',

        data(){
            return{

                store,
                optionClick : ''

            }
        },

        methods: {

            typeSearch(){

                if(this.optionClick != ''){
                    store.searchArray.push(this.optionClick);
                    this.optionClick = '';
                }

            }

        }

    }

</script>


<template>

    <div class="jumbo-wrapper h-100 container-fluid p-0 position-relative">

        <!-- shape divider -->
        <div class="custom-shape-divider-top-1676906121">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M1200 120L0 16.48 0 0 1200 0 1200 120z" class="shape-fill"></path>
            </svg>
        </div>

        <div class="custom-shape-divider-bottom-1676906018">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M1200 120L0 16.48 0 0 1200 0 1200 120z" class="shape-fill"></path>
            </svg>
        </div>

        <!-- <HeaderNav /> -->

        <div class="p-4 d-flex justify-content-evenly align-items-center flex-wrap">

            <div class="search-container">

                <h1>I piatti che ami, a domicilio.</h1>

                <div class="mx-3 bg-white p-4 rounded-2 mt-5 mb-4">

                    <input class="form-control" v-model.trim="store.searchInput" @keyup.enter="$emit('searchInput')" type="text" placeholder="Cerca un ristorante per nome">
                    <small class="text-primary">* Inserisci entrambi o solo uno dei campi di ricerca</small>

                    <select v-model="optionClick" class="select form-select mt-3" aria-label="Default select example">
                        <option value='' disabled>Cerca tipologia di cucina</option>

                        <option v-for="(type, index) in store.types" :key="index" :value="type.name">{{ type.name }}</option>

                    </select>

                    <div class="d-flex justify-content-end mt-3">
                        <button class="search btn btn-primary text-white" @click="typeSearch();
                        $emit('searchInput')">CERCA</button>
                    </div>

                </div>

            </div>

            <div class="rider">
                <img src="https://cwa.roocdn.com/_next/static/media/campaign.df58721f.svg" alt="Deliveboo rider">
            </div>

        </div>

    </div>

</template>


<style lang="scss" scoped>

</style>
