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
	//current products in the list
];

let userLists = [
	//current lists
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

	console.log('amount=' + amount);
	console.log('amount==0?' + (amount == 0));
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

$(document).ready(function () {
	/***********password script**********/

	/***************sign up script************/

	/************list script**************/

	//get the products for the list and refresh table
	function refreshProducts(listId) {
		$.ajax({
			type: 'GET',
			url: 'api/getListProducts.php',
			data: {
				listId: listId,
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
							isChecked: item['done'],
						};

						addProductToTable(product);
						listProducts.push(product);
					}
					$('table tr.check input[type=checkbox]').prop('checked', true);
				} else {
					//TODO list is empty
					console.log("list doesn't contain any products yet");
				}
			},
			error: function (xhr, ajaxOptions, error) {
				console.log(error);
			},
		});
	}

	function populateListsDrop(currentListId, userId) {
		//get the products for the list
		$.ajax({
			type: 'GET',
			url: 'api/getUserLists.php',
			data: {
				userId: userId,
			},
			success: function (lists) {
				userLists = [];
				if (lists.length !== 0) {
					$('li div #lists').html('');
					for (item of lists) {
						list = { id: item['id'], name: item['name'] };
						userLists.push(list);
						///add list to view
						let id = list.id;
						let name = list.name;

						//add Lists to navbar
						let link = `<a class="dropdown-item" data-id="${id}" href="index.php?listId=${id}">${name}</a>`;
						if (currentListId != id) {
							$('div #listsDrop').append(link);
						}
						//add lists to new list selection
						let option = `<option value="${id}">${name}</option>`;
						$(option).appendTo('div#oldList select#oldListSelect');
					}
				} else {
					// lists is empty disable check box
					$('input#oldListChkBox').prop('disabled', true);
				}
			},
			error: function (xhr, ajaxOptions, error) {
				console.log(error);
			},
		});
	}

	//initiate index page data
	function initIndexPage() {
		let userId = $('input#userIdIndex');
		if (userId.length != 0) {
			userId = userId.val();
			let listId = $('input#listIdIndex');
			if (listId.length != 0) {
				listId = listId.val();
				//1- initiate the table
				refreshProducts(listId);

				//2-populate lists combo boxes with all user's lists
				populateListsDrop(listId, userId);
			} else {
				console.log('error getting the list id');
			}
		} else {
			console.log('error getting the user id');
		}
	}

	initIndexPage();

	$(document).on('click', 'input.btnDone', function (e) {
		let dataId = $(this).parents('tr').attr('data-id');
		const name = $(this).parents('tr').find('.name').text();
		const amount = $(this).parents('tr').find('.amount').text();

		let listId = $('input#listIdIndex').val();
		if ($(this).is(':checked')) {
			$(this).parents('tr').addClass('check');
			$(this).parents('tr').removeClass('uncheck');

			//change done property for product in DB to 'Y'
			$.ajax({
				type: 'POST',
				url: 'api/updateDoneProduct.php',
				data: {
					listId: listId,
					productId: dataId,
					done: 'Y',
				},

				success: function (response) {
					refreshProducts(listId);
				},
				error: function (xhr, ajaxOptions, error) {
					console.log("error: product Done state wasn't updated");
				},
			});
		} else {
			$(this).parents('tr').addClass('uncheck');
			$(this).parents('tr').removeClass('check');

			//change done property for product in DB to 'N'
			$.ajax({
				type: 'POST',
				url: 'api/updateDoneProduct.php',
				data: {
					listId: listId,
					productId: dataId,
					done: 'N',
				},
				success: function (response) {
					refreshProducts(listId);
				},
				error: function (xhr, ajaxOptions, error) {
					console.log("error: product Done state wasn't updated");
				},
			});
		}
	});

	//removing product
	$('.remove.modal').modal({
		backdrop: 'static',
		show: false,
	});
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
					listId: listId,
				},
				success: function (response) {
					listProducts = $.grep(listProducts, function (value) {
						return value.id != rowToRemove.data('id');
					});
					refreshProducts();
				},
				error: function (xhr, ajaxOptions, error) {
					console.log(error);
				},
			});
		});
	});

	//product amount check box
	$(document).on('click', '#amountChkBox', function () {
		if ($(this).is(':checked')) {
			$('div.amount').show();
		} else {
			$('div.amount').hide();
		}
	});

	//products from previous list check box
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

		//if product already exists in this list
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
				amount: amount,
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
			},
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
		} else {
			$('#submitList').click();
		}
	});

	/***********login script**********/
	/***********invite script**********/

	$('#invitedInfo')
		.autocomplete({
			source: function (request, response) {
				$.ajax({
					url: 'api/getUsersByEmail.php',
					type: 'GET',
					data: { term: request.term },
					success: function (data) {
						// users = [];
						// $(data).each(function (i, user) {
						// 	users.push(user['Email']);
						// });
						response(
							$.map(data, function (item) {
								
								return {
									label: item['Email'],
									value: item['Email'],
									id: item['id']
								};
							})
						);
					},
					error: function (result) {
						console.log('getUsersByEmail autocomplete Error');
					},
				});
			},
			select: function (event, ui) {
				// console.log(ui.item.value);
				$("input#invitedId").val(ui.item.id);  // ui.item.value contains the id of the selected label
			},

			appendTo: '#usersByMail',
			minLength: 1,
		})
		.focus(function () {
			$(this).autocomplete('search', $(this).val());
		});
});
