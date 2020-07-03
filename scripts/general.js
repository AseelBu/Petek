/***************reset************/
function resetForm() {
    $("form input:not(:checkbox):not(:button):not(:submit)").val('');
    $('input#amountChkBox').prop('checked', false);
    $("form input[type=number]").val('1');
}
/***********password script**********/
const short = 0;
const noMatch = 1;
const ok = 2;

function checkPasswordReg() {
    console.log("checking")
    let pswrd = $('input#pwdReg').val();
    let repswrd = $('input#conpwdReg').val();

    if (pswrd.length < 5) {
        return short;
    }
    if (pswrd !== repswrd) {
        return noMatch;
    }

    return ok;
}

function invalidate(selector) {
    $(selector).focus();
    $(selector).addClass("invalid");

}
function validate(selector) {
    if ($(selector).hasClass("invalid")) {
        $(selector).removeClass("invalid");
    }
}



/**********grocery_list script*********/

var listProducts = [
    // {
    //     "id": 0,
    //     "name": "Bread",
    //     "amount": 3,
    //     "isChecked": true

    // },
    // {
    //     "id": 1,
    //     "name": "Milk",
    //     "amount": null,
    //     "isChecked": false

    // },

]

var cntr = listProducts.length;

// function resetAddPrdct() {
//     $('#prdctName').val("");
//     $('#amountChkBox').prop('checked', false);
//     $('#prdctAmount').val("");
//     // $('input').val("");
// }

function sortByName(a, b) {
    let aName = a.name.toLowerCase();
    let bName = b.name.toLowerCase();
    return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
}

function sortByTr(a, b) {

    let aName = $(a).find(".name").text().toLowerCase();
    let bName = $(b).find(".name").text().toLowerCase();
    return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
}


function addProductToTable(product) {
    let id = product.id;
    let name = product.name;
    let amount = product.amount;
    let isChecked = product.isChecked;

    amount = amount == null ? '---' : amount;
    isChecked = isChecked.toLowerCase === 'Y' ? "check" : "uncheck";

    let tr = `<tr class="${isChecked}" data-id="${id}"> <td class="btnDone">
          <input type="checkbox" class="btnDone"></td>
          <td class="name"> ${name}</td>
          <td class="amount">${amount}</td>
          <td>
              <a href="#" class="btnRemove">
                  <i class="fas fa-times"></i>
              </a>
          </td>
          </tr>`;


    if (isChecked === "check") {
        $("table#products tbody#checkedRows").append(tr);
    }
    else if (isChecked === "uncheck") {
        $("table#products tbody#uncheckedRows").append(tr);
    }
}

function initList() {
    //  $("table#products tbody").empty();

    let tempArr = listProducts;
    tempArr.sort(sortByName);
    var checkedPrdcts = [];
    for (const i in tempArr) {
        let p = tempArr[i];

        addProductToTable(p);
    }
    $("table tr.check input[type=checkbox]").prop("checked", true);
}


function reorderList() {
    let uncheckedRows = $("table#products tbody tr.uncheck");
    uncheckedRows = uncheckedRows.sort(sortByTr);
    $(uncheckedRows).remove();
    $("table#products tbody#uncheckedRows").append(uncheckedRows);
}


