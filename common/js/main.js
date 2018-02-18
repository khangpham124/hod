$(window).scroll(function() {
    var sT = $(window).scrollTop();
    var vWrap = $('#wrapper').offset().top;
    var vFoot = $('#pageTop').offset().top;
    var h_btot = $('#pageTop').height();
    var h_foot = $('#footer').height();
    var outFix = h_btot + h_foot + 100;
    var vInfix = vFoot - 450;
    if ((sT >= vWrap) && (sT < vInfix)) {
        $(".followBox").addClass("fixedFollow");
    } else if (sT < vWrap) {
        $(".followBox").removeClass("fixedFollow");
    }
});

$('.menuCircle').click(function() {
    $(this).toggleClass('active');
    $('#menuSP').slideToggle(200);
    $('body').toggleClass('layer');
    if ($('body').hasClass("layer")) {
        $('.menuOver').animate({
            left: "0"
        }, 300);
    } else {
        $('.menuOver').animate({
            left: "-100%"
        }, 300);
    }
});

$('.closeBtn').click(function() {
    $('#menuSP').slideUp(200);
    $('body').toggleClass('layer');
});

$('.hassub').click(function() {
    $(this).find('ul').slideToggle(200);
    $(this).toggleClass('active');
});

$('.chatFb').click(function() {
    $('#ztb-fbc-show-widget').trigger('click');
});

$('.iconLogin').click(function() {
    $('.boxRegis').fadeToggle(200);
});


$("#chose2").click(function() {
    if ($("#chose2").prop("checked", true)) {
        $('.popupLogin').fadeIn(200);
        $('.overlay_regis').fadeIn(200);
    }
});

$('.inputRadio input').click(function() {
    $('.inputRadio input').parent().removeClass('chosen');
    $(this).parent().addClass('chosen');
});

$('.whaton').click(function() {
    $('#popupEvent').fadeToggle(200);
    $('.overlay_regis').fadeIn(200);
});

$('.btnRegis').click(function() {
    $('.popupRegister').fadeOut(200);
    $('.popupLogin').fadeIn(200);
    $('.overlay_regis').fadeIn(200);
});

function closPop() {
    $('.popupRegister').fadeOut(200);
    $('.popupLogin').fadeOut(200);
    $('.overlay_regis').fadeOut(200);
    $('#popupCart').fadeOut(100);
    $('#popupEvent').fadeOut(100);
    $('#currentCart').fadeOut(100);
}

$('.linkRegis').click(function() {
    $('.overlay_regis').fadeIn(200);
    $('.popupRegister').fadeIn(200);
    $('.boxRegis').fadeOut(200);
});

$('.overlay_regis').click(function() {
    closPop();
});

$('.contBtn').live('click', function() {
    closPop();
});

$('.closeBtn').live('click', function() {
    closPop();
});

$(".submitRegis").click(function() {
    $(".formRegis").submit(function(e) {
        //$("#simple-msg").html("<img src='loading.gif'/>");
        var postData = $(this).serializeArray();
        var formURL = 'http://heartofdarknessbrewery.com/ajax/register.php';
        $.ajax({
            url: formURL,
            type: "POST",
            data: postData,
            success: function(data, textStatus, jqXHR) {
                $('.popupRegister').html(data);
            },
        });
        e.preventDefault(); //STOP default action
        e.unbind();
    });
});

$('.listFeature__btn').click(function() {
    $('#popupCart').fadeIn(200);
    $('.overlay_regis').fadeIn(200);
    var d_cart = $(this).attr('data-id');
    $('#popupCart').html('<div class="taC"><img src="http://heartofdarknessbrewery.com/common/img/other/load.gif" alt=""></div>');
    $.ajax({
        data: {},
        url: '/ajax/loadPro.php?addtocart=' + d_cart,
        type: 'GET',
        success: function(data) {
            $('#popupCart').html(data);
        }
    })
});


$('.viewCart').click(function() {
    $('#currentCart').fadeIn(200);
    $('.overlay_regis').fadeIn(200);
    $('#currentCart').html('<div class="taC"><img src="http://heartofdarknessbrewery.com/common/img/other/load.gif" alt=""></div>');
    $.ajax({
        data: {},
        url: '/ajax/currentCart.php',
        type: 'GET',
        success: function(data) {
            $('#currentCart').html(data);
        }
    })
});

$("#submitLogin").click(function() {
    $(".formLogin").submit(function(e) {
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax({
            url: formURL,
            type: "POST",
            data: postData,
            success: function(data, textStatus, jqXHR) {
                $('#messageLogin').html(data);
                setTimeout(location.reload.bind(location), 500);
            },
        });
        e.preventDefault(); //STOP default action
        e.unbind();
    });
});

$('#framePoster').live('change', function() {
    var v_label = $(this).val();
    var imgEmbed = $('#p_'+ v_label).text();
    $('#thumbImg').attr('src',imgEmbed);
});