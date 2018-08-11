/* check and insert number of item */
var start = readCookie('incart');
if (start) {
    $('.numbCart').html(start);
} else {
    $('.numbCart').html(0);
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
        $('.checkOut').removeClass('unshow');
        $('.checkOut').addClass('showsp');
    }, 500);
    $.ajax({
        data: {},
        url: '/ajax/create_json.php?proid=' + id_pro + '&qual=' + quantity + '&price=' + price_pro + '&cost=' + tcost + '&option_add=' + option_add + '&option_list=' + option_list + '&name_pro=' + name_pro + '&note=' + note_order,
        type: 'GET',
        success: function(data) {
            var start = readCookie('incart');
            $('.numbCart').html(start);
        }
    })
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
            var start = readCookie('incart');
            $('.numbCart').html(start);
        }
    })
});


$('.methodPay').click(function() {
    var methodPay = readCookie('methodPay');
    var noteOrder = $('#note_order').val();
    createCookie('noteOrder', noteOrder, 24);
    if (methodPay == 'cod') {
        window.location = ('http://heartofdarknessbrewery.com/confirm/');
    } else if (methodPay !== null) {
        $.ajax({
            data: {},
            url: '/ajax/feeCharge.php',
            type: 'GET',
            success: function(data) {
                window.location = (data);
                // window.open(data)
            }
        })
    } else if (methodPay == null) {
        alert('Please choose a payment method');
    }
});