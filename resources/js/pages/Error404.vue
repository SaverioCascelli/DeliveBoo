<!-- componente/pagina per la gestione della pagina di errore 404 -->

<script>

    export default {

        name:'Error404'

    }

</script>


<template>

    <div class="error container-fluid d-flex justify-content-center align-items-center">

        <h2>Ops.. la pagina che cerchi non esiste</h2>

    </div>

</template>


<style lang="scss" scoped>

    @use '../../scss/partialsVue/vars' as *;

    .error {
        min-height: 500px;
        background-color: $bg-light;
        color: $black;
    }

</style>
