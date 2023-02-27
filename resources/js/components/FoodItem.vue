<!-- componente per la gestione delle card dei foods -->

<script>

    import {clearOrder,removeFood,addFood,setLocalStorage, getQuantity, getImagePathLAravel } from '../data/function';
    import { store } from '../data/store';
    import { truncateText } from '../data/functionComputed';

    export default {

        name:'FoodItem',

        data(){
            return{
                store,
                //****funzioni richiamate da function.js***
                clearOrder,
                setLocalStorage,
                getQuantity,
                removeFood,
                addFood,
                getImagePathLAravel,

                truncateText
            }
        },

        props: {

            food: Object,
            restaurant: Object

        },

        methods: {

            changeRestaurant() {

                this.clearOrder();
                store.openModal = false;

            },


        },

        computed: {

            textTruncate(){

                return truncateText(this.food.name, 12);

            }

        },

    }


</script>


<template>

    <div class="col p-2 h-100">

        <div class="card h-100 overflow-hidden position-relative" id="{{food.id}}" name="{{food.name}}">

            <div class="image">
                <img v-if="food.img_url.includes('http')" :src="food.img_url" :alt="food.name">
                <img v-else :src="getImagePathLAravel(food.img_url)" :alt="food.name">
            </div>

            <small class="food-name mb-1 text-center">
                {{ textTruncate }}
                <span class="text-primary"> &euro;{{ food.price.replace('.',',') }}</span>
            </small>

            <small  class="description text-capitalize">{{ food.description }}</small>

            <div class="buttons d-flex align-items-center justify-content-between mb-1">

                <button class="btn btn-outline-primary btn-sm" @click="removeFood(food.id)">
                    <i class="fa-solid fa-minus"></i>
                </button>

                <span> {{ getQuantity(food.id) }}</span>

                <button v-if="!store.openModal" class="btn btn-outline-primary btn-sm" @click="addFood(food,restaurant)">
                    <i class="fa-solid fa-plus"></i>
                </button>

                <button v-else @click="foodClicked()" class="btn btn-danger btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-solid fa-plus"></i>
                </button>

            </div>

            <div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">ATTENZIONE</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Puoi ordinare da un solo ristorante alla volta. <br>
                            Clicca prosegui per cancellare l'ordine attuale e ordinare da {{ restaurant.name }}.
                        </div>
                        <div class="modal-footer">
                            <button @click="store.openModal = true" type="button" class="btn btn-danger" data-bs-dismiss="modal">ANNULLA</button>
                            <button @click="changeRestaurant()" type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">PROSEGUI</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</template>


<style lang="scss" scoped>

    @use '../../scss/partialsVue/vars' as *;

    .card {
        color: $black;
        cursor: pointer;
        .image {
            width: 100%;
            height: 180px;
            img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

        }
        .food-name {
            position: absolute;
            top: 3px;
            left: 50%;
            transform: translateX(-50%);
            background-color: $bg-light;
            border-radius: 5px;
            white-space: nowrap;
            padding: 3px 6px;
        }
        .description {
            position: absolute;
            top: 25%;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.7rem;
            width: 90%;
            max-height: 40%;
            background-color: $bg-light;
            overflow-y: scroll;
            padding: 3px;
            border-radius: 5px;
            display:none;
        }
        &:hover .description {
            display: block;
        }
        .buttons {
            width: 90%;
            margin: 0 auto;
            padding: 5px 10px;
            background-color: $success;
            border-radius: 10px;
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }
        .modal {
            color: $black;
        }
    }

</style>
