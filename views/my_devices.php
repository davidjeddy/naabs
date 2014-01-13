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
    <h3>My Devices</h3>

    <div class="well well-lg">
        <p>`My Devices` content here.</p>
        <p>Will list the devices authorized to the account.</p>
        <p>The user is able to remove a device in order to add a new one.</p>
        <p>Eventually this will be the account/sub-account management page.</p>
    </div>

    <?php require_once SITEROOT."/templates/bottom.php"; ?>

</body>
</html>