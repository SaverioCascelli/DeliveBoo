<!-- componente per la gestione del Header -->

<script>

    export default {

        name:'Header'

    }

</script>


<template>

    <header class="container">
        <div class="d-flex justify-content-between py-2 align-items-center">
            <h1 class="text-info align-items-center">DeliveBoo</h1>
            <ul class="d-flex">
                <li class="mx-4 list-style-none">
                    <button class="btn btn-info">
                        <a href="/admin">Area Riservata</a>
                    </button>
                </li>
            </ul>
        </div>
    </header>

</template>


<style lang="scss" scoped>

ul{
    li{
        list-style: none;
        a{
            color: white;
            text-decoration: none;
        }
    }
}


</style>
