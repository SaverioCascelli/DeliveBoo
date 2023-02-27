<script>

    export default {

        name: 'ThankYou',

        methods: {
            timingRedirect() {
                this.$router.push({ name: 'home' });
            }

        },
        mounted() {
            setTimeout(this.timingRedirect, 5000);
        }

    }

</script>

<template>

    <div class="jumbo-wrapper h-100 container-fluid p-0 position-relative">

        <!-- shape divider -->
        <div class="custom-shape-divider-top-1676906121">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M1200 120L0 16.48 0 0 1200 0 1200 120z" class="shape-fill"></path>
            </svg>
        </div>

        <div class="custom-shape-divider-bottom-1676906018">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M1200 120L0 16.48 0 0 1200 0 1200 120z" class="shape-fill"></path>
            </svg>
        </div>

        <!-- <HeaderNav /> -->

        <div class="p-4 d-flex justify-content-evenly align-items-center flex-wrap">

            <div class="search-container">

                <h1>Il tuo ordine arriverà presto.</h1>
                <p class="mb-3">Controlla la tua email, ti abbiamo inviato un messaggio di conferma!</p>

                <small class="d-block mb-2">Attendi qualche secondo e sarai reinderizzato alla home, altrimenti torna subito alla home.</small>
                <button @click="timingRedirect()" class="btn btn-light">TORNA ALLA HOME</button>

            </div>

            <div class="rider">
                <img src="https://cwa.roocdn.com/_next/static/media/campaign.df58721f.svg" alt="Deliveboo rider">
            </div>

        </div>

    </div>

</template>

<style lang="scss" scoped>

</style>
