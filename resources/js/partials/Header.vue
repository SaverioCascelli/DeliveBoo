<script>

    import {store} from '../data/store';
    import {getImagePath} from '../data/function';

    export default {

        name: 'Header',

        data(){
            return {

                getImagePath,
                store

            }
        },

        computed: {

            cartCheck(){

                let sum = 0;

                store.orderItems.forEach(item => {

                    sum += item.quantity

                })

                return sum

            }

        }

    }

</script>

<template>

    <div class="container-fluid p-0 ">

        <nav class="nav p-2 px-lg-4 d-flex justify-content-between align-items-center bg-primary">

            <div class="logo-container d-flex align-items-center">

                <div class="logo d-flex align-items-center me-2">
                    <router-link :to="{name: 'home'}">
                        <img :src="getImagePath('logo-white.png')" alt="Deliveboo logo">
                    </router-link>
                </div>

                <router-link :to="{name: 'home'}">
                    <h4 class="text-white mb-0">deliveboo</h4>
                </router-link>

            </div>

            <ul class="ps-0 d-flex justify-content-between align-items-center mb-0">
                <li v-if="!store.isAuth" class="nav-item">
                    <a class="nav-link link-light p-0 me-4" :class="{'d-none': store.isAuth }" href="/login">Login</a>
                </li>
                <li v-if="!store.isAuth" class="nav-item d-none d-sm-block">
                    <a class="nav-link link-light p-0" :class="{'d-none': store.isAuth }" href="/register">Registrati</a>
                </li>
                <li v-if="store.isAuth" class="nav-item">
                    <a class="nav-link link-light  p-0" :class="{'d-none': !store.isAuth }" href="/admin">Il mio ristorante</a>
                </li>

                <li  class="nav-item mx-2">

                    <router-link :to="{name: 'cartPayment'}">
                        <button class="btn position-relative nav-link link-light">
                            <i class="fs-4 fa-solid fa-cart-arrow-down"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-white text-danger" :class="{'d-none' : store.orderItems.length == 0 }">
                                {{ cartCheck }}
                            </span>
                        </button>
                    </router-link>

                </li>
            </ul>

        </nav>

    </div>


</template>

<style lang="scss" scoped>

    @use '../../scss/partialsVue/vars' as *;

    .nav {
        height: $nav-height;
        position: relative;

        .logo-container {
            position: relative;
            width: 160px;
            .logo {
            width: $logo-width;
            }
        }
    }


</style>
