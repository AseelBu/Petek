let listTable = new Vue({
    el: '#listTable',
    data: {
        id: 0,
        name : "",
        amount : "",
        isChecked:"",
        uncheckedrows:[],
        checkedrows:[],
        titles:['Done','Name','Amount','']
    },
    methods:{
        addRow(id, name, amount, isChecked){
            amount = amount == 0 ? '---' : amount;
            isChecked = isChecked === 'Y' ? 'check' : 'uncheck';
          let product = {
            id: id,
            name : name,
            amount : amount,
            isChecked:isChecked,
          };
          if(isChecked === 'check'){
          this.checkedrows.push(product);
          }else if(isChecked === 'uncheck'){
            this.uncheckedrows.push(product);
          }

          this.id = 0;
          this.name = "";
          this.amount = "";
          this.isChecked="";
          
        }
    
      }
});


/***************reset************/
function resetForm() {
    $('form input:not(:checkbox):not(:button):not(:submit)').val('');
    $('input#amountChkBox').prop('checked', false);
    $('form input[type=number]').val('1');
}
/***********password script**********/
const short = 0;
const noMatch = 1;
const ok = 2;

function checkPasswordReg() {
    console.log('checking');
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
    $(selector).addClass('invalid');
}
function validate(selector) {
    if ($(selector).hasClass('invalid')) {
        $(selector).removeClass('invalid');
    }
}

/**********grocery_list script*********/

let listProducts = [
    // current products in the list
];

let userLists = [
    // current lists
];

let familyLists = [
    // current lists
];

function sortByName(a, b) {
    let aName = a.name.toLowerCase();
    let bName = b.name.toLowerCase();
    return aName < bName ? -1 : aName > bName ? 1 : 0;
}

function sortByTr(a, b) {
    let aName = $(a).find('.name').text().toLowerCase();
    let bName = $(b).find('.name').text().toLowerCase();
    return aName < bName ? -1 : aName > bName ? 1 : 0;
}

function addProductToTable(product) {
    let id = product.id;
    let name = product.name;
    let amount = product.amount;
    let isChecked = product.isChecked;

    
    amount = amount == 0 ? '---' : amount;
    isChecked = isChecked === 'Y' ? 'check' : 'uncheck';

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

    if (isChecked === 'check') {
        $('table#products tbody#checkedRows').append(tr);
    } else if (isChecked === 'uncheck') {
        $('table#products tbody#uncheckedRows').append(tr);
    }
}
function addAllProducts(product) {
    let id = product.id;
    let name = product.name;


    let tr = `<tr  data-id="${id}"> 
          <td class="name d-flex justify-content-center" title="Double click to edit">${name}</td>
         
          <td class="actions ">
              <a href="#" class="btnRemoveProduct">
              <i class="fas fa-times fa-lg"></i>
              </a>
          </td>
          </tr>`;


    $('table#products tbody').append(tr);

}

function addInviteToTable(invite) {
    let familyId = invite.familyId;
    let familyName = invite.familyName;
    let senderEmail = invite.senderEmail;
    let senderId = invite.senderId;


    let tr = `<tr data-id="${familyId}">
                <td class="sender" data-id="${senderId}"><b>${senderEmail}</b></td>
                <td class="family ml-3" ><b>${familyName}</b></td>
                <td class="actions ml-3">
                
                    <span>
                        <a>
                        <button type="button" class="btn btn-success btnRequestJoin"><i class="fas fa-user-plus"></i> Request to Join</button>
                        </a>
                    </span> 
                    
                    <span class="mt-md-5 ">
                        <a>
                        <button type="button" class="btn btn-danger btnDeclineInvite"> <i class="fas fa-user-times"></i> Decline</button>
                        </a>
                    </span>
                    
                    </td>
            </tr>`;
    $('table#invites tbody').append(tr);

}

