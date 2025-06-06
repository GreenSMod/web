class Pizza {
    constructor(type, size) {
        this.type = type;
        this.size = size;
        this.toppings = [];
        this.price = 0;
        this.calories = 0;

        switch (this.type) {
            case 'Маргарита':
                this.price = 500;
                this.calories = 300;
                break;
            case 'Пепперони':
                this.price = 800;
                this.calories = 400;
                break;
            case 'Баварская':
                this.price = 700;
                this.calories = 450;
                break;
        }

        switch (this.size) {
            case 'Маленькая':
                this.price += 100;
                this.calories += 100;
                break;
            case 'Большая':
                this.price += 200;
                this.calories += 200;
                break;
        }
    }

    addTopping(topping) {
        this.toppings.push(topping);
    }

    removeTopping(topping) {
        this.toppings = this.toppings.filter(item => item !== topping);
    }

    getToppings() {
        return this.toppings;
    }

    getSize() {
        return this.size;
    }

    getStuffing() {
        return this.type;
    }

    calculatePrice() {
        let price = this.price;
        for (let i = 0; i < this.toppings.length; i++) {
            if (this.toppings[i] === 'Сливочная_моцарелла') {
                price += 50;
            } else if (this.toppings[i] === 'Сырный_борт') {
                price += (this.size === 'Маленькая' ? 150 : 300);
            } else if (this.toppings[i] === 'Чедер_пармезан') {
                price += (this.size === 'Маленькая' ? 150 : 300);
            }
        }
        return price;
    }

    calculateCalories() {
        let calories = this.calories;
        for (let i = 0; i < this.toppings.length; i++) {
            if (this.toppings[i] === 'Сливочная_моцарелла') {
                calories += 20;
            } else if (this.toppings[i] === 'Сырный_борт') {
                calories += 50;
            } else if (this.toppings[i] === 'Чедер_пармезан') {
                calories += 50;
            }
        }
        return calories;
    }
}

const myPizza = new Pizza('Маргарита', 'Маленькая');
myPizza.addTopping('Сливочная_моцарелла');
myPizza.addTopping('Сырный_борт');
console.log('Добавки:', myPizza.getToppings());
console.log('Размер:', myPizza.getSize());
console.log('Вид:', myPizza.getStuffing());
console.log('Цена:', myPizza.calculatePrice());
console.log('Ккалории:', myPizza.calculateCalories());
myPizza.removeTopping('Сырный_борт');
console.log('Добавки:', myPizza.getToppings());
console.log('Размер:', myPizza.getSize());
console.log('Вид:', myPizza.getStuffing());
console.log('Цена:', myPizza.calculatePrice());
console.log('Ккалории:', myPizza.calculateCalories());