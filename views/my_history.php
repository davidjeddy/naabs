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

    <?php require_once SITEROOT."/templates/top_menu.php"; ?>

    <!--// Page title -->
    <h3>Purchase History</h3>

    <div class="well well-lg">

        <div id="receipt">
            <table class="table table-striped table-bordered table-hover table-responsive">
                <thead>
                    <tr>
                        <td colspan="4"><h2>Sales Receipt</h2></td>
                        <td colspan="3"><h3>Seller Website:</h2><h2><?= $_SERVER['SERVER_NAME']; ?></h3></td>
                    </tr>
                    <tr>
                        <td colspan="4"><p>Sold By: <?= SITEOWNER; ?></p></td>
                        <td colspan="3"><p>Current Date: <?= date("Y-m-d H:i:s"); ?></p></td>
                    </tr>
                    <tr>
                        <td colspan="7" style="padding-right: 35%"><p>Buyer Email: <?= $_COOKIE['USER']; ?></p></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                        <td><p>User</p></td>
                        <td><p>Transaction ID</p></td>
                        <td><p>Date &amp; Time (GMT)</p></td>
                        <td><p>Intent</p></td>
                        <td><p>Amount (USD)</p></td>
                        <td><p>State</p></td>
                    </tr>
                    
                    <?php
                    // Each order
                    foreach ($h_data as $o_key=>$o_value) {

                        echo '<tr>';
                        // Each item
                        foreach($o_value as $i_key=>$i_value) {

                            // Ignore the row ID
                            if ($i_key == "id") { continue; }

                            // format the date time to be human readable
                            if ($i_key == "create_time") {

                                echo '<td><p>'.date('Y-m-d h:i:s a', $i_value).'</p></td>';
                            // everything else
                            } else {

                                echo '<td><p>'.$i_value.'</p></td>';
                            }
                        }
                        echo '<tr>';
                    }
                    ?>

                </tbody>
                <tfood>
                </tfood>
            </table>
        </div>
        <button data-source="#receipt" type="submit" class="btn btn-default print">Print Receipt</button>
    </div>

    <?php require_once SITEROOT."/templates/bottom.php"; ?>

</body>
</html>