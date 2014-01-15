<?php require_once "../config.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once SITEROOT."/templates/top.php"; ?>
</head>

<body>
    <noscript>
        <h3>This service requires javascript to be enabled.</h3>
        <h4>Please turn it on in your browser and refresh the page for proper operation.</h4>
    </noscript>

    <?php require_once SITEROOT."/templates/top_menu.php"; ?>

    <!--// Page title -->
    <h3>Sign Up</h3>
    <h5>Step 3 of 3 : Purchase / Confirmation</h5>

    <!--// 3 step sign up process: general, address, billing option -->
    <form name="sign_up_3" id="sign_up_3" action="../controllers/base_class.php">

        <div class="well well-lg">
            <h3>Account&nbsp;<small><a href="./sign_up.php" target="_self">change</a></small></h3>
            <div id="account_data"></div>
        </div>

        <div class="well well-lg">
            <h3>Billing&nbsp;<small><a href="./sign_up_2.php" target="_self">change</a></small></h3>
            <div id="billing_data"></div>
        </div>

        <!--// hidden data containers, makes processing the form easier -->
        <div id="form_fields"></div>

        <?php require_once SITEROOT."/templates/form_enter.php"; ?>

    </form>
    <?php require_once SITEROOT."/templates/bottom.php"; ?>

    <!--// Add some addition methods to the valitor -->
    <script src="<?= SITEHOME; ?>global_assets/js/jquery_validate/dist/additional-methods.js"></script>

    <!--// form validation -->
    <script language="javascript">
        $( document ).ready(function() {
            // Return to page you came from if the cookie data is not set
            if (
                typeof($.cookie('windsnet_sign_up_1')) == "undefined"
                || typeof($.cookie('windsnet_sign_up_2')) == "undefined"
            ) {
                window.location = -1;
            }



            // Accont data
            var account_elem = $("#account_data");
            var account_data = $.cookie('windsnet_sign_up_1');
            account_data = jQuery.unserialize(account_data);
            
            // Billing data
            var billing_elem = $("#billing_data");
            var billing_data = $.cookie('windsnet_sign_up_2');
            billing_data = jQuery.unserialize(billing_data);



            // What action is the form doing? Append to this all form data as well.
            var form_fields_elems_string = "<input type=\"hidden\" name=\"action\" value=\"add_user\" />";

            // Print out data as 'Account' and 'Billing' elem
            var account_data_string = "";
            $.each( account_data, function(key, value){
                // Ignore repeat_* fields
                if ( key.substr(0,7) == "repeat_" ) {
                    return;
                }

                form_fields_elems_string += "<input type=\"hidden\" name=\""+key+"\"value=\""+value+"\" />";

                // Hide p/w from visible sight
                if (key == "password") {
                    value = "*****";
                }

                // Concatinate  k/v pairs into the DOM
                account_data_string += "<h4>"+convertFieldNames(key)+":&nbsp;<small>"+value+"</small></h4>";
            });

            account_elem.append(account_data_string);



            // Billing data elem: #billing_data
            var billing_data_string = "";
            $.each( billing_data, function(key, value){
                form_fields_elems_string += "<input type=\"hidden\" name=\""+key+"\"value=\""+value+"\" />";

                // Converts seconds to hours
                if (key == "service_duration") {

                    // Use the DDL in step 2. 
                    switch(value) {
                    case "86400":
                        value = "One day; for the amount of $5.95 USD";
                        break;
                    case "604800":
                        value = "One Week for the amount of $11.95 USD";
                        break;
                    case "18144000":
                        value = "One Month (30 days) for the amount of $24.95 USD";
                        break;
                    case "54432000":
                        value = "Three Months (90 days) for the amount of $74.85 USD";
                        break;
                    default:
                        value = "Could not determine selected acces length.";
                    }
                }

                // Hide CC # from visible sight
                if (key == "card_number") {
                    value = "*****"+value.substr(12,16);
                }

                // Concatinate  k/v pairs into the DOM
                billing_data_string += "<h4>"+convertFieldNames(key)+":&nbsp;<small>"+value+"</small></h4>";
            });
            billing_elem.append(billing_data_string);

            // Append form field
            $( "#form_fields" ).append(form_fields_elems_string);
        });
    </script>
</body>
</html>