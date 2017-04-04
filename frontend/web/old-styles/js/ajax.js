/**
 * Created by comp3 on 20.11.2016.
 */
var url = window.location.pathname;
var language = url.split('/')[1];

$(document).ready(function(){

    $('#send_comment').click(function () {

        $('#comment_area').parent().removeClass('has-error');

        var user_id = $('#user_id').val();
        var product_id = $('#product_id').val();
        var comment = $('#comment_area');

        if(comment.val().trim() != ""){
            $.ajax({
                url: '/' + language + "/product/add-comment",
                type:'post',
                data:{
                    userId:user_id,
                    productId:product_id,
                    comment:comment.val()
                },
                success:function(data){
                    if(data == 1){
                        comment.val(' ');
                        $.ajax({
                            url: '/' + language + "/product/refresh-comments",
                            type:'post',
                            data:{
                                productId:product_id
                            },
                            success:function(data){
                               $('.comment_show_area').html(data);
                            }

                        })
                    }
                }
            })
        }else{
            $('#comment_area').parent().addClass('has-error');
        }
    })
});
