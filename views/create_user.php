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
    <h3>Create User Account</h3>

    <!--// 3 step sign up process: general, address, billing option -->
    <form name="signup1" id="signup1" action="./my_time.php">
        <div class="well well-lg">
            <h3>Account</h3>
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Email</span>
                <input type="text"    class="form-control" placeholder="Email"          name="email"        id="email">
                <input type="text"    class="form-control" placeholder="Repeat email"   name="repeatemail" id="repeatemail">
            </div>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Password</span>
                <input type="password"    class="form-control" placeholder="Password"           name="password"         id="password">
                <input type="password"    class="form-control" placeholder="Repeat password"    name="repeatpassword"  id="repeatpassword">
            </div>
        </div>

        <div class="well well-lg">
            <h3>Phone</h3>
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Phone</span>
                <input type="text"    class="form-control" length="11" placeholder="Mobile Phone" name="mobilephone">
                <input type="text"    class="form-control" length="32" placeholder="Home Phone" name="homephone">
                <input type="text"    class="form-control" length="32" placeholder="Work Phone" name="workphone">
            </div>
        </div>

        <div class="well well-lg">
            <h3>Location</h3>
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Lot Number</span>
                <!--// Some lots have alphabetical characters: 44A, 65B, etc. Cant us a DDL -->
                <input type="text"    class="form-control" length="11" placeholder="0 to 850"  name="lotid">
            </div>
        </div>

        <input type="hidden" class="form-control" name="action" value="create_user">
        <?php require_once SITEROOT."/templates/form_submit.php"; ?>
    </form>

    <?php require_once SITEROOT."/templates/bottom.php"; ?>

    <!--// Add some addition methods to the valitor -->
    <script src="<?= SITEHOME; ?>global_assets/js/jquery_validate/dist/additional-methods.js"></script>

    <!--// form validation -->
    <script language="javascript">
        $("#signup1").validate({
            rules: {
                // no quoting necessary
                "email": {
                  required: true,
                  email: true,
                },
                "repeatemail": {
                  required: true,
                  email: true,
                  equalTo: "#email",
                },
                "password": {
                    required: true,
                    minlength: 8,
                },
                "repeatpassword": {
                    required: true,
                    minlength: 8,
                    equalTo: "#password",
                },
                "mobilephone": {
                    required: true,
                    phoneUS: true,
                },
                "homephone": {
                    phoneUS: true,
                },
                "altphone": {
                    phoneUS: true,
                }
            },
            messages: {
                "repeatemail": {
                    equalTo: "Email address must match.",
                },
                "repeatpassword": {
                    equalTo: "Password does not match.",
                },
                "cellphone": {
                    phoneUS: "U.S. formated phone number please.",
                },
                "homephone": {
                    phoneUS: "U.S. formated phone number please.",
                },
                "altphone": {
                    phoneUS: "U.S. formated phone number please.",
                },
            }
        });
    </script>
</body>
</html>