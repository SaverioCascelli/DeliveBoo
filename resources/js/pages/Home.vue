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

    <main class="bg-success">
        <div class="container py-4">
            <h1>HOME</h1>

        </div>
    </main>

</template>


<style lang="scss" scoped>

main{
    height: calc(100vh - 40px);

}


</style>
