class Pizza{
  constructor(name, stuffing){
    this.name = name
    this.stuffing = stuffing
    this.dict_price_calories = {"Пепперони": "800 400", "Маргарита": "500 300", "Баварская": "700 450"}
    this.price = Number(this.dict_price_calories[name].split(" ")[0])
    this.calories = Number(this.dict_price_calories[name].split(" ")[1])
    
    if (stuffing == "Маленькая"){ this.price += 100; this.calories += 100}
    else {this.price += 200; this.calories += 200}
    this.topping = []

    this.dict = {"сливочная моцарелла Маленькая": "50 20", "сливочная моцарелла Большая": "100 20",
                  "сырный борт Маленькая": "150 50", "сырный борт Большая": "300 50", 
                  "чедер и пармезан Маленькая": "150 50", "чедер и пармезан Большая": "300 50", }
  }
  addTopping(topping) {
    this.topping.push(topping)
    this.price += Number(this.dict[topping +" " + this.stuffing].split(" ")[0])
    this.calories += Number(this.dict[topping +" " + this.stuffing].split(" ")[1])
  }
  removeTopping(topping) {  
    this.topping.splice(this.topping.indexOf(topping), 1)
    this.price -= Number(this.dict[topping +" " + this.stuffing].split(" ")[0])
    this.calories -= Number(this.dict[topping +" " + this.stuffing].split(" ")[1])
  }

  getToppings() {         return this.topping }
  getSize() {             return this.name}
  getStuffing() {         return this.stuffing }
  calculatePrice() {      return this.price }
  calculateCalories() {   return this.calories }
    
}

let stuffing = "Маленькая"
let name = "Пепперони"
let addCheeseBort = true
let addCMozzarellllaaa = true
let addCheder = true
SetPizza()

function CreatePeperoni(){
  name = "Пепперони"
  SetPizza()
}

function CreateMargaritta(){
  name = "Маргарита"
  SetPizza()
}

function CreateBavarsca(){
  name = "Баварская"
  SetPizza()
}

function ChangeSizeSmall(){
  stuffing = "Маленькая"
  SetPizza()
}

function ChangeSizeBig(){
  stuffing = "Большая"
  SetPizza()
}

function ChangeCheeseBort(){
  if (addCheeseBort){
    pizza.addTopping("сырный борт")
    addCheeseBort = false
  }
  else{
    pizza.removeTopping("сырный борт")
    addCheeseBort = true
  }
  SetTopping()
}

function ChangeMozzarellllaaa(){
  if (addCMozzarellllaaa){
    pizza.addTopping("сливочная моцарелла")
    addCMozzarellllaaa = false
  }
  else{
    pizza.removeTopping("сливочная моцарелла")
    addCMozzarellllaaa = true
  }
  SetTopping()
}

function ChangeCheder(){
  if (addCheder){
    pizza.addTopping("чедер и пармезан")
    addCheder = false
  }
  else{
    pizza.removeTopping("чедер и пармезан")
    addCheder = true
  }
  SetTopping()
}

function SetTopping(){
  console.log(pizza.getToppings())
  SetButton()
}

function SetPizza(){
  pizza = new Pizza(name, stuffing)
  console.log(pizza.getStuffing() + " " + pizza.getSize())
  document.getElementById("Pizza").innerHTML = "Выбрано: " + name
  SetButton()
}

function SetButton(){
  document.getElementById("basket_button").innerHTML = "Добавить в корзину за " + pizza.calculatePrice() + "₽ (" + pizza.calculateCalories() + " кКфлл)"
}

const buttons = document.querySelectorAll('.color-change-btn');

  buttons.forEach(function(button) {
    button.addEventListener('click', function() {
      if (button.classList.contains('special')) {
        button.classList.remove('special');
      } else {
        button.classList.add('special');
      }
    });
  });

  const button1 = document.getElementById('pizzaSelector1');
  const button2 = document.getElementById('pizzaSelector2');
  const button3 = document.getElementById('pizzaSelector3');

  function handleButton345Click() {
    buttons.forEach(function(button) {
      button.classList.remove('special');
      addCheeseBort = true
      addCMozzarellllaaa = true
      addCheder = true
    });
  }
  button1.addEventListener('click', handleButton345Click);
  button2.addEventListener('click', handleButton345Click);
  button3.addEventListener('click', handleButton345Click);