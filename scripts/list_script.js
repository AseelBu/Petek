$(document).ready(function () {

    $("#prdctName").autocomplete({
        source: function (request, response) {
            $.ajax(
                {
                    url: "api/getProductsByName.php",
                    type: "GET",

                    data: { term: request.term },
                    success: function (data) {
                        products = [];
                        $(data).each(function (i, product) {
                            products.push(product['name'])
                        })
                        response(products);
                    },

                    error: function (result) {
                        alert("Error");
                    }
                })
        }

        , appendTo: '#menu-container',
        minLength: 1
    }).focus(function () {
        $(this).autocomplete("search", $(this).val())
    });

})