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
                <span class="input-group-addon">Password</span>
                <input type="password"    class="form-control" placeholder="Password"           name="password"         id="password">
                <input type="password"    class="form-control" placeholder="Repeat password"    name="repeatpassword"   id="repeatpassword">
            </div>
        </div>

        <div class="well well-lg">
            <h3>Security</h3>
            <h5>Please provide a question and answer that will be used for account recovery.</h5>
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
                <input type="text"    class="form-control" length="11" placeholder="Mobile Phone" name="mobilephone">
                <input type="text"    class="form-control" length="32" placeholder="Home Phone" name="homephone">
                <input type="text"    class="form-control" length="32" placeholder="Work Phone" name="workphone">
            </div>
        </div>

        <div class="well well-lg">
            <h3>Location</h3>
            <h5>Where are you staying within the grounds.</h5>
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
                "mobilephone": {
                    required: true,
                    phoneUS: true,
                },
                "homephone": {
                    phoneUS: true,
                },
                "altphone": {
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
                    equalTo: "Must provide a security question.",
                },
                "securityanswer": {
                    equalTo: "Security answer must be provided.",
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
            },
        });
    </script>

    <?php require_once __DIR__."/templates/ajax_loader.php"; ?>

</body>
</html>