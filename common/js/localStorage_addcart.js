/* check and insert number of item */
var listhang = [];

if (localStorage.getItem("cart_Hod") !== null) {
    var numbItems = localStorage.getItem("cart_Hod");
    var countItem = JSON.parse(numbItems);
    var tt_item = 0;
    countItem.map(item => {
        let key = Object.keys(item);
        tt_item += item[key].quantity;
    })
    $('#numbCart').html(tt_item);
    $('#itemCarts').html(tt_item);
}


/* add Item to cart */
$(".addToCard").live('click', function() {
    var isThis = $(this);
    var id_pro = isThis.data('id');
    var price_pro = parseInt(isThis.attr('data-price'));
    var quantity = parseInt($("#quantity").val());
    var note_order = $("#note_order").val();
    var addOpt = $('#hide_addOpt').val();
    var choseOpt = $('#hide_listOpt').val();

    //TOTAL CART
    var tcost = quantity * price_pro;
    isThis.html('<i class="fa fa-spinner fa-spin"></i> Loading...');
    setTimeout(function() {
        isThis.html('<i class="fa fa-shopping-cart"></i> Added');
        isThis.addClass('disable');
    }, 500);
    var info = {};
    info[id_pro] = {
        'quantity': quantity,
        'cost': tcost,
        'add': addOpt,
        'chose': choseOpt,
        'note_order': note_order
    }
    listhang.push(info);
    localStorage.setItem('cart_Hod', JSON.stringify(listhang));
    var numbItems = localStorage.getItem("cart_Hod");
    var countItem = JSON.parse(numbItems);
    var tt_item = 0;
    countItem.map(item => {
        let key = Object.keys(item);
        tt_item += item[key].quantity;
    })
    $('#numbCart').html(tt_item);
    $('#itemCarts').html(tt_item);
});





/* increase ITEM */
$(".button").click(function() {
    var $button = $(this);
    var oldValue = $button.parent().find("input").val();
    if ($button.attr("rel") == '+') {
        var newVal = parseFloat(oldValue) + 1;
    } else {
        if (oldValue > 0) {
            var newVal = parseFloat(oldValue) - 1;
        } else {
            newVal = 0;
        }
    }
    $('.updateBtn').removeClass('disable');
    $button.parent().find("input").val(newVal);
    var dg = $(this).parent().parent().parent().prev().find('.priceNumb').val();
    var calc = parseInt(dg) * parseInt(newVal);
    var numb_calc = parseInt(calc);
    $(this).parent().parent().parent().next().find('.qtyPro .totalNumb').val(numb_calc);
});

/* Update cart */
$('.updateBtn').live('click', function() {
    var totalcart = 0;
    $('.tblCart tbody tr').each(function() {
        elm = $(this).find('.qtyNumb');
        var id_cookie = elm.attr('id');
        var cookie_val = elm.val();
        eraseCookie(id_cookie);
        createCookie(id_cookie, cookie_val, 2);

        eraseCookie('totalcart');
        totalcart += Number(elm.val());
        createCookie('totalcart', totalcart, 2);
        $('#numbCart').html(totalcart);
        $('.updateBtn').addClass('disable');
    });
    var totalcost = 0;
    $('.tblCart tbody tr').each(function() {
        elm2 = $(this).find('.subTotal').find('.totalNumb');
        eraseCookie('totalCost');
        totalcost += Number(elm2.val());
        createCookie('totalCost', totalcost, 2);
    });
});

/* remove Item from cart */
$('.removeItem').live('click', function() {
    var itemDel = $(this).attr('data-id');
    var itemCost = $(this).parent().parent().parent().next().next().next().find('.totalNumb').val();
    var qtyDel = readCookie(itemDel);
    var curr_qty = readCookie('totalcart');
    var update_qty = curr_qty - qtyDel;
    var totalcost = readCookie('totalCost');
    var new_totalcost = totalcost - itemCost;
    eraseCookie(itemDel);
    eraseCookie('totalCost');
    createCookie('totalcart', update_qty, 2);
    createCookie('totalCost', new_totalcost, 2);
    $('#numbCart').html(update_qty);
    $(this).parent().parent().parent().parent().remove();
});