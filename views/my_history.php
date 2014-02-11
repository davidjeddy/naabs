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
        <p>My Transactions</p>
        <table class="table table-striped table-bordered table-hover table-responsiv">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Time (GMT)</td>
                    <td>Purpose</td>
                    <td>Intent</td>
                    <td>Amount (USD)</td>
                    <td>State</td>
                    <td class="receipt_cell">Receipt</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><p>PAY-TEST1234</p></td>
                    <td><p>2014-01-27 2:35 pm</p></td>
                    <td><p>WAN access via local private WiFi network.</p></td>
                    <td><p>SALE</p></td>
                    <td><p>$14.95</p></td>
                    <td><p>COMPLETED</p></td>
                    <td>
                        <button
                            type="button"
                            class="btn btn-primary btn-xs btn-bootbox"
                            data-id="PAY-TEST1234"
                            data-time="2014-01-27 2:35 pm"
                            data-purpose="WAN access via local private WiFi network." 
                            data-intent="SALE"
                            data-amount="$14.95"
                            data-state="COMPLETED"
                        >View</button>
                    </td>
                </tr>
            </tbody>
            <tfood>
            </tfood>
        </table>
    </div>

    <?php require_once SITEROOT."/templates/bottom.php"; ?>

</body>
</html>