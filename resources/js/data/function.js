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

const getImagePathLAravel = (imageName) => {
    return new URL(`../../../storage/app/public/${imageName}`, import.meta.url).href
}


function checkRestaurant(item){

    this.store.openModal = false;


    if(Object.keys(this.store.currentRestaurant).length === 0) {

        this.store.openModal = false;
        // console.log('caso 1')

    } else if(item.id == this.store.orderRestaurantId ) {

        this.store.openModal = false;
        // console.log('caso 2')

    }  else {

        this.store.openModal = true;
        // console.log('caso 3')
        this.setLocalStorage();
    }



}

//aggiunge un entità allo store.orderItems creando un array che contiene oggetti es [{id:2, quantity:3},{id:7, quantity:1}] gli id devono essere tutti dei foods dello stesso restaurant
function addFood(food, restaurant){

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
                img_url: food.img_url,
                quantity: 1};
            this.store.orderItems.push(obj);
        }else{
            orderItems[index].quantity++;
            this.store.orderItems = orderItems;
        }

        // if(Object.keys(this.store.currentRestaurant).length > 0) {
            this.store.orderRestaurantId = restaurant.id;
            let storageRestaurant = localStorage.getItem('restaurantId');
            window.localStorage.setItem('restaurantId', store.orderRestaurantId);
            this.store.currentRestaurant = restaurant;
        // }


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


//prende i dati da store e li salva in loscalStorage convertendoli in JSON
function setLocalStorage() {
    //console.log('setLocalStorage');
    //trasforma l'array in store in una stringa json e la salva in localstorage
    let orderJson = JSON.stringify(this.store.orderItems);
    window.localStorage.setItem('order', orderJson);
    let restaurantJson = JSON.stringify(this.store.currentRestaurant);
    window.localStorage.setItem('currentRestaurant',restaurantJson);
    let modalJson = JSON.stringify(this.store.openModal);
    window.localStorage.setItem('modal', modalJson);
    let resturantShowJson = JSON.stringify(this.store.resturantShow);
    window.localStorage.setItem('resturantShow', resturantShowJson );
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

    // this.store.resturantShow = {};
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



function totalCartPrice(boolean){
    let total = 0;

    if(!boolean){
        total = 5.9
    }

    let store = this.store
    let cart = store.orderItems;

    cart.forEach(food => {
        total += parseFloat(foodTotalPrice(food.price,food.quantity));
    });

    return total.toFixed(2);
}



export {getImagePath,getQuantity,clearOrder,setLocalStorage,removeFood,addFood, checkRestaurant,foodTotalPrice,totalCartPrice, getImagePathLAravel};
