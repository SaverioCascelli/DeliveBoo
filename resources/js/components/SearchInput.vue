<!-- componente per la gestione della ricerca -->

<script>

import {store} from '../data/store'

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

    <div>

        <input class="form-control me-1 d-inline-block w-75" v-model.trim="store.seachInput" type="text" placeholder="Cerca un ristorante">
        <button class="btn btn-primary text-white" type="submit">Cerca</button>

    </div>


</template>


<style lang="scss" scoped>


</style>
