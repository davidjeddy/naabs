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
    <h5>Step 2 of 2 : Service &amp; Payment Processing</h5>

    <!--// 3 step sign up process: general, address, billing option -->
    <form name="sign_up_2" id="sign_up_2">

        <div class="well well-lg">
            <h3>Service</h3>
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Duration</span>
                <select name="country" class="form-control" id="service_duration">
                    <!--// Will pull from an API service -->
                    <option value="NULL"        >Select One</option>
                    <option value="86400"       >One Day ($5.95 USD)</option>
                    <option value="604800"      >One Week ($11.95 USD)</option>
                    <option value="18144000"    >One Month ($30 days, 24.95 USD)</option>
                    <option value="54432000"    >Three Month ($90 days, 74.85 USD)</option>
                </select>
            </div>

            <!--// Version 2 will have an option for the number of devices -->
            <!--
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Device Count</span>
                <select name="country" class="form-control" disabled id="device_count">
                    <option value="NULL" >Select One</option>
                    <option value="1"   selected>1</option>
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
                <span class="input-group-addon">Number</span>
                <input type="text"    class="form-control" placeholder="Number"  name="number">
            </div>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Type</span>
                <select name="country" class="form-control" name="type" id="type">
                    <!--// Will pull from an API service -->
                    <option value="NULL"        >Select One</option>
                    <option value="visa"        >Visa</option>
                    <option value="mastercard"  >Mastercard</option>
                </select>
            </div>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Exp. date</span>
                <select name="country" class="form-control" name="expire_month" id="expire_month">
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
                <select name="country" class="form-control" name="expire_year" id="expire_yea">
                    <option value="NULL">Select Yesar</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                </select>
            </div>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">CVV2</span>
                <input type="text"    class="form-control" placeholder="CVV2"  name="cvv2">
            </div>
        </div>

        <?php require_once SITEROOT."/templates/form_enter.php"; ?>

    </form>
    <?php require_once SITEROOT."/templates/bottom.php"; ?>

    <!--// Check that the sign_up page was completed first -->
    <script language="javascript">
    $( document ).ready(function() {
        if ( typeof($.cookie('windsnet_sign_up_1')) == "undefined" ) { window.location = "./sign_up.php";}
    });
    </script>

    <!--// Add some addition methods to the valitor -->
    <script src="<?= SITEHOME; ?>global_assets/js/jquery_validate/dist/additional-methods.js"></script>

    <!--// form validation -->
    <script language="javascript">
        $("#sign_up_2").validate({
            rules: {
                "service_length": {

                },
                "device_count": {
                    //NA for now. Maybe in V2
                },
                "first_name": {
                  required: true,
                },
                "last_name": {
                  required: true,
                },
                "number": {
                    required: true,
                    minlength: 15,
                },
                "type": {
                    required: "#type:selected",
                },
                "expire_month": {
                    required: "#expire_month:selected",
                },
                "expire_year": {
                    required: true,
                },
                "cvv2": {
                    phoneUS: true,
                }
            }
        });
    </script>
</body>
</html>