/**
 * naads application javascript
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

			if ( typeof(data.callback) !== "undefined" ) {

				// Display the message generated on the server side as a bootbox.alert()
			    bootbox.alert(data.text, function() {
					// Go where the form wants us to
					window.location.href = data.url;
			    });

			// Callback method to execute on ajax.success
 			} else if ( typeof(data.url) !== "undefined" ) {
				// Go where the form wants us to
				window.location.href = data.url;
			}

		} else {
			console.log('data bad: ');
			console.log(data);
			bootbox.alert(data.text, function() {});
		}
    });

    promise.error(function(data) {
		console.log("promise.error: ");
		console.log(data);


    });

    promise.complete(function(){
		console.log("promise.complete");
		$("body").removeClass("loading");
    });

    return true;
}

/**
 * Print the contents of a element
 *
 * @author http://stackoverflow.com/questions/2255291/print-the-contents-of-a-div
 * @modified David J Eddy <me@davidjeddy.com>
 * @param string data [required]
 * @return boolean
 */
function printDiv(data) {
	console.log( "printDiv stated.");

    var mywindow = window.open('', 'Sale Receipt', 'height=600s,width=800');

	mywindow.document.write('<!DOCTYPE html><html><head><title>Sales Receipt</title>');
    mywindow.document.write('<link rel="stylesheet" href="../global_assets/css/reset.css" type="text/css" />');
    mywindow.document.write('<link rel="stylesheet" href="../global_assets/css/print.css" type="text/css" />');
    mywindow.document.write('</head><body>'+data+'<body></html>');

    mywindow.print();
    mywindow.close();

    return true;
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
$(document).on("click", "button.clear", function(e) {
	console.log( 'btn.clear clicked');

	// Reset Val	
	var form = $(this).closest( 'form' );
	form[0].reset();

	// Clear valitation errors
	var form_val = form.validate();
	form_val.resetForm();

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



// Bootbox sales receipt `view`
$(document).on("click", "button.print", function(e) {
	console.log("Receipt bootbox called.")

	var print_source = $(this).data("source");

	print_source = $(print_source).html();

	printDiv(print_source);

	return true;
});



// Custom jQ validator method
jQuery.validator.addMethod("lettersandspace", function(value, element) {
  return this.optional(element) || /^[ a-z]+$/i.test(value);
}, "Letters and spaced only please"); 
-->