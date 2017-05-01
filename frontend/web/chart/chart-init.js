$(document).ready(function () {
    $("#circle1").circliful({
        animation: 1,
        animationStep: 5,
        showPercent: 1,
        backgroundColor: '#fff',
        foregroundColor: '#e7b907',
        fontColor: '#000',
        percent: 75,
        //iconColor: '#e7b907',
        //icon: 'f206',
        //iconSize: '40',
        iconPosition: 'middle',
        text: '1856 зарегистрировано участников',
        foregroundBorderWidth: 6,
        backgroundBorderWidth: 6,
    });
	$('#circle1 .circliful').css({
		"backgroundImage":"url('./image/counter/img-06.png')",
		"backgroundSize":"contain" 
	});
/*	$('#circle1').append($('<img>', { 
	//backgroundImage: "url('./image/counter/img-02.png')",
		src : "./image/counter/img-02.png", 
		width : "100%", 
		height : "auto", 
		alt : "Test Image", 
		title : "Test Image"
	})); */

    $("#circle2").circliful({
        animation: 1,
        animationStep: 5,
        showPercent: 0,
        backgroundColor: '#fff',
        foregroundColor: '#e7b907',
        fontColor: '#000',
        percent: 75,
        //iconColor: '#e7b907',
        //icon: 'f206',
        //iconSize: '40',
        iconPosition: 'middle',
        text: '1600 активных участников',
        foregroundBorderWidth: 6,
        backgroundBorderWidth: 6,
    });
	$('#circle2 .circliful').css({
		"backgroundImage":"url('./image/counter/img-07.png')",
		"backgroundSize":"contain" 
	});

    $("#circle3").circliful({
        animation: 1,
        animationStep: 5,
        start: 2,
        showPercent: 0,
        backgroundColor: '#fff',
        foregroundColor: '#e7b907',
        fontColor: '#000',
        percent: 75,
        //iconColor: '#e7b907',
        //icon: 'f206',
        //iconSize: '40',
        iconPosition: 'middle',
        text: '3560 приглашеных участников',
		foregroundBorderWidth: 6,
        backgroundBorderWidth: 6,
    });
	$('#circle3 .circliful').css({
		"backgroundImage":"url('./image/counter/img-08.png')",
		"backgroundSize":"contain" 
	});

    $("#circle4").circliful({
        animation: 1,
        animationStep: 5,
        start: 2,
        showPercent: 1,
        backgroundColor: '#fff',
        foregroundColor: '#e7b907',
        fontColor: '#000',
        percent: 75,
        //iconColor: '#e7b907',
        //icon: 'f206',
        //iconSize: '40',
        iconPosition: 'middle',
        text: '65000 инвестировано',
		foregroundBorderWidth: 6,
        backgroundBorderWidth: 6,
    });
	$('#circle4 .circliful').css({
		"backgroundImage":"url('./image/counter/img-09.png')",
		"backgroundSize":"contain" 
	});
    $("#circle5").circliful({
        animation: 1,
        animationStep: 5,
        start: 2,
        showPercent: 0,
        backgroundColor: '#fff',
        foregroundColor: '#e7b907',
        fontColor: '#000',
        percent: 75,
        //iconColor: '#e7b907',
        //icon: 'f206',
        //iconSize: '40',
        iconPosition: 'middle',
        text: '99000 заработано',
 foregroundBorderWidth: 6,
        backgroundBorderWidth: 6,
    });
	$('#circle5 .circliful').css({
		"backgroundImage":"url('./image/counter/img-10.png')",
		"backgroundSize":"contain" 
	});
});