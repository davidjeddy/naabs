<?php require_once "../config.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once SITEROOT."/templates/top.php"; ?>
</head>

<body>

    <?php require_once SITEROOT."/templates/top_menu.php"; ?>

    <!--// Page title -->
    <h3>Create User Account</h3>

    <!--// 3 step sign up process: general, address, billing option -->
    <form name="signup1" id="signup1" action="./my_time.php">
        <div class="well well-lg">
            <h3>Account</h3>
            <h5>Please provide an email and password for account creation.</h5>
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Email</span>
                <input type="text"    class="form-control" placeholder="Email"          name="email"        id="email">
                <input type="text"    class="form-control" placeholder="Repeat email"   name="repeatemail" id="repeatemail">
            </div>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Password.</span>
                <input type="password"    class="form-control"
                    placeholder="Password (Alphanumeric and atleast 8 characers please.)"
                    name="password" id="password">
                <input type="password"    class="form-control"
                    placeholder="Repeat password (Must match above password.)"
                    name="repeatpassword" id="repeatpassword">
            </div>
        </div>

        <div class="well well-lg">
            <h3>Security</h3>
            <h5>Please provide a security question and answer. This will be used to recover your account if necessary.</h5>
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Question</span>
                <input type="text"    class="form-control" length="11" placeholder="Question" name="securityquestion">
                <span class="input-group-addon">?</span>
            </div>
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Answer</span>
                <input type="text"    class="form-control" length="11" placeholder="Answer" name="securityanswer">
            </div>

        </div>

        <div class="well well-lg">
            <h3>Phone</h3>
            <h5>Best phone number(s) you can be contacted at.</h5>
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Phone</span>
                <input type="text" class="form-control" length="11" placeholder="Primary Phone (3527778888 format)"
                    name="primaryphone">
                <input type="text"    class="form-control" length="32" placeholder="Secondary Phone (3527778888 format)"
                    name="secondaryphone">
                <input type="text"    class="form-control" length="32" placeholder="Third Phone (3527778888 format)"
                    name="tertiaryphone">
            </div>
        </div>

        <div class="well well-lg">
            <h3>Location</h3>
            <h5>If staying in the park, please provide a lot number (not required).</h5>
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Lot Number</span>
                <input type="text"    class="form-control" length="11" placeholder="0 to 850"  name="lotid">
            </div>
        </div>

        <input type="hidden" class="form-control" name="action" value="sign_up">
        <?php require_once SITEROOT."/templates/form_submit.php"; ?>
    </form>

    <?php require_once SITEROOT."/templates/bottom.php"; ?>

    <!--// Add some addition methods to the valitor -->
    <script src="<?= SITEROOT; ?>/../global_assets/js/jquery_validate/dist/additional-methods.js"></script>

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
                "securityquestion": {
                    lettersandspace: true,
                    required: true,
                },
                "securityanswer": {
                    required: true,
                },
                "primaryphone": {
                    required: true,
                    phoneUS: true,
                },
                "secondaryphone": {
                    phoneUS: true,
                },
                "tertiaryphone": {
                    phoneUS: true,
                },
            },
            messages: {
                "repeatemail": {
                    equalTo: "Email address must match.",
                },
                "repeatpassword": {
                    equalTo: "Password fields do not match.",
                },
                "securityquestion": {
                    equalTo: "Securit question is required.",
                },
                "securityanswer": {
                    equalTo: "Security answer required please.",
                },
                "primaryphone": {
                    phoneUS: "U.S. formated phone number, no dashes or spaces please.",
                },
                "secondaryphone": {
                    phoneUS: "U.S. formated phone number, no dashes or spaces please.",
                },
                "tertiaryphone": {
                    phoneUS: "U.S. formated phone number, no dashes or spaces please.",
                },
            },
        });
    </script>

</body>
</html>
<?php
//@note Pop with test data from Paypal for localhost testing
if ($_SERVER["SERVER_ADDR"] == "127.0.0.1" || $_SERVER["SERVER_ADDR"] == "localhost") { ?>
<script>
    $("input[name  = 'email']").val('joe@shopper.com');
    $("input[name  = 'repeatemail']").val('joe@shopper.com');
    $("input[name  = 'password']").val('testpassword');
    $("input[name  = 'repeatpassword']").val('testpassword');
    $("input[name  = 'securityquestion']").val('qwerqwerqwer');
    $("input[name  = 'securityanswer']").val('asdfasdfasdf');
    $("input[name  = 'primaryphone']").val('3216540987');
    $("input[name  = 'lotid']").val('14B');
</script>
<?php }; ?>