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
    <h3>Sign Up</h3>

    <form>
        <div class="well well-lg">
            <h3>Account</h3>
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Username</span>
                <input type="text"        class="form-control" placeholder="Username">
            </div>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Password</span>
                <input type="password"    class="form-control" placeholder="Password">
                <input type="password"    class="form-control" placeholder="Repeat Password">
            </div>

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Email</span>
                <input type="text"    class="form-control" placeholder="Email">
                <input type="text"    class="form-control" placeholder="Repeat email">
            </div>
        </div>

        <div class="well well-lg">
            <h3>Contact</h3>
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Address</span>
                <input type="text"    class="form-control" length="32" placeholder="Street 1">
                <input type="text"    class="form-control" length="32" placeholder="Street 2">
                <input type="text"    class="form-control" length="32" placeholder="City">
                <select name="country" class="form-control">
                    <!--// Will pull from an API service -->
                    <option value="NULL" selected>select one</option>
                </select>
                <input type="text"    class="form-control" length="8"  placeholder="State / Providence">
                <input type="text"    class="form-control" length="12" placeholder="Zip / Postal code">
            </div>

            <h3>Phone</h3>
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Phone</span>
                <input type="text"    class="form-control" length="11" placeholder="Home">
                <input type="text"    class="form-control" length="32" placeholder="Work">
                <input type="text"    class="form-control" length="32" placeholder="Cell">
            </div>
        </div>

        <?php require_once SITEROOT."/templates/form_next.php"; ?>

    </form>
    <?php require_once SITEROOT."/templates/bottom.php"; ?>

</body>
</html>