// add request to the view requests table/
function addRequestToTable(request) {
    let requestId = request.requestId;
    let senderId = request.senderId;
    let senderEmail = request.senderEmail;
    let date = request.date;


    let tr = `<tr data-id="${requestId}">
                <td class="sender" data-id="${senderId}"><b>${senderEmail}</b></td>
                <td class="date ml-3" ><b>${date}</b></td>
                <td class="actions ml-3">
                
                    <span>
                        <a><button type="button" class="btn btn-success approveBtn"><i class="fas fa-user-plus"></i> Approve</button></a>
                    </span> 
                    <span class="mt-md-5">
                        <a><button type="button" class="btn btn-danger declineBtn"> <i class="fas fa-user-times"></i> Decline</button></a>
                    </span>

                    </td>
            </tr>`;
    $('table#requests tbody').append(tr);

}

function addMemberToTable(member) {
    let id = member.id;
    let Email = member.email;
    let Nickname = member.Nickname;
    let isAdmin = $("input#isAdmin").val();


    let tr = `<tr data-id="${id}">
                <td class="email"><b>${Email}</b></td>
                <td class="nickname ml-3" ><b>${Nickname}</b></td>`;
    if (isAdmin) {
        tr += `<td class="actions ml-3">
                
                <span>
                    <a>
                    <button type="button" class="btn btn-danger btnRemoveMember"> <i class="fas fa-user-times"></i> Remove from family</button>
                    </a>
                </span>
                
                </td>`;
    }
    tr += `</tr>`;

    $('table#members tbody').append(tr);

}

