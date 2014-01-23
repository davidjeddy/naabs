<?php
require_once __DIR__."/../config.php";
require_once __DIR__."/templates/auth_check.php";
require_once __DIR__."/../controllers/time_class.php";

$timeClass = new timeClass;
$t_remaining = $timeClass->readTime($_COOKIE['USER']);
?>
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
    <h3>My Time</h3>

    <h4>Information<h4>
    <div class="well well-lg">

        <?php
            if ( !empty($t_remaining) ) {
                echo'<h3>Access Ends at</h3><p>'.date('F jS, Y h:i:s a', $t_remaining).'</p>';
            } else {
                echo '<h4>No time credited.</h4>';
            };
        ?>
        </p>
    </div>

    <h4>Add Time</h4>
    <form id="mytime" action="my_history.php">

        <div class="well well-lg">
            <h3>Service</h3>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Duration</span>
                <select class="form-control" name="serviceduration">
                    <option value="NULL"        >Select One</option>
                    <option value="86400"       >One Day ($5.95 USD)</option>
                    <option value="604800"      >One Week ($11.95 USD)</option>
                    <option value="18144000"    >One Month (30 days, $24.95 USD)</option>
                    <option value="54432000"    >Three Month (90 days, $74.85 USD)</option>
                </select>
            </div>

            <!--// Version 2 will have an option for the number of devices -->
            <!--// <div class="input-group input-group-lg">
                <span class="input-group-addon">Device Count</span>
                <select class="form-control" name="device_count">
                    <option>Select One</option>
                    <option value="1"   >1</option>
                    <option value="2"   >2</option>
                    <option value="3"   >3</option>
                    <option value="4"   >4</option>
                    <option value="5"   >5</option>
                </select>
            </div> -->
        </div>

        <div class="well well-lg">
            <h3>Billing Information</h3>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Name</span>
                <input type="text"    class="form-control" placeholder="First"      name="firstname" value="Joe">
                <input type="text"    class="form-control" placeholder="Last"       name="lastname" value="Shopper">
            </div>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Billig</br>Address</span>
                <input type="text"    class="form-control" placeholder="Street"     name="line1" value="52 N Main ST">
                <input type="text"    class="form-control" placeholder="City"       name="city" value="Johnstown">
                <input type="text"    class="form-control" placeholder="State"      name="state" value="OH">
                <input type="text"    class="form-control" placeholder="ZIP"        name="zip" value="43210">
                <input type="hidden"  class="form-control" placeholder="Country"    name="country" value="US">
            </div>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Card Number</span>
                <input type="text"    class="form-control" placeholder="Card Number"name="cardnumber" value="4417119669820331">
            </div>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Card Type</span>
                <select class="form-control" name="cardtype">
                    <option>Select One</option>
                    <option value="mastercard">Mastercard</option>
                    <option value="visa" selected>Visa</option>
                </select>
            </div>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Exp. date</span>
                <select class="form-control" name="cardexpiremonth">
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
                    <option value="11" selected>11</option>
                    <option value="12">12</option>
                </select>
                <!--// Automat this to include this year and then +4 more -->
                <select class="form-control" name="cardexpireyear">
                    <option value="NULL">Select Yesar</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018" selected>2018</option>
                </select>
            </div>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">CVV2</span>
                <input type="text"    class="form-control" placeholder="CVV2"  name="cardcvv2" value="874">
            </div>
        </div>

        <input type="hidden" name="action" value="create_time">

        <?php require_once SITEROOT."/templates/form_submit.php"; ?>
    </form>

    <?php require_once SITEROOT."/templates/bottom.php"; ?>

    <!--// Add some addition methods to the valitor -->
    <script src="<?= SITEROOT; ?>/../global_assets/js/jquery_validate/dist/additional-methods.js"></script>

    <!--// form validation -->
    <script language="javascript">
        $( document ).ready(function() {
            $("#mytime").validate({
                rules: {
                    "serviceduration": {
                        required: true,
                        integer: true,
                    },
                    "devicecount": {
                        required: true,
                        integer: true,
                    },
                    "firstname": {
                        required: true,
                        lettersonly: true,
                    },
                    "lastname": {
                        required: true,
                        lettersonly: true,
                    },
                    "street1": {
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
                    "cardnumber": {
                        required: true,
                        integer: true,
                        minlength: 15,
                    },
                    "cardtype": {
                        required: true,
                        lettersonly: true,
                    },
                    "cardexpiremonth": {
                        required: true,
                        integer: true,
                    },
                    "cardexpireyear": {
                        required: true,
                        integer: true,
                    },
                    "cardcvv2": {
                        required: true,
                        integer: true,
                        minlength: 3,
                    },
                },
                messages: {
                    "serviceduration": {
                        integer: "Service duraction required.",
                    },
                    "devicecount": {
                        integer: "Must select the number of devices you plan to use.",
                    },
                    "cardexpiremonth": {
                        integer: "Expiration month needed.",
                    },
                    "cardexpiremonth": {
                        integer: "Expiration year needed.",
                    },
                    "cardcvv2": {
                        integer: "CVV2 required for online processing.",
                    },
                }
            });
        });
    </script>

    <?php require_once __DIR__."/templates/ajax_loader.php"; ?>

</body>
</html>