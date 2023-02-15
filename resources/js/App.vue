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

    <div class="main-wrapper">

        <Header/>

        <main>

            <router-view></router-view>

        </main>

        <Footer/>

    </div>

</template>


<style lang="scss">

    @use '../scss/appVue.scss';

</style>
