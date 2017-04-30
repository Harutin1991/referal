$(document).ready(function () {

//     $('.mobile-menu .mobile-menu-article .button-m-menu').on('click',function(){
//        $( ".mobile-menu .mobile-menu-article .m-menu" ).toggle();
//     });

//     $('.mobile-menu .mobile-menu-article .m-menu .sub-m-menu').on('click',function(e){
//         e.preventDefault();
//        $(this).toggleClass('showMenu');
//     });
//    var range1 = $('#input-range1'),
//    value1 = $('#range-value1');
//
//    value1.html(range1.attr('value') + ' $');
//
//    range1.on('input', function () {
//        value1.html(this.value + ' $');
//    });
//
//    var range2 = $('#input-range2'),
//            value2 = $('#range-values2');
//
//    value2.html(range2.attr('value') + ' $');
//
//    range2.on('input', function () {
//        value2.html(this.value2 + ' $');
//    });

    $(function () {
        $('.scrollTop').bind("click", function () {
            $('html, body').animate({scrollTop: 0}, 1200);
            return false;
        });
    });

    $("#registrationModela").click(function(){
        $(".login").toggleClass("loginActive");
    });  

function imageUpload(e) {
    "use strict";
    var form;
    form = new FormData(document.getElementById("myDropzone"))
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        async: true,
        processData: false,
        contentType: false,
        data: form,
        dataType: "json",
        url: "/admin-panel/dist/js/ajax/image.upload.php",
        beforeSend: function() {
            $('#myDropzone').find('div#myDropzoneImagesLoading').removeClass('none');
            $('#myDropzone').find('div#myDropzoneImagesSortable').addClass('none');
        },
        success: function(response) {
            var complete = false,path;
            if(response.response_status==='200') {
                var data = $('#myDropzone').find('input[name="data"]').val();
                var vid = $('#myDropzone').find('input[name="vid"]').val();
                if(vid==='-1') {
                    path = 'tinymce';
                } else {
                    path = 'photo';
                }
                for (var i = 0; i < response.response.length; i++) {
                    if(response.response[i].error==='') {
                        $('#myDropzoneImagesSortable').append('<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 dz-image dz-processing dz-image-preview dz-complete"><div class="img-responsive-container"><img src="/images/'+path+'/small/'+response.response[i].name+'" class="img-responsive" data-dz-thumbnail width="400" height="300"></div><a href="javascript:void(0);" class="dz-remove none btn-custom" data-dz-remove="'+data+'" data-dz-name="'+response.response[i].name+'" onclick="imageDelete(null,'+vid+',true,$(this));">'+$('.dictRemoveFile').html()+'</a><a href="javascript:void(0);" class="none btn-custom" onclick="imageSortable($(this),true);">'+$('.dictMakeMain').html()+'</a></div>');
                        data = (data*1)+1;
                        $('#myDropzone').find('input[name="data"]').val(data);
                    } else {
                        //error show
                    }
                    if((i+1)===response.response.length) {
                        complete = true;
                    }
                }
            } else if(response.response_status==='100') {
                $('#myDropzoneImagesSortable').find('.col-xs-12').each(function() {
                    $(this).remove();
                });
                $('#myDropzone').find('div#myDropzoneImagesLoading').addClass('none');
                $('#myDropzone').find('div#myDropzoneImagesSortable').removeClass('none');
                $('#myDropzone').find('div#myDropzoneImagesError').removeClass('none');
            } else if(response.response_status==='101') {
                $('#myDropzoneImagesSortable').find('.col-xs-12').each(function() {
                    $(this).remove();
                });
                $('#myDropzone').find('div#myDropzoneImagesLoading').addClass('none');
                $('#myDropzone').find('div#myDropzoneImagesSortable').removeClass('none');
                $('#myDropzone').find('div#myDropzoneImagesErrorType').removeClass('none');
            } else {
                complete = true;
            }
            if(complete===true) {
                $('#myDropzone').find('div#myDropzoneImagesLoading').addClass('none');
                $('#myDropzone').find('div#myDropzoneImagesSortable').removeClass('none');
                setTimeout(function() {
                    setSortableHeight();
                }, 1000);
            }
        }
    });  
}
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-img").change(function () {
        readURL(this);
    });
	$(".avatar .box img").click(function(){
        var img_src = $(this).attr('src');
        console.log(img_src);
        var avatar_src = $('#profile-img-tag').attr('src',img_src);
    });

    // $(".table-striped tr td .change").click(function(e){
    //     var input = $(this).find(".table-striped tr td .changeable").val();
    //     alert(input);
    // })
    $('.table-striped tr td .change').click(function () {

        // var $this = $(this).parent().parent().find('input');
        // $this.is(":visible") ? $this.attr('disabled', 'disabled') : $this.removeAttr('disabled');
        // var name = $(this).parent().parent().find('input').removeAttr('disabled').toggleClass('inputactive');

        if ($(this).parent().parent().find('input').attr('disabled')) {
            $($(this).parent().parent().find('input')).addClass("inputactive");
            $(this).parent().parent().find('input').removeAttr('disabled');
            $(this).find('i').addClass('fa-check').removeClass('fa-pencil');
        } else {
            $($(this).parent().parent().find('input')).removeClass("inputactive");
            $(this).parent().parent().find('input').attr('disabled', 'disabled');
            $(this).find('i').addClass('fa-pencil').removeClass('fa-check');
        }

    });
    $(".menu-opener").click(function(){
      $(".menu-opener, .menu-opener-inner, .menu").toggleClass("active");
    });

});








