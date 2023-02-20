<script>

    import Header from './partials/Header.vue';
    import Footer from './partials/Footer.vue';

    export default {

        name:'App',

        components: {

            Header,
            Footer

        }

    }

</script>


<template>

    <div class="container-xxl p-0">

        <header>

            <Header/>

        </header>

        <main class="container-fluid p-0 bg-danger">

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
