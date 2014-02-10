<?php require_once "../config.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once SITEROOT."/templates/top.php"; ?>
</head>

<body>

    <?php require_once SITEROOT."/templates/top_menu.php"; ?>

    <!--// Page title -->
    <h3>Reset Login</h3>

    <div class="well well-lg">

        <form id="reset_login">
            <h4>The email used to register with:</h4>
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Email</span>
                <input type="text" class="form-control" maxlength="64" placeholder="email" name="email">
            </div>

            <?php require_once SITEROOT."/templates/form_submit.php"; ?>
        </form>

    </div>

    <div class="well well-lg">
    </div>

    <?php require_once SITEROOT."/templates/bottom.php"; ?>
    <script>
        $("#sign_in").validate({
            rules: {
                // No quoting necessary
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