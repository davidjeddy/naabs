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
    <h5>Step 2 of 3 : Service &amp; Payment Processing</h5>

    <!--// 3 step sign up process: general, address, billing option -->
    <form>

        <div class="well well-lg">
            <h3>Service</h3>
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Duration</span>
                <select class="form-control" name="service_duration">
                    <option value="NULL"        >Select One</option>
                    <option value="86400"       >One Day ($5.95 USD)</option>
                    <option value="604800"      >One Week ($11.95 USD)</option>
                    <option value="18144000"    >One Month (30 days, $24.95 USD)</option>
                    <option value="54432000"    >Three Month (90 days, $74.85 USD)</option>
                </select>
            </div>

            <!--// Version 2 will have an option for the number of devices -->
            <!--//
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Device Count</span>
                <select class="form-control" name="device_count">
                    <option>Select One</option>
                    <option value="1"   >1</option>
                    <option value="2"   >2</option>
                    <option value="3"   >3</option>
                    <option value="4"   >4</option>
                    <option value="5"   >5</option>
                </select>
            </div>
            --> 
        </div>

        <div class="well well-lg">
            <h3>Billing Information</h3>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Name</span>
                <input type="text"    class="form-control" placeholder="First"  name="first_name">
                <input type="text"    class="form-control" placeholder="Last"   name="last_name">
            </div>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Billig</br>Address</span>
                <input type="text"    class="form-control" placeholder="Street"   name="line1">
                <input type="text"    class="form-control" placeholder="City"       name="city">
                <input type="text"    class="form-control" placeholder="State"      name="state">
                <input type="text"    class="form-control" placeholder="ZIP"        name="zip">
                <input type="hidden"  class="form-control" placeholder="Country"    name="country" value="US">
            </div>


            <div class="input-group input-group-lg">
                <span class="input-group-addon">Card Number</span>
                <input type="text"    class="form-control" placeholder="Card Number"  name="card_number">
            </div>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Card Type</span>
                <select class="form-control" name="card_type">
                    <option>Select One</option>
                    <option value="mastercard">Mastercard</option>
                    <option value="visa">Visa</option>
                </select>
            </div>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Exp. date</span>
                <select class="form-control" name="card_expire_month">
                    <option value="NULL">Select Month</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
                <!--// Automat this to include this year and then +4 more -->
                <select class="form-control" name="card_expire_year">
                    <option value="NULL">Select Yesar</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                </select>
            </div>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">CVV2</span>
                <input type="text"    class="form-control" placeholder="CVV2"  name="card_cvv2">
            </div>
        </div>

        <input type="hidden" name="action" value="create_user">;
        <?php require_once SITEROOT."/templates/form_next.php"; ?>
    </form>

    <?php require_once SITEROOT."/templates/bottom.php"; ?>

    <!--// Add some addition methods to the valitor -->
    <script src="<?= SITEHOME; ?>global_assets/js/jquery_validate/dist/additional-methods.js"></script>

    <!--// form validation -->
    <script language="javascript">
        $( document ).ready(function() {
            // Return to page you came from if the cookie data is not set
            if ( $.cookie('sign_up_1') == "" ) {
                window.history.back();
            }

            $("#sign_up_2").validate({
                rules: {
                    "service_duration": {
                        required: true,
                        integer: true,
                    },
                    "device_count": {
                        required: true,
                        integer: true,
                    },
                    "first_name": {
                        required: true,
                        lettersonly: true,
                    },
                    "last_name": {
                        required: true,
                        lettersonly: true,
                    },
                    "street_1": {
                        required: true,
                    },
                    "city": {
                        required: true,
                    },
                    "state": {
                        required: true,
                        lettersonly: true,
                        minlength: 2,
                        maxlength: 2
                    },
                    "zip": {
                        required: true,
                        integer: true,
                        minlength: 5,
                        maxlength: 5
                    },
                    "card_number": {
                        required: true,
                        integer: true,
                        minlength: 15,
                    },
                    "card_type": {
                        required: true,
                        lettersonly: true,
                    },
                    "card_expire_month": {
                        required: true,
                        integer: true,
                    },
                    "card_expire_year": {
                        required: true,
                        integer: true,
                    },
                    "card_cvv2": {
                        required: true,
                        integer: true,
                        minlength: 3,
                    },
                },
                messages: {
                    "service_duration": {
                        integer: "Initial service duraction required.",
                    },
                    "device_count": {
                        integer: "Must select the number of devices you plan to use.",
                    },
                    "card_expire_month": {
                        integer: "Expiration month needed.",
                    },
                    "card_expire_month": {
                        integer: "Expiration year needed.",
                    },
                    "card_cvv2": {
                        integer: "CVV2 required for online processing.",
                    },
                }
            });
        });
    </script>
</body>
</html>