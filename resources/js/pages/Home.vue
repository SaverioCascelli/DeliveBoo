<!-- componente/pagina per la gestione della home -->

<!-- Homepage:
offre la possibilità di cliccare sulle tipologie di ristorante e senza il refresh della pagina ottenere una lista di ristoranti con le tipologie di appartenenza sotto ogni nome. -->



<script>

import Search from '../components/Search.vue';

    export default {

        name:'Home',
        components:{
            Search
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
