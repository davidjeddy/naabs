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
    <h3>Learn More</h3>

    <div class="well well-lg">
            <p style="color:red">You are not authorized to view that content.</p>
        <ul>
            <li>Try to <a href="./sign_in.php">Sign in</a> if you already have an account;</li>
            <li>or <a href="./create_user.php">Sign up</a> if this is your first visit.</li>
        </ul>
    </div>

    <?php require_once SITEROOT."/templates/bottom.php"; ?>

</body>
</html>