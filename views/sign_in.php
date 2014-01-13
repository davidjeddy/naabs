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
    <h3>Sign In</h3>

    <div class="well well-lg">
        <form>
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Username</span>
                <input type="text"        class="form-control" placeholder="Username">
            </div>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Password</span>
                <input type="password"    class="form-control" placeholder="Password">
            </div>

            <div class="btn-group">
                <button type="button"     class="btn btn-default submit">Enter</button>
                <button type="button"     class="btn btn-default clear">Clear</button>
                <a href="<?= SITEROOT; ?>reset.php" id="sign_in_reset_account_link">Reset Login Data</a>
            </div>

        </form>

    </div>

    <?php require_once SITEROOT."/templates/bottom.php"; ?>

</body>
</html>