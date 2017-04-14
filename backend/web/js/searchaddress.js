
// Create the search box and link it to the UI element.
var input = document.getElementById('address');
var searchBox = new google.maps.places.SearchBox(input);


// Listen for the event fired when the user selects a prediction and retrieve
// more details for that place.
searchBox.addListener('places_changed', function () {
    var places = searchBox.getPlaces();
    console.log(places)
    if (places.length == 0) {
        return;
    }

});

