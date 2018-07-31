/* check and insert number of item */
var start = readCookie('incart');
if (start) {
    $('#numbCart').html(start);
    $('#itemCarts').html(start);
} else {
    $('#numbCart').html(0);
    $('#itemCarts').html(0);
}


/* add Item to cart */
$(".addToCard").live('click', function() {
    var isThis = $(this);
    var id_pro = isThis.attr('data-id');
    var name_pro = isThis.attr('data-title');
    var price_pro = parseInt(isThis.attr('data-price'));
    var quantity = parseInt($("#quantity").val());
    var note_order = $("#note_order").val();
    var tcost = quantity * price_pro;
    var option_add = $('input[name=addOpt]:checked').val();
    var option_list = $('input[name=listOpt]:checked').val();

    //TOTAL CART
    isThis.html('<i class="fa fa-spinner fa-spin"></i> Loading...');
    setTimeout(function() {
        isThis.html('<i class="fa fa-shopping-cart"></i> Added');
        isThis.addClass('disable');
    }, 500);
    $.ajax({
        data: {},
        url: '/ajax/create_json.php?proid=' + id_pro + '&qual=' + quantity + '&price=' + price_pro + '&cost=' + tcost + '&option_add=' + option_add + '&option_list=' + option_list + '&name_pro=' + name_pro + '&note=' + note_order,
        type: 'GET',
        success: function(data) {
            $('#currentCart').html(data);
        }
    })
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
    var itemDel = $(this).attr('data-id');
    var itemCost = $(this).parent().parent().parent().next().next().find('.qtyNumb').val();
    $.ajax({
        data: {},
        url: '/ajax/modify_json.php?proid=' + itemDel + '&qual=' + itemCost,
        type: 'GET',
        success: function(data) {
            alert('update already');
        }
    })
});

/* remove Item from cart */
$('.removeItem').live('click', function() {
    var itemDel = $(this).attr('data-id');
    var itemCost = $(this).parent().parent().parent().next().next().find('.qtyNumb').val();
    $(this).parent().parent().parent().parent().remove();
    $.ajax({
        data: {},
        url: '/ajax/edit_json.php?proid=' + itemDel + '&qual=' + itemCost,
        type: 'GET',
        success: function(data) {

        }
    })
});