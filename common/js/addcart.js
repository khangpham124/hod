var start = readCookie('totalcart');
 if (start) {
     $('#numbCart').html(start);
 } else {
     $('#numbCart').html(0);
 }

var count = 0;
 $(".addToCard").live('click', function() {
     var isThis = $(this);
     var id_pro = isThis.attr('data-id');
     var quantity = parseInt($("#quantity").val());
     var curr = parseInt($('#numbCart').text());
     var total = curr + quantity;
     
     isThis.html('<i class="fa fa-spinner fa-spin"></i> Loading...');
     setTimeout(function() {
        isThis.html('<i class="fa fa-shopping-cart"></i> Added');
        isThis.addClass('disable'); 
     }, 500);
     
     $("#numbCart").html(total);
    createCookie('cart_' + id_pro, quantity, 2);
    createCookie('totalcart',total, 2);
 });

$(".button").live('click', function() {
    var $button = $(this);
    var oldValue = $button.parent().find("input").val();
    if ($button.attr("rel") == '+') {
  	  var newVal = parseFloat(oldValue) + 1;
  	} else {
	   // Don't allow decrementing below zero
      if (oldValue > 0) {
        var newVal = parseFloat(oldValue) - 1;
	    } else {
        newVal = 0;
      }
	  }
    $button.parent().find("input").val(newVal);
  });