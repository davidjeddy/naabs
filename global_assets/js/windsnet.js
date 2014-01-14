/**
 * Windsnet wireless network access web application
 * application javascript
 */
<!--//
//AJAX process function
/**
 * Execute AJAX call using passed in data
 */
function ajax() {

return true;
}

// Form submit logic
$(document).on("submit", "form", function(e) {
	console.log( 'form submited');

	// Prevent default	
	e.preventDefault();

	//if the form is 'sign in', validate both fields are populated.
	if ( $(this).attr('id') == "sign_in") {

		console.log( 'user signing in.');
	}
	
	return true;
});

// Form button actions
$(document).on("click", "button.submit", function(e) {
	console.log( 'btn.submit clicked');

	$(this).closest('form').trigger('submit');

	return true;
});

$(document).on("click", "button.next", function(e) {
	console.log( 'btn.next clicked');
	
	return true;
});

$(document).on("click", "button.clear", function(e) {
	console.log( 'btn.clear clicked');
	
	$(this).closest( 'form' )[0].reset();

	$.scrollto( '0%', 250);

	return true;
});

// BootBox listeners and callbacks
$(document).on("click", ".alert", function(e) {

    bootbox.alert("Hello world!", function() {
        console.log("Alert Callback");
    });
});
-->