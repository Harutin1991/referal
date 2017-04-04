 $(document).ready(function(){
    $(function () {
        $('.scrollTop i').bind("click", function () {
            $('html, body').animate({ scrollTop: 0 }, 1200);
            return false;
        });
    });

    $(".menu-m-btn i").click(function(){
        $(".menu-m").toggle();
    });

});








