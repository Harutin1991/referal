// bootstrap wizard//
$(".validation-form").bootstrapValidator({
    fields: {
        'User[username]': {
            validators: {
                notEmpty: {
                    message: 'The username is required'
                }
            },
            required: true,
            minlength: 3
        },
        'User[role]': {
            validators: {
                notEmpty: {
                    message: 'The type of account is required'
                }
            },
            required: true,
            minlength: 3
        },
        'User[password]': {
            validators: {
                notEmpty: {},
//                identical: {
//                    field: 'confirmPassword',
//                    message: 'The password and its confirm are not the same'
//                },
                different: {
                    field: 'username',
                    message: 'The password cannot be the same as username'
                }
            }
        },
        'User[email]': {
            validators: {
                notEmpty: {
                    message: 'The email address is required'
                },
                emailAddress: {
                    message: 'The input is not a valid email address'
                }
            }
        },
        'User[first_name]': {
            validators: {
                notEmpty: {
                    message: 'The first name is required and cannot be empty'
                }
            }
        },
        'User[last_name]': {
            validators: {
                notEmpty: {
                    message: 'The last name is required and cannot be empty'
                }
            }
        },
    }
});
$('#rootwizard').bootstrapWizard({
    'tabClass': 'nav nav-pills',
    'onNext': function (tab, navigation, index) {
        var $validator = $('.validation-form').data('bootstrapValidator').validate();
        return $validator.isValid();
    },
    onTabClick: function (tab, navigation, index) {
        return true;
    },
    onTabShow: function (tab, navigation, index) {
        var $total = navigation.find('li').length;
        var $current = index + 1;
        var $percent = ($current / $total) * 100;
        console.log($total, $current)
        // If it's the last tab then hide the last button and show the finish instead
        if ($current >= $total) {
            $('#rootwizard').find('.pager .next').hide();
            $('#rootwizard').find('.pager .create').show();
            $('#submit_user-create').show();
            $('#rootwizard').find('.pager .create').removeClass('disabled');
        } else if ($current < $total) {
            $('#rootwizard').find('.pager .next').show();
            $('#rootwizard').find('.pager .create').hide();
            $('#rootwizard').find('.pager .update').hide();
        }
        // $('#rootwizard #user_create').click(function () {
        //var $validator = $('.validation-form').data('bootstrapValidator').validate();
        //$('.bv-hidden-submit').click();
        // console.log(123)
        // document.getElementById("user-create").submit();
        //});
//        $('#rootwizard .update').click(function () {
//
//        });

    }});
var table = $('#table').DataTable({
    'dom': '<"wrapper"liftp>',
    'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, 'All']],
});
