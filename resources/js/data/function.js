/* funzioni globali */

/*

function miaFunzione(){}

const miaFunzione = () => {}

export {miaFunzione, ...};

*/

const getImagePath = (imageName) => {
return new URL(`../img/${imageName}`, import.meta.url).href
}


function addFood(foodId){

    let storageRestaurant = localStorage.getItem('restaurantSlug');
    //console.log(localStorage);
    //se in localStorage esiste restaurantName && in store orderRestaurantSlug è uguale a ''
    if (!(storageRestaurant ) && this.store.orderRestaurantSlug == '') {
        this.store.orderRestaurantSlug= this.store.currentRestaurant.slug;
        window.localStorage.setItem('restaurantSlug', this.store.orderRestaurantSlug);

    } else if (this.store.currentRestaurant.slug != storageRestaurant) {
        console.log('ristorante diverso');

        //todo logica ristorante diverso
        return;
    }

    this.getLocalStorage();

    this.store.orderItems.push(foodId);

    this.setLocalStorage();

}

//rimuove un id di food da orderItems in store e order in localstorage
function removeFood(foodId) {
    this.getLocalStorage();

    //cerca il primo elemento con l'id da ricercare e lo rimuove
    var index = this.store.orderItems.findIndex(element => element == foodId);
    if (index != -1) {
        this.store.orderItems.splice(index, 1);

    }

    this.setLocalStorage();

    //se l'array di foods da comprare è vuoto, svuota localtorage con il nome del ristorante così da poterne mettere un altro
    if (this.store.orderItems.length == 0) {
        this.clearOrder();
        console.log(localStorage);
    }
}

//mette l'ordine in localstorage e in store
function getLocalStorage() {
    //console.log('getLocalStorage');
    if (window.localStorage.order) {
        //console.log('prendo order da localstorage');

        //trasforma il json di localstorage in un array di id(food) e lo salva in store
        let orderString = localStorage.getItem('order');
        this.store.orderItems= JSON.parse(orderString);
        this.store.orderRestaurantSlug = localStorage.getItem('restaurantSlug')
        // console.log('localstorage');
        // console.log(localStorage);
        // console.log('order');
        // console.log(this.store.orderRestaurantSlug);
        // console.log(this.store.orderItems);
    }
}

//mette l'ordine da store in localstorage
function setLocalStorage() {
    //console.log('setLocalStorage');
    //trasforma l'array in store in una stringa json e la salva in localstorage
    let orderJson = JSON.stringify(this.store.orderItems);
    window.localStorage.setItem('order', orderJson);
}

//pulisce TUTTO il localstorage
function clearOrder() {
    this.store.orderRestaurantSlug = '',
    this.store.orderItems = [];
    //console.log(localStorage);
    localStorage.clear();
    //console.log('clear storage');
    //console.log(localStorage);
}

//prende da store l'array di id  orderItems e ritorna la quantità dell'id cercato
function getQuantity(foodId) {
    //console.log('getQuantity');
    var quantity = this.store.orderItems.filter(element => element == foodId);
    return quantity.length;
}

function apiOrderRestaurant(){

        this.axios.get('http://127.0.0.1:8000/api/restaurants/show', {
            params: {

                name: this.store.orderRestaurantSlug
            }
        })
            .then(result => {
                store.currentRestaurant = result.data.restaurant;
        })

}

function getFood(id){
    let foods = this.store.currentRestaurant;
    //console.log(foods);
}

export {getImagePath,getQuantity,clearOrder,setLocalStorage,getLocalStorage,removeFood,addFood,apiOrderRestaurant,getFood};