$(document).ready(function () {
    /***********password script**********/

    /***************sign up script************/

    /************list script**************/

    // get the products for the list and refresh table
    function refreshProducts(listId) {
        $.ajax({
            type: 'GET',
            url: 'api/getListProducts.php',
            data: {
                listId: listId
            },
            success: function (products) {
                listProducts = [];
                if (products.length > 0) {
                    $('table#products tbody').html('');
                    for (item of products) {
                        product = {
                            id: item['id'],
                            name: item['name'],
                            amount: item['amount'],
                            isChecked: item['done']
                        };
                        // addProductToTable(product);
                        listTable.addRow(item['id'], item['name'],item['amount'],item['done']);
                        listProducts.push(product);
                    }
                    $('table tr.check input[type=checkbox]').prop('checked', true);
                } else { // TODO list is empty
                    console.log("list doesn't contain any products yet");
                }
            },
            error: function (xhr, ajaxOptions, error) {
                console.log(error);
            }
        });
    }

    function populateListsDrop(currentListId, userId, familyId) { // get the products for the list
        $.ajax({
            type: 'GET',
            url: 'api/getUserLists.php',
            data: {
                userId: userId
            },
            success: function (lists) {
                userLists = [];
                $('li div #listsDrop div #userLists').html('');
                if (lists.length !== 0) { // $('div #listsDrop div#familyLists').html('');
                    for (item of lists) {
                        let list = {
                            id: item['id'],
                            name: item['name']
                        };
                        userLists.push(list);
                        // /add list to view
                        let id = list.id;
                        let name = list.name;


                        // add Lists to navbar
                        let link = `<a class="dropdown-item" data-id="${id}" href="index.php?listId=${id}">${name}</a>`;
                        if (currentListId === null || currentListId != id) {
                            $('div #listsDrop div#userLists').append(link);
                        }

                        

                        if (currentListId !== null) { // add lists to new list selection
                            let option = `<option value="${id}">${name}</option>`;
                            $(option).appendTo('div#oldList select#oldListSelect');
                        }
                    }
                } else {

                    if (currentListId !== null) { // $('a#navbarlists').addClass('disabled'); you don't have this type of lists
                        let msg = `<span class=" dropdown-item-text text-danger px-3">No Lists where found</span>`;
                        $('div #listsDrop div#userLists').append(msg);
                    }

                }
                console.log(familyId);
                if (familyId !== null) { // get family lists
                    familyId=$(familyId).val();
                    $.ajax({
                        type: "GET",
                        url: "api/getFamilyLists.php",
                        data: {
                            familyId: familyId
                        },

                        success: function (lists) {
                            $('li div #listsDrop div #familyLists').html('');
                            if (lists.length !== 0) {

                                for (item of lists) {
                                    let list = {
                                        id: item['id'],
                                        name: item['name']
                                    };
                                    familyLists.push(list);
                                    // /add list to view
                                    let id = list.id;
                                    let name = list.name;

                                    // add family Lists to navbar
                                    let link = `<a class="dropdown-item" data-id="${id}" href="index.php?listId=${id}">${name}</a>`;
                                    if (currentListId === null || currentListId != id) {
                                        $('div #listsDrop div#familyLists').append(link);
                                    }

                                    if (currentListId !== null) { // add lists to new list selection
                                        let option = `<option value="${id}">${name}</option>`;
                                        $(option).appendTo('div#oldList select#oldListSelect');
                                    }
                                }
                            } else {
                                if (currentListId !== null) {
                                    let msg = `<span class="dropdown-item-text text-danger px-3">No Lists where found</span>`;
                                    $('div #listsDrop div#familyLists').append(msg);
                                }
                            }
                            if ($('select#oldListSelect option').length == 0) {
                                $('input#oldListChkBox').prop('disabled', true);
                            }
                        },
                        error: function (xhr, ajaxOptions, error) {
                            console.log(error);
                        }
                    });
                } else {
                    if ($('select#oldListSelect option').length == 0) {
                        $('input#oldListChkBox').prop('disabled', true);
                    }
                }

            },
            error: function (xhr, ajaxOptions, error) {
                console.log(error);
            }
        });


    }

    // initiate index page data
    function initIndexPage() {

        let userId = $('input#userId');
        let familyId = $('input#familyId');
        if (familyId.val().length == 0) {
            familyId = null;
        }
        if (userId.length != 0) {
            userId = userId.val();
            let listId = $('input#listIdIndex');
            if (listId.length != 0) {
                listId = listId.val();
                // 1- initiate the table
                refreshProducts(listId);

                // 2-populate lists combo boxes with all user's lists
                populateListsDrop(listId, userId, familyId);
            } else {
                console.log('error getting the list id');
            }
        } else {
            console.log('error getting the user id');
        }
    }

    if ($('input#listIdIndex').length !== 0) {
        initIndexPage();
    } else if ($('input#userId').length !== 0) {
        let userId = $('input#userId').val();
        let familyId = $('input#familyId');
        if (familyId.val().length == 0) {
            familyId = null;
        }
        populateListsDrop(null, userId,familyId);
    }

    $(document).on('click', 'input.btnDone', function (e) {
        let dataId = $(this).parents('tr').attr('data-id');
        const name = $(this).parents('tr').find('.name').text();
        const amount = $(this).parents('tr').find('.amount').text();

        let listId = $('input#listIdIndex').val();
        if ($(this).is(':checked')) {
            $(this).parents('tr').addClass('check');
            $(this).parents('tr').removeClass('uncheck');

            // change done property for product in DB to 'Y'
            $.ajax({
                type: 'POST',
                url: 'api/updateDoneProduct.php',
                data: {
                    listId: listId,
                    productId: dataId,
                    done: 'Y'
                },

                success: function (response) {
                    refreshProducts(listId);
                },
                error: function (xhr, ajaxOptions, error) {
                    console.log("error: product Done state wasn't updated");
                }
            });
        } else {
            $(this).parents('tr').addClass('uncheck');
            $(this).parents('tr').removeClass('check');

            // change done property for product in DB to 'N'
            $.ajax({
                type: 'POST',
                url: 'api/updateDoneProduct.php',
                data: {
                    listId: listId,
                    productId: dataId,
                    done: 'N'
                },
                success: function (response) {
                    refreshProducts(listId);
                },
                error: function (xhr, ajaxOptions, error) {
                    console.log("error: product Done state wasn't updated");
                }
            });
        }
    });

    // removing product
    $('.remove.modal').modal({backdrop: 'static', show: false});
    let rowToRemove = '';

    $(document).on('click', '.btnRemove', function () {
        $('.remove.modal').modal('show');
        rowToRemove = $(this).parents('tr');
        const productName = $(this).parents('tr').find('.name').text();

        $('.remove.modal .modal-body p').html(`You are about to delete <i>${productName}</i>`);
    });

    $('.btnRemoveConfirm').click(function () {
        $('.remove.modal').modal('hide');
        let listId = $('input#listIdIndex').val();
        rowToRemove.fadeOut(function () {
            $.ajax({
                type: 'POST',
                url: 'api/deleteProductList.php',
                data: {
                    productId: rowToRemove.data('id'),
                    listId: listId
                },
                success: function (response) {
                    listProducts = $.grep(listProducts, function (value) {
                        return value.id != rowToRemove.data('id');
                    });
                    refreshProducts();
                },
                error: function (xhr, ajaxOptions, error) {
                    console.log(error);
                }
            });
        });
    });

    // product amount check box
    $(document).on('click', '#amountChkBox', function () {
        if ($(this).is(':checked')) {
            $('div.amount').show();
        } else {
            $('div.amount').hide();
        }
    });

    // products from previous list check box
    $(document).on('click', '#oldListChkBox', function () {
        if ($(this).is(':checked')) {
            $('div#oldList').show();
        } else {
            $('div#oldList').hide();
        }
    });

    $('form#addProduct').submit(function (e) {
        e.preventDefault();
        $('span#modalMsg').empty();
        $('span#modalGoodMsg').empty();
        let name = $('#prdctName').val();
        let amount = null;
        let listId = $('input#listIdIndex').val();

        name = name.toLowerCase();

        // if product already exists in this list
        if (listProducts.some((pr) => pr.name.toLowerCase() === name)) {
            $('span#modalMsg').append('Product already exists in your list!');
            return;
        }

        if ($('#amountChkBox').is(':checked')) {
            amount = $('#prdctAmount').val();
        }

        $.ajax({
            type: 'POST',
            url: 'api/newProduct.php',
            data: {
                listId: listId,
                productName: name,
                amount: amount
            },

            success: function (response) {
                if (response === true) {
                    refreshProducts(listId);
                    $('span#modalGoodMsg').append('Product was added to list successfuly !');
                    $('form#addProduct input#prdctName').val('');
                    $('form#addProduct input#prdctAmount').val('1');
                }
            },
            error: function (xhr, ajaxOptions, error) {
                console.log(error);
            }
        });
    });

    $(' #modalAddProduct').click(function () {
        $('#submitProduct').click();
    });

    $(' button#btnAddList').click(function () {
        validate('input#listName');
        $('span#modalMsgList').empty();
        let name = $('input#listName').val();
        if (userLists.some((list) => list.name === name)) {
            console.log('list name exists for user');
            invalidate('input#listName');
            $('span#modalMsgList').append('You already have list with this name');
        } else if (familyLists.some((list) => list.name === name)) {
            console.log('list name exists for family');
            invalidate('input#listName');
            $('span#modalMsgList').append('Your family already have list with this name');
        } else {
            $('#submitList').click();
        }
    });

    /***********login script**********/

    /***********invite script**********/
    // ********************send invite *********/
    if (document.URL.includes("invites.php")) {

        let userId = null;
        if ($('input#userId').length !== 0) {
            userId = $('input#userId').val();
        }

        $('input#invitedInfo').autocomplete({

            source: function (request, response) {
                $.ajax({
                    url: 'api/getUsersForInvite.php',
                    type: 'GET',
                    data: {
                        term: request.term,
                        userId: userId
                    },
                    success: function (data) {
                        // users = [];
                        // $(data).each(function (i, user) {
                        // users.push(user['Email']);
                        // });
                        response($.map(data, function (item) {

                            return {label: item['Email'], value: item['Email'], id: item['id']};
                        }));
                    },
                    error: function (result) {
                        console.log('getUsersForInvite autocomplete Error');
                    }
                });
            },
            select: function (event, ui) { // console.log(ui.item.value);
                $("input#invitedId").val(ui.item.id); // ui.item.value contains the id of the selected label
            },

            appendTo: '#usersByMail',
            minLength: 1
        }).focus(function () {
            $(this).autocomplete('search', $(this).val());
            $('span#inviteMsg').empty();
        });

        $('input#btnSendInvite').click(function (e) {
            $('span#inviteMsg').empty();
            let invitedEmail = $('input#invitedInfo').val();
            let userId = $('input#userId').val();

            // if mail is empty
            if (invitedEmail.length < 1) {
                $('span#inviteMsg').append('Please enter the Email of the invited user');
                return;
            }


            $.ajax({
                type: 'GET',
                url: 'api/getUsersForInvite.php',
                data: {
                    term: invitedEmail,
                    userId: userId
                },

                success: function (response) {

                    if (response.length < 1) {

                        $('span#inviteMsg').append('Please Choose user from the suggested list only');
                    } else {
                        $('#submitInvite').click();
                    }
                },
                error: function (xhr, ajaxOptions, error) {
                    console.log(error);
                }
            });

        });

        // ********* view invites ***********/
        function getInvites() {
            let userId = $('input#userId').val();
            $('table#invites tbody').html('');
            $.ajax({
                type: "GET",
                url: "api/getInvites.php",
                data: {
                    userId: userId
                },
                success: function (invites) {
                    if (invites.length > 0) {
                        $('div#msgNoInvites').addClass("d-none");
                        if ($('table#invites ').hasClass("d-none")) {
                            $('table#invites ').removeClass("d-none")
                        }

                        for (item of invites) {
                            invite = {
                                senderId: item['senderId'],
                                senderEmail: item['Email'],
                                familyId: item['familyId'],
                                familyName: item['name']

                            };

                            addInviteToTable(invite);
                            // listProducts.push(product);
                        }
                    } else { // no new invitations

                        $('table#invites ').addClass("d-none");
                        if ($('div#msgNoInvites').hasClass("d-none")) {
                            $('div#msgNoInvites').removeClass("d-none")
                        }
                    }
                },
                error: function (xhr, ajaxOptions, error) {
                    console.log(error);
                }
            });
        };
        getInvites();


        $(document).on('click', 'button.btnRequestJoin', function (e) {


            let familyId = $(this).parents('tr').attr('data-id');
            let userId = $('input#userId').val();
            let senderId = $(this).parents('tr').find('.sender').attr('data-id');


            $.ajax({
                type: "POST",
                url: "api/updateInvite.php",
                data: {
                    senderId: senderId,
                    sendedTo: userId,
                    familyId: familyId,
                    approved: 'Y'

                },

                success: function (response) {
                    // console.log(response);
                    // if (response == "updated") {
                    $.ajax({
                        type: 'POST',
                        url: 'api/newRequest.php',
                        data: {
                            familyId: familyId,
                            userId: userId
                        },
                        success: function (response) {

                            getInvites();
                        },
                        error: function (xhr, ajaxOptions, error) {
                            console.log(error);
                        }
                    });
                    // }
                },
                error: function (xhr, ajaxOptions, error) {
                    console.log(error);
                }
            });


        });


        $(document).on('click', 'button.btnDeclineInvite', function (e) {

            let familyId = $(this).parents('tr').attr('data-id');
            let userId = $('input#userId').val();
            let senderId = $(this).parents('tr').find('.sender').attr('data-id');
            $.ajax({
                type: "POST",
                url: "api/updateInvite.php",
                data: {
                    senderId: senderId,
                    sendedTo: userId,
                    familyId: familyId,
                    approved: 'N'
                },
                success: function (response) {
                    console.log(response);
                    getInvites();
                },
                error: function (xhr, ajaxOptions, error) {
                    console.log(error);
                }
            });

        });

    }
    // ********* join requests *******/
    // *****view requests*****/
    if (document.URL.includes("requests.php")) {

        function getRequests() {
            let adminId = $('input#userId').val();
            $('table#requests tbody').html('');
            $.ajax({
                type: "GET",
                url: "api/getRequests.php",
                data: {

                    adminId: adminId
                },

                success: function (requests) {
                    if (requests.length > 0) {
                        $('div#msgNoRequests').addClass("d-none");
                        if ($('table#requests ').hasClass("d-none")) {
                            $('table#requests ').removeClass("d-none")
                        }

                        for (item of requests) {

                            request = {
                                requestId: item['id'],
                                senderId: item['userId'],
                                senderEmail: item['Email'],
                                date: item["date"]

                            };

                            addRequestToTable(request);

                        }
                    } else { // no new requests

                        $('table#requests ').addClass("d-none");
                        if ($('div#msgNoRequests').hasClass("d-none")) {
                            $('div#msgNoRequests').removeClass("d-none")
                        }
                    }
                },
                error: function (xhr, ajaxOptions, error) {
                    console.log(error);
                }
            });
        }
        getRequests();

        $(document).on('click', 'button.approveBtn', function (e) {

            let requestId = $(this).parents('tr').attr('data-id');
            let reqStatus = 'Y';
            let senderId = $(this).parents('tr').find('.sender').attr('data-id');
            let familyId = $('input#familyId').val();
            updateRequest(requestId, reqStatus, senderId, familyId)
        });

        $(document).on('click', 'button.declineBtn', function (e) {

            let requestId = $(this).parents('tr').attr('data-id');
            let reqStatus = 'N';
            let senderId = $(this).parents('tr').find('.sender').attr('data-id');
            let familyId = $('input#familyId').val();
            updateRequest(requestId, reqStatus, senderId, familyId)

        });

        function updateRequest(requestId, reqStatus, userId, familyId) {
            $.ajax({
                type: "POST",
                url: "api/updateRequest.php",
                data: {
                    requestId: requestId,
                    reqStatus: reqStatus,
                    userId: userId,
                    familyId: familyId
                },

                success: function (response) {
                    getRequests();
                    // remove request row from requests list
                    // TODO
                },
                error: function (xhr, ajaxOptions, error) {
                    console.log(error);
                }
            });
        }
    }

    // ********send request***********/
    if (document.URL.includes("sendRequest.php")) {
        let userId = $('input#userId').val();

        $('input#familyName').autocomplete({

            source: function (request, response) {
                $.ajax({
                    url: 'api/getFamiliesByName.php',
                    type: 'GET',
                    data: {
                        term: request.term,
                        userId: userId
                    },
                    success: function (data) {
                        // users = [];
                        // $(data).each(function (i, user) {
                        // users.push(user['Email']);
                        // });
                        response($.map(data, function (item) {

                            return {label: item['name'], value: item['name'], id: item['id']};
                        }));
                    },
                    error: function (result) {
                        console.log('getFamilyNames autocomplete Error');
                    }
                });
            },
            select: function (event, ui) { // console.log(ui.item.value);
                $("input#familyId").val(ui.item.id); // ui.item.value contains the id of the selected label
            },

            appendTo: '#familySuggest',
            minLength: 1
        }).focus(function () {
            $(this).autocomplete('search', $(this).val());
            $('span#requestMsg').empty();
        });


        $('input#btnSendRequest').click(function (e) {

            $('span#requestMsg').empty();
            let familyName = $('input#familyName').val();


            // if family name is empty
            if (familyName.length < 1) {
                $('span#requestMsg').append('Please choose family you would like to join');
                return;
            }

            $.ajax({
                type: 'GET',
                url: 'api/getFamiliesByName.php',
                data: {
                    term: familyName,
                    userId: userId
                },

                success: function (response) {

                    if (response.length < 1) {

                        $('span#requestMsg').append('Please Choose family from the suggested list only');
                    } else {
                        $('#submitRequest').click();
                    }
                },
                error: function (xhr, ajaxOptions, error) {
                    console.log(error);
                }
            });

        });

    }
    // ****** view family members *****/
    if (document.URL.includes("familyMembers.php")) {
        function getFamilyMembers() {
            let familyId = $('input#familyId').val();
            $('table#members tbody').html('');
            $.ajax({
                type: "GET",
                url: "api/getFamilyMembers.php",
                data: {

                    familyId: familyId
                },

                success: function (members) {
                    if (members.length > 0) {
                        $('div#msgNoMembers').addClass("d-none");
                        if ($('table#members ').hasClass("d-none")) {
                            $('table#members ').removeClass("d-none")
                        }

                        for (item of members) {
                            Nickname = item['Nickname'] === null ? "---" : item['Nickname'];
                            member = {
                                id: item['id'],
                                email: item['Email'],
                                Nickname: Nickname

                            };

                            addMemberToTable(member);

                        }
                    } else { // no new members

                        $('table#members ').addClass("d-none");
                        if ($('div#msgNoMembers').hasClass("d-none")) {
                            $('div#msgNoMembers').removeClass("d-none")
                        }
                    }
                },
                error: function (xhr, ajaxOptions, error) {
                    console.log(error);
                }
            });
        }
        getFamilyMembers();
    }


    // ************products list***********/
    if (document.URL.includes("productsList.php")) {
        function getAllProducts() {
            let userId = $('input#userId').val();
            let familyId = $('input#familyId').val();
            $('table#products tbody').html('');
            $.ajax({
                type: "GET",
                url: "api/getAllDoneProductsForUser.php",
                data: {
                    userId: userId,
                    familyId: familyId
                },

                success: function (products) {
                    if (products.length > 0) {
                        $('div#msgNoProducts').addClass("d-none");
                        if ($('table#products ').hasClass("d-none")) {
                            $('table#products').removeClass("d-none")
                        }

                        for (item of products) {

                            product = {
                                id: item['id'],
                                name: item['name']
                            };

                            addAllProducts(product);

                        }
                    } else { // no new members

                        $('table#products ').addClass("d-none");
                        if ($('div#msgNoProducts').hasClass("d-none")) {
                            $('div#msgNoProducts').removeClass("d-none")
                        }
                    }
                },
                error: function (xhr, ajaxOptions, error) {
                    console.log(error);
                }
            });
        }
        getAllProducts();

        $(document).on("dblclick", "table#products td.name", function (e) {
            e.stopPropagation();
            let currentEle = $(this);
            let value = $(this).html();

            updateVal(currentEle, value);
        });

        function updateVal(currentEle, value) {
            $(currentEle).html('<input class="thVal form-control col-6 py-3 text-center" type="text" value="' + value + '" />');
            let thVal = $(".thVal");
            let id = $(currentEle).parents('tr').attr('data-id');
            thVal.focus();
            thVal.keyup(function (event) {
                if (event.keyCode == 13) {
                    $(currentEle).html(thVal.val());

                    save(id, thVal.val());
                }
            });

            thVal.focusout(function () {
                let id = $(this).parents('tr').attr('data-id');
                $(currentEle).html(thVal.val().trim());
                return save(id, thVal.val());
            });

        }

        function save(id, value) {
            $.ajax({
                type: "POST",
                url: "api/updateProductName.php",
                data: {
                    id: id,
                    newName: value
                },

                success: function (response) {
                    getAllProducts();
                },
                error: function (xhr, ajaxOptions, error) {
                    console.log(error);
                }
            });
        }
    }
});
//*****reset password****/
if (document.URL.includes("resetPassword.php")) {

    //   function sendEmail() {
         
    //       let email = $("#EmailLogin");
      

    //       if ( isNotEmpty(email) ) {
    //           $.ajax({
    //              url: '../sendMail.php',
    //              method: 'POST',
    //              dataType: 'json',
    //              data: {
                     
    //                  email: email.val(),
                    
    //              }, success: function (response) {
    //                   if (response.status == "success")
    //                       alert('Email Has Been Sent!');
    //                   else {
    //                       alert('Please Try Again!');
    //                       console.log(response);
    //                   }
    //              }
    //           });
    //       }
    //   }

      function isNotEmpty(caller) {
          if (caller.val() == "") {
              caller.css('border', '1px solid red');
              return false;
          } else
              caller.css('border', '');

          return true;
      }

      $(document).on('click','input#btnSendReset',function (e) {
        console.log("at least");
        let email = $("#EmailLogin");
      

        if ( isNotEmpty(email) ) {
            $("input#submitReset").click();
        }else{
            console.log("else");
        }
      });
    }
