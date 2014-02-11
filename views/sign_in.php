<?php require_once "../config.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once SITEROOT."/templates/top.php"; ?>
</head>

<body>

    <?php require_once SITEROOT."/templates/top_menu.php"; ?>

    <!--// Page title -->
    <h3>Sign In</h3>

    <div class="well well-lg">

        <form id="sign_in">
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Email</span>
                <input type="text"      class="form-control" maxlength="64" placeholder="email" name="email">
            </div>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Password</span>
                <input type="password"  class="form-control" maxlength="32" placeholder="password" name="password">
            </div>

            <input type="hidden" name="action" value="login_user" />
            <?php require_once SITEROOT."/templates/form_submit.php"; ?>
        </form>

    </div>

    <?php require_once SITEROOT."/templates/bottom.php"; ?>
    <script>
        $("#sign_in").validate({
            rules: {
                // no quoting necessary
                "email": {
                  required: true,
                  email: true
                },
                "password": {
                    required: true,
                    minlength: 8,
                }
            }
        });
    </script>
</body>
</html>