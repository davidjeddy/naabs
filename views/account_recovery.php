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

        <form id="account_recovery">
            <h4>Please enter the email that you registerd with:</h4>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Email</span>
                <input type="text" class="form-control" maxlength="64" placeholder="account@provider.com" name="email" value="test1@email.com">
            </div>

            <input type="hidden" class="form-control" name="action" value="account_recovery">

            <?php require_once SITEROOT."/templates/form_submit.php"; ?>
        </form>

    </div>

    <div class="well well-lg">
    </div>

    <?php require_once SITEROOT."/templates/bottom.php"; ?>
    <script>
        $("#account_recovery").validate({
            rules: {
                "email": {
                  required: true,
                  email: true
                },
            }
        });
    </script>

</body>
</html>