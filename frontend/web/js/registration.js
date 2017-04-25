/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Create the search box and link it to the UI element.
var input = document.getElementById('signupform-address');
var searchBox = new google.maps.places.SearchBox(input);
var componentForm = {
    address: 'long_name',
    city: 'long_name',
 //   state: 'short_name',
    country: 'long_name',
    postal: 'short_name',
};

// Listen for the event fired when the user selects a prediction and retrieve
// more details for that place.
searchBox.addListener('places_changed', function () {
    var places = searchBox.getPlaces();
    var place = places[0];
    console.log(place.address_components)
    if (places.length == 0) {
        return;
    } else if (places.length > 0) {
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (addressType == 'locality') {
                addressType = 'city';
            } else if (addressType == 'administrative_area_level_1') {
                addressType = 'state';
            } else if (addressType == 'route') {
                addressType = 'address';
            } else if (addressType == 'postal_code') {
                addressType = 'postal';
            }
            if (componentForm[addressType]) {

                if (addressType != "street_number") {
                    var val = place.address_components[i][componentForm[addressType]];
                    if (addressType !== "address") {
                        console.log(addressType)
                        document.getElementById(addressType).value = val;
                    } else {
                        $("#address").val($("#address").val() + val);
                    }
                    if (addressType == 'state') {
                        var val_2 = place.address_components[i]['long_name'];
                        if (val !== val_2 && val_2 !== '') {
                            console.log(addressType)
                            document.getElementById(addressType).value = val + ', ' + val_2;
                        }
                    }
                } else {
                    var val_street_number = place.address_components[i][componentForm[addressType]];
                    $("#address").val(val_street_number + ' ' + $("#address").val());
                }
            }
        }
    }

});



function changeFlag(element) {
    console.log(element.value);
    var selected = $(this).find('option:selected');
    if (selected.data('phonecode')) {
        $('.flags')
                .attr('src', '../flags/' + selected.data('iso') + '.png')
                .css({'display': 'block'});
        $('.phone').val('+' + selected.data('phonecode'));
        $('select.country').css({'padding-left': '33px'});
    } else {
        $('.phone').val('');
        $('.flags')
                .css({'display': 'none'})
                .attr('src', '');
        $('select.country').css({'padding-left': '15px'});
    }
}