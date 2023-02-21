/* Variabili globali che vanno modificate */

import {reactive} from 'vue';

export const store = reactive({

    restaurants:[],
    types:[],
    isAuth: false,

    currentRestaurant:{},

    searchInput: "",
    searchArray: [],

    orderRestaurantSlug: '' ,
    orderItems: [],

});
