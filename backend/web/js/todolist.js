var url = window.location.pathname;
var language = url.split('/')[1];
$(document).ready(function () {
    $("form#main_input_box").submit(function (event) {
        event.preventDefault();
        var packageId = $('#package_id').val();
        var message = $('#custom_textbox').val();
        $.ajax({
            url: '/' + language + '/packages/create-package-message',
            method: 'post',
            data: {message: message, packageId: packageId},
            success: function (res) {
                var obj = JSON.parse(res);
                if (obj.success) {
                    var deleteButton = " <a href='javascript:void(0)' onclick='deleteMessage("+obj.messageID+")' class='tododelete redcolor'><span class='glyphicon glyphicon-trash'></span></a>";
                    var striks = " | ";
                    var editButton = "<a href='javascript:void(0)' onclick='editMessage("+obj.messageID+")' id='edit_button_"+obj.messageID+"' class='todoedit'><span class='glyphicon glyphicon-pencil'></span></a>";
                    var checkBox = "<p><input type='checkbox' class='striked ' autocomplete='off' /></p>";
                    var twoButtons = "<div class='col-md-4 col-sm-4 col-xs-4  pull-right showbtns todoitembtns'>" + editButton + striks + deleteButton + "</div>";

                    $(".list_of_items").append("<div class='todolist_list showactions list1' id='todolist_list_"+obj.messageID+"'>  " + "<div class='col-md-8 col-sm-8 col-xs-8 nopadmar custom_textbox1'>" + "<div class='todotext todoitemjs'>" + $("#custom_textbox").val() + "</div> </div>" + twoButtons);
                    $("#custom_textbox").val('');
                }
            }
        });
    });

});

$(document).on('click', '.striked', function (e) {
    $(this).closest('.todolist_list').find('.todotext').toggleClass('strikethrough');
    $(this).closest('.todolist_list').find('.showbtns').toggle();
});

$(document).on('click', '.todoedit .glyphicon-pencil', function (e) {
    e.preventDefault();
    var text = '';
    text = $(this).closest('.todolist_list').find('.todotext').text();
    text = "<input type='text' name='text' value='" + text + "' onkeypress='return event.keyCode != 13;' />";
    $(this).closest('.todolist_list').find('.todotext').html(text);
    //$(this).html("<span class='glyphicon glyphicon-saved'></span> <span class='hidden-xs'></span>");
    $(this).removeClass('glyphicon-pencil').addClass('glyphicon-saved hidden-xs');
});

function editMessage(messageID) {
    if ($('#edit_button_'+messageID).find('span.glyphicon').hasClass('glyphicon-saved')){
        var text1 = $('#todolist_list_' + messageID).find("input[type='text'][name='text']").val();
        if (text1 === '') {
            alert('Come on! you can\'t create a todo without title');
            $('#todolist_list_' + messageID).find("input[type='text'][name='text']").focus();
            return;
        }
        $.ajax({
            url: '/' + language + '/packages/edit-package-message',
            method: 'post',
            data: {message: text1, messageId: messageID},
            success: function (res) {
                var obj = JSON.parse(res);
                if (obj.success) {
                    $('#todolist_list_' + messageID).find('.todotext').html(text1);
                    $('#edit_button_' + messageID).removeClass('glyphicon-saved hidden-xs').addClass('glyphicon-pencil');
                }
            }
        });
    }
}

function deleteMessage(messageID){
        $.ajax({
        url: '/' + language + '/packages/delete-package-message',
        method: 'post',
        data: {messageID: messageID},
        success: function (res) {
            var obj = JSON.parse(res);
            if (obj.success) {
                $('#todolist_list_'+messageID).hide("slow", function () {
                    $('#todolist_list_'+messageID).remove();
                });
            }
        }
    });
}