$(document).ready(function () {

    // resetForm();

    /***********password script**********/
    // $("form#passwordRegFrm").submit(function (e) {

    //     $("span#message").empty();
    //     validate("input#pwdReg");
    //     validate("input#conpwdReg");
    //     const rslt = checkPasswordReg();
    //     if (rslt === short) {
    //        // e.preventDefault();
    //         invalidate("input#pwdReg");
    //         $("span#message").append("* Password too short, must contain at lest 5 characters");
    //     }
    //     else if (rslt === noMatch) {
    //       //  e.preventDefault();
    //         invalidate("input#conpwdReg");
    //         $("span#message").append("* Passwords don't match !");

    //     }
    //     else {
    //         resetForm();
    //         // window.location.href = "login.html";

    //     }
    // })
    /***************sign up script************/
    // $("form#SignUpFrm").submit(function (e) {

    //     $("span#signUpValditionMsg").empty();
    //     validate("input#Email");
    //     validate("input#Email-confirm");
    //     validate("input#Nickname");

    //     var usrMAil = document.getElementById("Email").value;
    //     var usrMAil2 = document.getElementById("Email-confirm").value;

    //     if (usrMAil !== usrMAil2) {
    //         // e.preventDefault();
    //         invalidate("input#Email-confirm");

    //         let msg = "* Inserted Emails don't match !";
    //         $("span#signUpValditionMsg").append(msg);
    //     }
    //     // else {
    //     //     resetForm();
    //     //     // window.location.href = "setPassword.html";
    //     // }
    // });
    /************list script**************/

    // initList();

    $(document).on('click', 'input.btnDone', function (e) {

        var dataId = $(this).parents("tr").attr("data-id");
        const name = $(this).parents("tr").find(".name").text();
        const amount = $(this).parents("tr").find(".amount").text();

        if ($(this).is(":checked")) {

            $(this).parents("tr").addClass("check");
            $(this).parents("tr").removeClass("uncheck");

            listProducts[dataId].isChecked = true;
            //push down
            let row = $(this).parents("tr");
            $(this).parents("tr").fadeOut(20, function () {
                $(this).parents("tr").remove();
            })

            $(row).appendTo("table#products tbody#checkedRows").hide().fadeIn(200);

        }
        else {

            $(this).parents("tr").addClass("uncheck");
            $(this).parents("tr").removeClass("check");
            listProducts[dataId].isChecked = false;
            //push up
            reorderList();

        }
        $("table tr.check input[type=checkbox]").prop("checked", true);
    })


    //removing product
    $(".remove.modal").modal({
        'backdrop': "static",
        'show': false,
    })
    let rowToRemove = "";

    $(document).on('click', '.btnRemove', function () {
        $(".remove.modal").modal("show");
        rowToRemove = $(this).parents("tr");
        const productName = $(this).parents("tr").find(".name").text();

        $(".remove.modal .modal-body p").html(`You are about to delete <i>${productName}</i>`)
    })

    $(".btnRemoveConfirm").click(function () {
        $(".remove.modal").modal("hide");
        rowToRemove.fadeOut(function () {
            rowToRemove.remove();
            for (i in listProducts) {
                if (listProducts[i].id == rowToRemove.data("id")) {
                    listProducts.splice(i, 1);
                }
            }
        });
    })

    //product amount check box
    $(document).on('click', '#amountChkBox', function () {

        if ($(this).is(":checked")) {
            $("div.amount").show();

        } else {
            $("div.amount").hide();

        }
    });
    //products from previous list check box
    $(document).on('click', '#oldListChkBox', function () {

        if ($(this).is(":checked")) {
            $("div#oldList").show();

        } else {
            $("div#oldList").hide();

        }
    });

    $("form#addProduct").submit(function (e) {
        e.preventDefault();
        $("span#modalMsg").empty();
        $("span#modalGoodMsg").empty();
        let name = $("#prdctName").val();
        let amount = null;

        $.ajax({
            type: "POST",
            url: "api/addProduct.php",
            data: ({ listID: listId, productName: name, amount: amount }),
            success: function (response) {
                let id = response;
            }
        })

        //if product already exists in this list
        if (listProducts.some(pr => pr.name === name)) {
            $("span#modalMsg").append("Product already exists in your list!");
            return;
        }


        if ($("#amountChkBox").is(":checked")) {
            amount = $("#prdctAmount").val();
        }


        const product = { "id": cntr, "name": name, "amount": amount, "isChecked": false };
        listProducts.push(product);
        addProductToTable(product);
        reorderList();
        cntr++;
        $("span#modalGoodMsg").append("Product was added to list successfuly !");

        $("form#addProduct input#prdctName").val("");
        $("form#addProduct input#prdctAmount").val("1");
    });

    $(" #modalAddProduct").click(function () {
        $("#submitProduct").click();
    })

    // $("button#btnNewList").click(function () {

    //     window.open('grocery_list.html', '_blank');
    // })
    /***********login script**********/
    // $("form#loginFrm").submit(function (e) {
    //     window.location.href = "grocery_list.html";

    // })


    // // Ajax & JSON
    // function getInitListDetails(userId) {
    //     $.ajax({
    //         type: "GET",
    //         url: "api/listForUser.php",
    //         data: {
    //             userId: userId
    //         },
    //         success: function (data) {
    //             return data;
    //         },
    //         error: function (xhr, ajaxOptions, error) {
    //             console.log(error);
    //         }
    //     });

    // }

    // function getProductsFromList(listId) {
    //     $.ajax({
    //         type: "GET",
    //         url: "api/getListProducts.php",
    //         data: {
    //             listId: listId
    //         },
    //         success: function (data) {
    //             return data;
    //         },
    //         error: function (xhr, ajaxOptions, error) {
    //             console.log(error);
    //         }


    //     });
    // }

    // function refreshListProducts(products) {
    //     $("table#products tbody").html("");
    //     for (item of products) {
    //         product = { "id": item['id'], "name": item['name'], "amount": item['amount'], "isChecked": item['done'] }
    //         addProductToTable(product);
    //     }
    // }


    //get the products for the list and refresh table
    function refreshProducts(listId) {

        $.ajax({
            type: "GET",
            url: "api/getListProducts.php",
            data: {
                listId: listId
            },
            success: function (products) {
                if (product.length !== 0) {
                    $("table#products tbody").html("");
                    for (item of products) {
                        product = { "id": item['id'], "name": item['name'], "amount": item['amount'], "isChecked": item['done'] }
                        addProductToTable(product);
                    }
                } else {
                    //TODO list is empty
               }
            }, 
            error: function (xhr, ajaxOptions, error) {
                console.log(error);
            }
        });
    }

    // //initiate products table
    // function initProductTable(userId) {
    //     // get the newest list details
    //     $.ajax({
    //         type: "GET",
    //         url: "api/listForUser.php",
    //         data: {
    //             userId: userId
    //         },
    //         success: function (list) {
    //             //TODO if no values returned
    //             if (!$.isEmptyObject(list)) {
    //                 let listId = list.id;
    //                 let listName = list.name;

    //                 // setListName in the title
    //                 $("span h2 #listName").html("");
    //                 $("span h2 #listName").append(listName);

    //                 $("input #listIdIndex").val(listId);
    //                 refreshProducts(listId);

    //             } else {
    //                 //TODO no lists for user
    //             }

    //         },
    //         error: function (xhr, ajaxOptions, error) {
    //             console.log(error);
    //         }
    //     });

    // }



    function populateListsDrop(userId) {
        //get the products for the list
        $.ajax({
            type: "GET",
            url: "api/getUserLists.php",
            data: {
                userId: userId
            },
            success: function (lists) {
                if (lists.length !== 0) {
                    $("li div #lists").html("");
                    for (item of lists) {
                        list = { "id": item['id'], "name": item['name'] }
                        ///add list to view
                        let id = list.id;
                        let name = list.name;
                        let link = `<a class="dropdown-item" data-id="${id}" href="index.php?listId=${id}">${name}</a>`;
                        $("div #listsDrop").append(link);
                    }
                } else {
                    //TODO lists is empty
                }
            },
            error: function (xhr, ajaxOptions, error) {
                console.log(error);
            }
        });
    }
    //initiate index page data
    function initIndexPage() {
        let userId = $("input#userIdIndex");
        if (userId.length != 0) {
            userId = userId.val();
            let listId = $("input#listIdIndex").val();
            //1- initiate the table
            refreshProducts(listId);
            //2-populate lists combo box with all user's lists
            populateListsCombo("allLists", userId);
        }
    }

    // // $("#btnRefreshTable").click(function(){
    // let userId = $("input#userIdIndex");
    // if (userId.length != 0) {
    //     userId = userId.val();

    //     $.ajax({
    //         type: "GET",
    //         url: "api/listForUser.php",
    //         data: {
    //             userId: userId
    //         },
    //         success: function (data) {
    //             let listid = data.id;
    //             let listName = data.name;

    //             $.ajax({
    //                 type: "GET",
    //                 url: "api/getListProducts.php",
    //                 data: {
    //                     listId: listId
    //                 },
    //                 success: function (data) {
    //                     $("table#customers tbody").html("");
    //                     for (item of data) {
    //                         customer = { "firstName": item['first name'], "lastName": item['last name'], "phone": item['phone'] }
    //                         addProductToTable(product);
    //                     }

    //                 }

    //             });
    //         },
    //         error: function (xhr, ajaxOptions, error) {
    //             console.log(error);
    //         }
    //     });
    // }
});
