<?php
require_once __DIR__."/../config.php";
require_once __DIR__."/templates/auth_check.php";
require_once __DIR__."/../controllers/history_class.php";

$historyClass = new historyClass;
$h_data = $historyClass->readHistory($_COOKIE['USER']);
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

    <!--// Page title -->
    <h3>My Access History</h3>

    <div class="well well-lg">
        <p>`My Access History` content here.</p>
        <?php
            foreach ($h_data as $transaction) {
                print_r($transaction);
            }
        ?>
    </div>

    <?php require_once SITEROOT."/templates/bottom.php"; ?>

</body>
</html>