<script>

    import {store} from '../data/store';

    export default {

        name: 'Search',

        data(){
            return {

                store

            }
        },

        methods: {

            onClick(string, boolean) {

                // console.log(boolean)

                if(boolean) {
                    // lo aggiungo
                    store.searchArray.push(string);

                    // console.log(store.searchArray);

                } else {
                    // lo elimino

                    const index = store.searchArray.indexOf(string);

                    store.searchArray.splice(index,1);

                    // console.log(store.searchArray);

                }

            },
        }

    }

</script>

<template>

    <div class="search-wrapper container-fluid p-2 p-lg-4">

        <h2 class="title display-6 fw-bold mt-1 mt-lg-0 mb-0">I tuoi piatti preferiti, consegnati da noi</h2>

        <small class="text-small">* Seleziona le tipologie di cucina che ti più ti piacciono</small>

        <div class="mt-2 mt-lg-3 row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 mb-3">

            <div class="p-2" v-for="(type, index) in store.types" :key="index">
                <div class="type-img" @click="type.isClick = !type.isClick; onClick(type.name, type.isClick)">

                    <img :class="{'active' : type.isClick}" :src="type.img_url" :alt="type.name">

                    <div>
                        <h6 class="type-name">{{ type.name.toUpperCase() }}</h6>
                    </div>

                </div>

            </div>

        </div>

        <div class="d-flex justify-content-center mb-3 mb-lg-1">
            <button class="search btn btn-primary text-white" @click="$emit('searchInput')">CERCA</button>
        </div>

    </div>

</template>

<style lang="scss" scoped>

    @use '../../scss/partialsVue/vars' as *;

    .search-wrapper {
        background-color: $pink;
        .title {
            color: &black;
        }
        .text-small {
            color: $black;
        }
        .type-img{
            flex-basis: 80%;
            aspect-ratio: 1/1;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid $bg-light;
            position: relative;
            height: 100%;
            cursor: pointer;
            img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: all 0.5s ease-in;
                &.active{
                    filter: grayscale(1);
                }
            }
            &:hover img {
                filter: grayscale(1);
            }
            .type-name {
                position: absolute;
                bottom: 10px;
                left: 50%;
                transform: translateX(-50%);
                background-color: white;
                color: $primary;
                padding:5px 10px;
                border-radius: 5px;
                white-space: nowrap;
            }

        }
        .search {
            width: 300px;
        }

    }

</style>
