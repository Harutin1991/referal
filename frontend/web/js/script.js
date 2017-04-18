 $(document).ready(function(){

//     $('.mobile-menu .mobile-menu-article .button-m-menu').on('click',function(){
//        $( ".mobile-menu .mobile-menu-article .m-menu" ).toggle();
//     });

//     $('.mobile-menu .mobile-menu-article .m-menu .sub-m-menu').on('click',function(e){
//         e.preventDefault();
//        $(this).toggleClass('showMenu');
//     });
    var range = $('.input-range'),
      value = $('.range-value');

    value.html(range.attr('value') + ' $');

    range.on('input', function() {
      value.html(this.value + ' $');
    });

    var range = $('.input-range'),
      value = $('.range-values');

    value.html(range.attr('value') + ' $');

    range.on('input', function() {
      value.html(this.value + ' $');
    });

    $(function () {
        $('.scrollTop').bind("click", function () {
            $('html, body').animate({ scrollTop: 0 }, 1200);
            return false;
        });
    });

    $(".contact").click(function(e) { 
        e.preventDefault(); 
        $('html, body').animate({
            scrollTop: $(".article-contact-us").offset().top
        }, 1500);         
    });


    $('.map').click(function () {
        $('.map iframe').css("pointer-events", "auto");
    });
    
    $( ".map" ).mouseleave(function() {
      $('.map iframe').css("pointer-events", "none"); 
    });
  


});








