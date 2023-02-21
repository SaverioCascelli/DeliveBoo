<!-- componente per la gestione del footer -->

<script>

    import {footerLinks} from '../data/data';

    export default {

        name:'Footer',

        data(){
            return{

                footerLinks

            }
        }

    }

</script>


<template>

    <div class="footer container-fluid">

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 p-2 ps-lg-3 pe-lg-3 pt-lg-3">

            <div class="col p-2" v-for="(footer, key) in footerLinks" :key="key">

                <div class="footer-col h-100 p-3 rounded-2">
                    <h6 class="text-white">{{key}}</h6>

                    <ul class="ps-0 mb-0">
                        <li v-for="(link, index) in footer" :key="index">
                            <a class="footer-link" href="{{ limk.href }}">
                                <small>{{ link.link }}
                                </small>
                            </a>
                        </li>
                    </ul>

                </div>

            </div>

        </div>

        <div class="footer-bottom d-flex justify-content-between align-items-center p-2 p-lg-4">

            <div>

                <a href="#" class="facebook me-3">
                    <i class="fs-5 fa-brands fa-facebook-f"></i>
                </a>

                <a href="#" class="twitter me-3">
                    <i class="fs-5 fa-brands fa-twitter"></i>
                </a>

                <a href="#" class="instagram">
                    <i class="fs-5 fa-brands fa-instagram"></i>
                </a>

            </div>

            <small class="mb-0">&copy; 2023 deliveboo</small>

        </div>
    </div>


</template>


<style lang="scss" scoped>

    @use '../../scss/partialsVue/vars' as *;

    .footer{
        background-color: $black;
        .footer-col {
            background-color: $grey;
            .footer-link {
                color: white;
                &:hover {
                    color: $primary;
                }
            }
        }
        .footer-bottom {
            a {
                color:white;
                &.facebook:hover {
                    color: #1777F2;
                }
                &.twitter:hover {
                    color: #1EA1F1;
                }
                &.instagram:hover {
                    color: #F303D2;
                }
            }
            small {
                color: $bg-light;
            }
        }
    }


</style>
