<?php
    require_once "../config.php";
?>

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

    <div class="jumbotron">
        <div class="container">
            <h1>Winds.net</h1>
            <small>Wireless internet access provided by Winds RV park.</small></h1>
        </div>

        <a class="btn btn-primary btn-lg" role="button">Learn More</a>&nbsp;&nbsp;&nbsp;
        <a class="btn btn-primary btn-lg" role="button" href="<?= SITEROOT; ?>/sign_up.php">Sign Up</a>
    </div>

    <?php require_once SITEROOT."/templates/bottom.php"; ?>

</body>
</html>