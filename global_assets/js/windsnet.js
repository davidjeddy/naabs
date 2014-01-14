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
	console.log( 'button.submit clicked');
	
	// Get form elem
	var form = $(this).closest('form');

	// Is the form currently client valid?
	if ( form.valid() != true ) {
		console.log( 'form not valid.');
		return false;
	}

	//Do the AJAX call with all the form data

	return true;
});

$(document).on("click", "button.next", function(e) {
	console.log( 'button.next clicked' );
	
	// Get form elem
	var form = $(this).closest('form');

	// Is the form currently client valid?
	if ( form.valid() != true ) {
		console.log( 'form not valid.');
		return false;
	}

	// Serialize data
	var form_data = form.serialize();

	//write data to a cookie
	$.cookie('windsnet_'+form.attr('name'), form_data);

	// relocate to the forms 'action' property
	window.location = "./"+form.attr('action');

	return true;
});

$(document).on("click", "button.clear", function(e) {
	console.log( 'btn.clear clicked');

	// Reset Val	
	var form = $(this).closest( 'form' );
	form[0].reset();

	// Clear valitation errors
	var form_val = form.validate();
	form_val.resetForm();

	//scroll to the top of the page if possible
	//$().scrollto( '0%', 250);

	return true;
});

// BootBox listeners and callbacks
$(document).on("click", ".alert", function(e) {

    bootbox.alert("Hello world!", function() {
        console.log("Alert Callback");
    });
});
-->