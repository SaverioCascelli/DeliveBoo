<!-- componente per la gestione del Header -->

<script>

    import {getImagePath} from '../data/function';
    import {store} from '../data/store';

    import SearchInput from '../components/SearchInput.vue';

    export default {

        name:'Header',

        components: {

            SearchInput

        },

        data(){
            return{

                getImagePath,
                store

            }
        }

    }

</script>


<template>

    <div class="header-wrapper h-100 container-fluid p-0 position-relative">

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


        <nav class="nav p-2 px-lg-4 d-flex justify-content-between align-items-center">

            <div class="logo-container d-flex align-items-center">

                <div class="logo d-flex align-items-center me-2">
                    <a href="">
                        <img :src="getImagePath('logo-white.png')" alt="Deliveboo logo">
                    </a>
                </div>

                <a href="">
                    <h4 class="text-white">deliveboo</h4>
                </a>

            </div>

            <ul class="d-flex justify-content-between">
                <li class="nav-item me-2">
                    <a class="nav-link link-light" :class="{'d-none': store.isAuth }" href="login">Login</a>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link link-light" :class="{'d-none': store.isAuth }" href="register">Registrati</a>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link link-light" :class="{'d-none': !store.isAuth }" href="admin">Il mio ristorante</a>
                </li>
            </ul>

        </nav>

        <div class="d-flex justify-content-evenly align-items-center flex-wrap">

            <div class="search-container">

                <h1>I piatti che ami, a domicilio.</h1>

                <SearchInput/>

            </div>


            <div class="rider">
                <img src="https://cwa.roocdn.com/_next/static/media/campaign.df58721f.svg" alt="Deliveboo rider">
            </div>

        </div>

    </div>

</template>


<style lang="scss" scoped>

    @use '../../scss/partialsVue/vars' as *;

    .header-wrapper {
        min-height: $header-height;
        .custom-shape-divider-top-1676906121 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }

        .custom-shape-divider-top-1676906121 svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: $shape-height;
            transform: rotateY(180deg);
        }

        .custom-shape-divider-top-1676906121 .shape-fill {
            fill: $primary-color;
        }

        .custom-shape-divider-bottom-1676906018 {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }

        .custom-shape-divider-bottom-1676906018 svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: $shape-height;
            transform: rotateY(180deg);
        }

        .custom-shape-divider-bottom-1676906018 .shape-fill {
            fill: $secondary-color;
        }

        .nav {
            height: $nav-height;
            position: relative;
            .logo-container {
                position: relative;
                .logo {
                width: $logo-width;
                }
            }
        }

        .search-container {
            position: relative;
            h1 {
                color: $purple;
                font-weight: bold;
                letter-spacing: 1px;
            }
        }

        .rider {
            width: 320px;
            position: relative
        }





    }


</style>
