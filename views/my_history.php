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
                    <td width="25%">ID</td>
                    <td width="20%">Time (GMT)</td>
                    <td width="15%">Intent</td>
                    <td width="15%">State</td>
                    <td width="15%">Amount (USD)</td>
                    <td width="1%">Receipt</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><p>PAY-TEST1234</p></td>
                    <td><p>2014-01-27 2:35 pm</p></td>
                    <td><p>SALE</p></td>
                    <td><p>COMPLETED</p></td>
                    <td><p>$14.95</p></td>
                    <td>
                        <button
                            type="button"
                            class="btn btn-primary btn-xs btn-bootbox"
                        >View</button>
                    </td>
                </tr>
            <?php
                foreach ($h_data as $transaction) {
                    echo '
                    <tr>
                        <td>'.$transaction->transaction_id.'</td>
                        <td>'.date('F jS, Y h:i:s a', $transaction->create_time).'</td>
                        <td>'.$transaction->intent.'</td>
                        <td>'.$transaction->state.'</td>
                        <td>$'.$transaction->amount.'</td>
                    </tr>';
                }
            ?>
            </tbody>
            <tfood>
            </tfood>
        </table>
    </div>

    <?php require_once SITEROOT."/templates/bottom.php"; ?>

</body>
</html>