<!-- componente per la gestione del Header -->

<script>

    export default {

        name:'Header'

    }

</script>


<template>

    <h1>HEADER</h1>
    <ul>
        <li class="nav-item">
            <router-link :to="{ name: 'login' }">home</router-link>
        </li>
        <li class="nav-item">
            <router-link :to="{ name: 'register' }">register</router-link>
        </li>
    </ul>

</template>


<style lang="scss" scoped>


</style>
