/**
 * Windsnet wireless network access web application
 * application javascript
 */
<!--//
// Sign up/in listeners
$(document).on("submit", "form", function(e) {
	console.log( 'form submited');

	return true;
});

$(document).on("click", "button.submit", function(e) {
	console.log( 'btn.submit clicked');
	$( this ).closest( 'form' )[0].reset();
});

$(document).on("click", "button.next", function(e) {
	console.log( 'btn.next clicked');
	$( this ).closest( 'form' )[0].reset();
});

$(document).on("click", "button.clear", function(e) {
	console.log( 'btn.clear clicked');
	$( this ).closest( 'form' )[0].reset();
});



// BootBox listeners and callbacks
$(document).on("click", ".alert", function(e) {

    bootbox.alert("Hello world!", function() {
        console.log("Alert Callback");
    });

});
-->