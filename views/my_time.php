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
    <h3>My Time</h3>

    <div class="well well-lg">
        <p>Time remaining: 23:43:14</p>
        <p>Expires on: 2014, Jan 14th at 08:27:43 AM</p>
    </div>

    <form>
        <div class="well well-lg">

            <h3>Add Time</h3>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Add Time</span>
                <select name="country" class="form-control">
                    <!--// Will pull from an API service -->
                    <option value="NULL"        >Select One</option>
                    <option value="86400"       >One Day ($5.95 USD)</option>
                    <option value="604800"      >One Week ($11.95 USD)</option>
                    <option value="18144000"    >One Month ($30 days, 24.95 USD)</option>
                    <option value="54432000"    >Three Month ($90 days, 74.85 USD)</option>
                </select>
            </div>

        </div>

        <div class="well well-lg">

            <h3>Payment Method</h3>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Add Time</span>
                <select name="country" class="form-control">
                    <!--// Will pull from an API service -->
                    <option value="NULL"        >Select One</option>

                </select>
            </div>

        </div>
        <?php require_once SITEROOT."/templates/form_dual.php"; ?>

    </form>

    <?php require_once SITEROOT."/templates/bottom.php"; ?>

</body>
</html>