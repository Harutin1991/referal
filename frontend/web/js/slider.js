var fromStep = 0;
var $range1 = $("#range_1"), $range2 = $("#range_2"), $range3 = $("#range_3"), $range4 = $("#range_4"),
        slider1, slider2, slider3, slider4;
var slider1_values = [
    10, 20, 40,
    80, 160, 320,
    640, 1280, 2560,
    5120
];
var slider2_values = [1, 2, 3,
    4, 5, 6,
    7, 8, 9,
    10];
var slider3_values = [1, 2, 3,
    4, 5, 6,
    7, 8, 9,
    10];
var create1 = function () {
    $("#range_1").ionRangeSlider({
        grid: true,
        values: slider1_values,
        type: 'single',
        hasGrid: true,
        onStart: function (data) {
            fromStep = data.from;
            $('#range-value1').html(data.from_value);
            create2(data.from);
            calculate(data.from_value,$('#range-value2').html());
        },
        onChange: function (data) {
            $('#range-value1').html(data.from_value);
            fromStep = data.from;
        },
        onFinish: function (data) {
            fromStep = data.from;
            update2(data.from);
            calculate(data.from_value,$('#range-value2').html());
        },
        onUpdate: function (data) {
            fromStep = data.from;
            update2(data.from);
        }
    });
    slider1 = $range1.data("ionRangeSlider");
}

var update1 = function () {
    slider1 && slider1.update({
        values: [
            1, 2, 3,
            4, 5, 6,
            7, 8, 9,
            10
        ],
        type: 'single',
        hasGrid: true,
        onStart: function (data) {
            $('#range-value1').html(data.from_value);
            update2(data.from);
        },
        onChange: function (data) {
            $('#range-value1').html(data.from_value);
        },
        onFinish: function (data) {
            update2(data.from);
           calculate($('#range-value1').html(),$('#range-value2').html(),$('#range-value3').html(),$('#range-value4').html());
        },
        onUpdate: function (data) {
            $('#range-value1').html(data.from_value);
        }
    });
}

