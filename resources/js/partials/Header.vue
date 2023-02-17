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
            <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Registrati</a>
        </li>
    </ul>

</template>


<style lang="scss" scoped>


</style>
