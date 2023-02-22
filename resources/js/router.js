import { createRouter, createWebHistory } from 'vue-router';

import Home from './pages/Home.vue';
import RestaurantShow from './pages/RestaurantShow.vue';
import CartPayment from './pages/CartPayment.vue';
import Error404 from './pages/Error404.vue';

const router = createRouter({
    history : createWebHistory(),

    // ******************************
    // classe per la rotta attiva
    // linkExactActiveClass: 'active',
    // *******************************

    routes : [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/restaurant/:slug',
            name: 'restaurant',
            component: RestaurantShow
        },
        {
            path: '/cart',
            name: 'cartPayment',
            component: CartPayment
        },
        {
            path:'/:pathMatch(.*)*',
            component : Error404
        }
    ]


});

export { router };
