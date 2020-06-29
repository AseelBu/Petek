/**********grocery_list script*********/
const suggestedProducts = [
    "Bread", "Milk", "Eggs", "Apples", "Chiken", "Cheese",
    "Sugar", "Honey", "Almonds", "rice",
    "Butter", "Tuna", "Bannanas", "Potato", "Salt", "Oil", "meat"
]

$(document).ready(function () {
    // //add product modal

    //autocomplete func

    $("#prdctName").autocomplete({
        source: suggestedProducts
        , appendTo: '#menu-container',
        minLength: 2

    });


})