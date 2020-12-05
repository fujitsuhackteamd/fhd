window.onload = function() {
	navigator.geolocation.getCurrentPosition(reflect_position);
}

function reflect_position(position) {
	document.getElementById( "address_x" ).value = position.coords.longitude ;
	document.getElementById( "address_y" ).value = position.coords.latitude ;
}
