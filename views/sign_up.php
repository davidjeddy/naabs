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
    <h5>Step 1 of 3 : Winds.net Account Creation</h5>

    <!--// 3 step sign up process: general, address, billing option -->
    <form name="sign_up_1" id="sign_up_1" action="sign_up_2.php">
        <div class="well well-lg">
            <h3>Account</h3>
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Email</span>
                <input type="text"    class="form-control" placeholder="Email"          name="email"        id="email">
                <input type="text"    class="form-control" placeholder="Repeat email"   name="repeat_email" id="repeat_email">
            </div>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Password</span>
                <input type="password"    class="form-control" placeholder="Password"           name="password"         id="password">
                <input type="password"    class="form-control" placeholder="Repeat password"    name="repeat_password"  id="repeat_password">
            </div>
        </div>

        <div class="well well-lg">
            <h3>Phone</h3>
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Phone</span>
                <input type="text"    class="form-control" length="11" placeholder="Cell Phone" name="cell_phone">
                <input type="text"    class="form-control" length="32" placeholder="Home Phone" name="home_phone">
                <input type="text"    class="form-control" length="32" placeholder="Alt. Phone" name="alt_phone">
            </div>
        </div>

        <div class="well well-lg">
            <h3>Location</h3>
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Lot Number</span>
                <!--// Some lots have alphabetical characters: 44A, 65B, etc. Cant us a DDL -->
                <input type="text"    class="form-control" length="11" placeholder="0 to 850"  name="lot_id">
            </div>
        </div>

        <?php require_once SITEROOT."/templates/form_next.php"; ?>
    </form>

    <?php require_once SITEROOT."/templates/bottom.php"; ?>

    <!--// Add some addition methods to the valitor -->
    <script src="<?= SITEHOME; ?>global_assets/js/jquery_validate/dist/additional-methods.js"></script>

    <!--// form validation -->
    <script language="javascript">
        $("#sign_up_1").validate({
            rules: {
                // no quoting necessary
                "email": {
                  required: true,
                  email: true,
                },
                "repeat_email": {
                  required: true,
                  email: true,
                  equalTo: "#email",
                },
                "password": {
                    required: true,
                    minlength: 8,
                },
                "repeat_password": {
                    required: true,
                    minlength: 8,
                    equalTo: "#password",
                },
                "cell_phone": {
                    required: true,
                    phoneUS: true,
                },
                "home_phone": {
                    phoneUS: true,
                },
                "alt_phone": {
                    phoneUS: true,
                }
            },
            messages: {
                "repeat_email": {
                    equalTo: "Email address must match.",
                },
                "repeat_password": {
                    equalTo: "Password does not match.",
                },
                "cell_phone": {
                    phoneUS: "U.S. formated phone number please.",
                },
                "home_phone": {
                    phoneUS: "U.S. formated phone number please.",
                },
                "alt_phone": {
                    phoneUS: "U.S. formated phone number please.",
                },
            }
        });
    </script>
</body>
</html>