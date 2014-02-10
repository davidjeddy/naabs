/**
 * Windsnet wireless network access web application
 * application javascript
 */
<!--//
//AJAX process function
/**
 * Execute AJAX call
 *
 * @author David J Eddy <me@davidjeddy.com>
 * @version 0.0.1
 * @since 0.0.2
 * @date 2014-01-15
 * @param string type [optional]
 * @param string data [optional]
 * @param string method [optional]
 * @param string action [optional]
 * @return boolean
 */
function ajaxCall(type, data, dataType, action) {
	console.log( 'ajax function called' );

	if ( typeof('type') == 'undefined' ) 	{ type 	= "POST"; } 
	if ( typeof('data') == 'undefined' ) 	{ data 	= "NULL"; }
	if ( typeof('dataType') == 'undefined' ){ dataType= "JSON"; } 
	if ( typeof('action') == 'undefined' )  { action= ""; } 



    var promise = $.ajax({ type: type, data: data, dataType: dataType, url: "../controllers/base_class.php" });

    promise.success(function(data) {
		console.log("promise.success");

		if (data.bool === true) {
			console.log('data good: ');

			if ( typeof(data['url']) !== "undefined" ){
				// Go where the form wants us to
				window.location.href = data['url'];
			}

			return true;
		} else {
			console.log('data bad: ');
			console.log(data);

			return false;
		}
        return true;
    });

    promise.error(function(data) {
		console.log("promise.error: ");
		console.log(data);

        return false;
    });

    promise.complete(function(){
		console.log("promise.complete");

		return true;
    });
}


// Form submit logic
$(document).on("submit", "form", function(e) {
	console.log( 'form submited');
	var form = $(this);

	// Prevent default	
	e.preventDefault();


	//Do the AJAX call with all the form data
	ajaxCall("post", form.serialize(), "JSON");
	

	return true;
});

// Form button actions
$(document).on("click", "button.clear", function(e) {
	console.log( 'btn.clear clicked');

	// Reset Val	
	var form = $(this).closest( 'form' );
	form[0].reset();

	// Clear valitation errors
	var form_val = form.validate();
	form_val.resetForm();

	//scroll to the top of the page if possible
	$().scrollto( '0%', 250);

	return true;
});

$(document).on("click", "button.submit", function(e) {
	console.log( 'button.submit clicked');

	// Get form elem
	var form = $(this).closest('form');

	// Is the form currently client valid?
	if ( form.valid() != true ) {
		console.log( 'form not valid.');
		return false;
	} else {
		form.trigger('submit');
	}

	return true;
});



// BootBox listeners and callbacks
$(document).on("click", ".alert", function(e) {

    bootbox.alert("Hello world!", function() {
        console.log("Alert Callback");
    });
});
-->