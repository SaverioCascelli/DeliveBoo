<!-- componente per la gestione della ricerca -->

<script>

import {store} from '../data/store';

    export default {

        name:'SearchInput',

        data(){
            return{

                store,

            }
        },

        methods:{

        }
    }

</script>


<template>

    <div class="mx-3 bg-white p-4 rounded-2 mt-5 mb-4">

        <input class="form-control mb-3" v-model.trim="store.searchInput" @keyup.enter="$emit('seachInput')" type="text" placeholder="Cerca un ristorante">

        <div class="d-flex justify-content-end">
            <button class="search btn btn-primary text-white" @click="$emit('seachInput')">CERCA</button>
        </div>

    </div>


</template>


<style lang="scss" scoped>




</style>
