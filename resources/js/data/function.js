/* funzioni globali */

import { store } from "./store";

/*

function miaFunzione(){}

const miaFunzione = () => {}

export {miaFunzione, ...};

*/

const getImagePath = (imageName) => {
return new URL(`../img/${imageName}`, import.meta.url).href
}

function closeModal(){

}


function checkRestaurant(item){

    if(Object.keys(this.store.currentRestaurant).length === 0) {

        this.store.openModal = false;
        console.log('caso 1')

    } else if(item.id == this.store.orderRestaurantId ) {

        this.store.openModal = false;
        console.log('caso 2')

    }  else {

        this.store.openModal = true;
        console.log('caso 3')
    }



}

//aggiunge un entità allo store.orderItems creando un array che contiene oggetti es [{id:2, quantity:3},{id:7, quantity:1}] gli id devono essere tutti dei foods dello stesso restaurant
function addFood(food, restaurant = null){

    if(this.store.orderRestaurantId == '' || this.store.orderRestaurantId == this.store.currentRestaurant.id ){

        this.store.currentRestaurant = restaurant;

        //crea l'oggetto es {id:2, quantity:3} e lo pusha entro orderItems se l'id è già presente aumenta la quantity
        let orderItems = this.store.orderItems;
        let index = orderItems.findIndex(element => element['id'] == food.id);
        if(index == -1){
            let obj = {
                id: food.id,
                name: food.name,
                price: food.price,
                quantity: 1};
            this.store.orderItems.push(obj);
        }else{
            orderItems[index].quantity++;
            this.store.orderItems = orderItems;
        }

        if(restaurant != null) {
            this.store.orderRestaurantId = restaurant.id;
            let storageRestaurant = localStorage.getItem('restaurantId');
            window.localStorage.setItem('restaurantId', store.orderRestaurantId);
            this.store.currentRestaurant = restaurant;
        }


        this.store.openModal = false

        this.setLocalStorage();

    }

}

//rimuove una quantity di food da orderItems in store, se diventa 0, rimuove l'oggetto con l' id dall'array
function removeFood(foodId) {

    //diminuisce la quantity del food di riferimento, se arriva a 0 rimuove l'id da orderItems
    let orderItems = this.store.orderItems;
    let index = orderItems.findIndex(element => element['id'] == foodId);
    if(index != -1){
        if(orderItems[index].quantity > 1){
            orderItems[index].quantity--;
            this.store.orderItems = orderItems;
        }else{
            //console.log(index);
            orderItems.splice(index,1);
            this.store.orderItems = orderItems;
        }
    }

    this.setLocalStorage();

    //se l'array di foods da comprare è vuoto, svuota localtorage con il nome del ristorante così da poterne mettere un altro
    if (this.store.orderItems.length == 0) {

        this.clearOrder();

    }
}

//prende il localStorage e lo mette in store, in localstorage troviamo il ristorante dell'ordine(completo di foods), lo slug del ristorante dell'ordine e gli item messi nel carrello
// function getLocalStorage() {
//     //console.log('getLocalStorage');
//     if (window.localStorage.order) {
//         //console.log('prendo order da localstorage');

//         //prende currentRestaurant e orderItems da localstorage in formato JSON e li trasforma in array e li salva in store
//         let orderString = localStorage.getItem('order');
//         this.store.orderItems= JSON.parse(orderString);
//         this.store.orderRestaurantId = localStorage.getItem('restaurantId');
//         // console.log(this.store.currentRestaurant.length);
//         if(this.store.currentRestaurant.length == undefined){
//             // console.log('get currentRestaurant');
//             // console.log(this.store.currentRestaurant);
//             let restaurant = localStorage.getItem('currentRestaurant');
//             this.store.currentRestaurant = JSON.parse(restaurant);
//             // console.log(localStorage);
//             // console.log(this.store.currentRestaurant);
//             // console.log(this.store.orderItems);
//         }

//     }
// }

//prende i dati da store e li salva in loscalStorage convertendoli in JSON
function setLocalStorage() {
    //console.log('setLocalStorage');
    //trasforma l'array in store in una stringa json e la salva in localstorage
    let orderJson = JSON.stringify(this.store.orderItems);
    window.localStorage.setItem('order', orderJson);
    let restaurantJson = JSON.stringify(this.store.currentRestaurant);
    window.localStorage.setItem('currentRestaurant',restaurantJson);
    // console.log('set currentREstaurant');
    // console.log(localStorage);
    //console.log(localStorage.currentRestaurant);
}

//svuota il localStorage e resetta i campi in Store
function clearOrder() {

    this.store.orderItems = [];

    //console.log(localStorage);
    localStorage.clear();
    //console.log('clear storage');
    //console.log(localStorage);
    this.store.orderRestaurantId = "";

    this.store.openModal = false;

    this.store.currentRestaurant = {};
}

//prende da store l'array di id  orderItems e ritorna la quantità dell'id cercato
function getQuantity(foodId,store = null) {
    //console.log('getQuantity');
    if(store == null){

        store  = this.store;
    }
    let quantity = 0;
    let orderItems = store.orderItems;
    let index = orderItems.findIndex(element => element['id'] == foodId);
    if(index != -1){
        quantity = orderItems[index].quantity;
    }
    return quantity;
}


function foodTotalPrice (price, quantity) {
    const total = price * quantity
    return total.toFixed(2);
}



function totalCartPrice(){
    let total = 0;
    let store = this.store
    let cart = store.orderItems;

    cart.forEach(food => {
        total += parseFloat(foodTotalPrice(food.price,food.quantity));
    });

    return total.toFixed(2);
}



export {getImagePath,getQuantity,clearOrder,setLocalStorage,removeFood,addFood, getQuantity,checkRestaurant,foodTotalPrice,totalCartPrice};
