$(".addToCard").click(function() {
    var isThis = $(this);
    var id_pro = isThis.attr('data-id');
    var quantity = $("#quantity").val();
    var data = {
        'addtocart': id_pro,
        'qual': quantity,
    };
    $.ajax({
        data: data,
        url: 'http://heartofdarknessbrewery.com/?addtocart',
        type: 'POST',
        dataType: 'json',
        beforeSend: function() {
            isThis.html('<i class="fa fa-spinner fa-spin"></i> Loading...');
        },
        success: function(html) {
            isThis.html('<i class="fa fa-check-circle-o"></i> Added!');
            $("#numbCart").html(html.tongSoLuong);
            setTimeout(function() {
                isThis.html('<i class="fa fa-shopping-cart"></i> add to cart');
            }, 500)
        }
    })
    return false;
})