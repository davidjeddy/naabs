<?php
    require_once "../config.php";
?>

<!DOCTYPE html>
<html>

<head>
    <?php require_once SITEROOT."/templates/top.php"; ?>
</head>

<body>

    <?php require_once SITEROOT."/templates/no_script.php"; ?>

    <?php require_once SITEROOT."/templates/top_menu.php"; ?>

    <div class="jumbotron">
        <div class="container">
            <h1><?= SITETITLE; ?></h1>
            <small>Wireless internet access accounting system.</small></h1>
        </div>

        <a class="btn btn-primary btn-lg" role="button" href="<?= SITEROOT; ?>/learn_more.php">Learn More</a>
        &nbsp;&nbsp;&nbsp;
        <a class="btn btn-primary btn-lg" role="button" href="<?= SITEROOT; ?>/create_user.php">Sign Up</a>
        &nbsp;&nbsp;&nbsp;
        <a class="btn btn-primary btn-lg" role="button" href="<?= SITEROOT; ?>/sign_in.php">Sign In</a>
    </div>

    <?php require_once SITEROOT."/templates/bottom.php"; ?>

</body>
</html>