var create2 = function (from) {
    $range2.ionRangeSlider({
        grid: true,
        from: from,
        from_min: from,
        values: [
            1, 2, 3,
            4, 5, 6,
            7, 8, 9,
            10
        ],
        type: 'single',
        hasGrid: true,
        onStart: function (data) {
            $('#range-value2').html(data.from_value);
        },
        onChange: function (data) {
            $('#range-value2').html(data.from_value);
        },
        onFinish: function (data) {
        },
        onUpdate: function (data) {
        }
    });
    slider2 = $range2.data("ionRangeSlider");
}
var update2 = function (from) {
    slider2 && slider2.update({
        from: from,
        from_min: slider2_values[from - 1],
        values: [
            1, 2, 3,
            4, 5, 6,
            7, 8, 9,
            10
        ],
        type: 'single',
        hasGrid: true,
        onStart: function (data) {
            $('#range-value2').html(data.from_value);
        },
        onChange: function (data) {
            $('#range-value2').html(data.from_value);
        },
        onFinish: function (data) {
            $('#range-value2').html(data.from_value);
            update3(data.from);
            calculate($('#range-value1').html(),$('#range-value2').html(),$('#range-value3').html(),$('#range-value4').html());
        },
        onUpdate: function (data) {
            $('#range-value2').html(data.from_value);
        }
    });
}
$(document).ready(function () {
    create1();
    create2(fromStep);
});
function create3(from) {
    console.log(from)
    $('#range_3').ionRangeSlider({
        grid: true,
        from: from,
        from_min: from,
        values: slider3_values,
        type: 'single',
        hasGrid: true,
        onStart: function (data) {
            // fromStep = data.from;
            $('#range-value3').html(data.from_value);
        },
        onChange: function (data) {
            $('#range-value3').html(data.from_value);
        },
        onFinish: function (data) {
            // update(data.from);
        },
        onUpdate: function (data) {
            //  update(data.from);
        }
    });
    slider3 = $range3.data("ionRangeSlider");
}
function update3(from) {
    slider3 && slider3.update({
        from: slider3_values[from - 1],
        from_min: slider3_values[from - 1],
        values: slider3_values,
        type: 'single',
        hasGrid: true,
        onStart: function (data) {
            // fromStep = data.from;
            $('#range-value3').html(data.from_value);
        },
        onChange: function (data) {
            $('#range-value3').html(data.from_value);
        },
        onFinish: function (data) {
            $('#range-value3').html(data.from_value);
            console.log(123)
            calculate($('#range-value1').html(),$('#range-value2').html(),$('#range-value3').html(),$('#range-value4').html());
        },
        onUpdate: function (data) {
            $('#range-value3').html(data.from_value);
        }
    });

}
function create4() {
    $('#range_4').ionRangeSlider({
        grid: true,
        min: 0,
        max: 100,
        type: 'single',
        hasGrid: true,
        onStart: function (data) {
            // fromStep = data.from;
            console.log(data)
            $('#range-value4').html(data.from);
        },
        onChange: function (data) {
            $('#range-value4').html(data.from);
        },
        onFinish: function (data) {
            $('#range-value4').html(data.from);
            calculate($('#range-value1').html(),$('#range-value2').html(),$('#range-value3').html(),$('#range-value4').html());
        },
        onUpdate: function (data) {
            $('#range-value4').html(data.from);
        }
    });
    slider4 = $range4.data("ionRangeSlider");
}
function update4(from) {
    slider4 && slider4.update({
        min: 0,
        max: 100,
        type: 'single',
        hasGrid: true,
        onStart: function (data) {
            // fromStep = data.from;
            $('#range-value4').html(data.from_value);
        },
        onChange: function (data) {
            $('#range-value4').html(data.from_value);
        },
        onFinish: function (data) {
            $('#range-value4').html(data.from_value);
            calculate($('#range-value1').html(),$('#range-value2').html(),$('#range-value3').html(),$('#range-value4').html());
        },
        onUpdate: function (data) {
            $('#range-value4').html(data.from_value);
        }
    });

}
function changePackage(package_name) {
    if (package_name == "classic") {
        $('#package_range_3').css('display', 'none');
        $('#package_range_4').css('display', 'none');
        $('.description-calc').css('padding','0px 25px 0px 25px');
        $('.description-calc').hide();
        update1();
        update2(0);
    } else if (package_name == "silver") {
        $('#package_range_3').css('display', 'block');
        $('#package_range_4').css('display', 'block');
        $('.description-calc').show();
        $('.description-calc').css('padding','10px 25px 55px 25px');  
        slider1_values = [
            50, 100, 200,
            400, 800, 1600,
            3200, 6400, 12800,
            25600
        ];
        create3(0);
        create4();
        slider1 && slider1.update({
            values: slider1_values,
            type: 'single',
            hasGrid: true,
            onStart: function (data) {
                $('#range-value1').html(data.from_value);
                create3(data.from);
            },
            onChange: function (data) {
                $('#range-value1').html(data.from_value);
            },
            onFinish: function (data) {
                console.log('finish:' + data.from)
                update3(data.from);
                update2(data.from);
                calculate(data.from_value,$('#range-value2').html(),$('#range-value3').html(),$('#range-value4').html());
            },
            onUpdate: function (data) {
                $('#range-value1').html(data.from_value);
                console.log('update:' + data.from)
                update3(data.from);
                update2(data.from);
            }
        });

        //$('#range_4')
    } else {

    }
}

function calculate(range1,range2,range3,range4){
    var result = 0;
    var aditional = 0;
    console.log(range1,range2,range3,range4)
    if(!range3 && !range4){
        result = parseInt(range1) *  parseInt(range2) * 2;
    }else{
        result = parseInt(range1) *  parseInt(range2) * 2;
        aditional = ((parseInt(range4) * parseInt(range1)) * 30) / 100;
        result += aditional;
    }
    $('#calculation_result').html(result+'$')
    $('#calculate_button').hide();
    $('#calculation_button').show();
}