window.onload = function() {
	navigator.geolocation.getCurrentPosition(reflect_position);
}

function reflect_position(position) {
	document.getElementById( "address_x" ).value = position.coords.longitude ;
	document.getElementById( "address_y" ).value = position.coords.latitude ;
}
function form_switch(){
    check = document.getElementsByClassName('online_or_visit');
        if (check[0].checked) {
			document.getElementById( "checklist" ).style.display = "none";
        } else if (check[1].checked) {
            document.getElementById( "checklist" ).style.display = "block";
        } else {
            document.getElementById( "checklist" ).style.display = "none";
        }
    // window.addEventListener('load', form_switch());
}