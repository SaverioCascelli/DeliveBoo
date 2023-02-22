/* funzioni globali */

/*

function miaFunzione(){}

const miaFunzione = () => {}

export {miaFunzione, ...};

*/

const getImagePath = (imageName) => {
return new URL(`../img/${imageName}`, import.meta.url).href
}

function checkRestaurant(store){

    //**controllo univocità del ristorante */
    let storageRestaurant = localStorage.getItem('restaurantSlug');
    //console.log(localStorage);
    //se in localStorage esiste restaurantName && in store orderRestaurantSlug è uguale a ''
    if (!(storageRestaurant ) && store.orderRestaurantSlug == '') {
        store.orderRestaurantSlug= store.currentRestaurant.slug;
        window.localStorage.setItem('restaurantSlug', store.orderRestaurantSlug);

    } else if (store.currentRestaurant.slug != storageRestaurant) {
         console.log('ristorante diverso');

        //todo logica ristorante diverso
        return true;
    }
    console.log('stesso ristorante');
    return false;
}

//aggiunge un entità allo store.orderItems creando un array che contiene oggetti es [{id:2, quantity:3},{id:7, quantity:1}] gli id devono essere tutti dei foods dello stesso restaurant
function addFood(foodId){
    //***fine controllo univocità del ristorante */

    if(checkRestaurant(this.store)){
        return;
    }
    this.getLocalStorage();

    //crea l'oggetto es {id:2, quantity:3} e lo pusha entro orderItems se l'id è già presente aumenta la quantity
    let orderItems = this.store.orderItems;
    let index = orderItems.findIndex(element => element['id'] == foodId);
    if(index == -1){
        let obj = {id:foodId, quantity: 1};
        this.store.orderItems.push(obj);
    }else{
        orderItems[index].quantity++;
        this.store.orderItems = orderItems;
    }

    this.setLocalStorage();
    return true
}

//rimuove una quantity di food da orderItems in store, se diventa 0, rimuove l'oggetto con l' id dall'array
function removeFood(foodId) {

    if(checkRestaurant(this.store)){
        return;
    }
     /** controllo univocità del ristorante */

     /**fine controllo univocità del ristorante */

    this.getLocalStorage();

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
    //console.log('remove');
    // console.log(this.store.orderItems );
    //se l'array di foods da comprare è vuoto, svuota localtorage con il nome del ristorante così da poterne mettere un altro
    if (this.store.orderItems.length == 0) {
        this.clearOrder();
        // console.log('clearorder');
    }
}

//prende il localStorage e lo mette in store, in localstorage troviamo il ristorante dell'ordine(completo di foods), lo slug del ristorante dell'ordine e gli item messi nel carrello
function getLocalStorage() {
    //console.log('getLocalStorage');
    if (window.localStorage.order) {
        //console.log('prendo order da localstorage');

        //prende currentRestaurant e orderItems da localstorage in formato JSON e li trasforma in array e li salva in store
        let orderString = localStorage.getItem('order');
        this.store.orderItems= JSON.parse(orderString);
        this.store.orderRestaurantSlug = localStorage.getItem('restaurantSlug');
        // console.log(this.store.currentRestaurant.length);
        if(this.store.currentRestaurant.length == undefined){
            // console.log('get currentRestaurant');
            // console.log(this.store.currentRestaurant);
            let restaurant = localStorage.getItem('currentRestaurant');
            this.store.currentRestaurant = JSON.parse(restaurant);
            // console.log(localStorage);
            // console.log(this.store.currentRestaurant);
            // console.log(this.store.orderItems);
            // console.log('end get currentRestaurant');
        }

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
    // console.log('set currentREstaurant');
    // console.log(localStorage);
    //console.log(localStorage.currentRestaurant);
    // console.log('set currentRestaurant');
}

//svuota il localStorage e resetta i campi in Store
function clearOrder() {
    this.store.orderRestaurantSlug = '',
    this.store.orderItems = [];
    //console.log(localStorage);
    localStorage.clear();
    //console.log('clear storage');
    //console.log(localStorage);
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



function getFood(foodId){
    // console.log('getfood');
    let foods = this.store.currentRestaurant.foods;

    let food = foods.find(element => element.id == foodId);
    // console.log(food);
    // console.log('end getFood');
    return food
}

function foodTotalPrice(foodId , store = null){
    let stor;
    if(store == null){
        stor = this.store
    }else{ stor = store}
    let foods = stor.currentRestaurant.foods;
    let food = foods.find(element => element.id == foodId);
    let quantity = getQuantity(foodId,stor);
    return (food.price * quantity).toFixed(2);
}

function totalCartPrice(){
    let total = 0;
    let store = this.store
    let cart = store.orderItems;


    cart.forEach(food => {
        total += parseFloat(foodTotalPrice(food.id,store));
    });

    return total;
}



export {getImagePath,getQuantity,clearOrder,setLocalStorage,getLocalStorage,removeFood,addFood,getFood,checkRestaurant,foodTotalPrice,totalCartPrice};
