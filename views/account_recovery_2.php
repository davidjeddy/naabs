<?php require_once "../config.php"; ?>
<?php
//TODO refactor
//Iterate over the cookie data array, if any is expired: return to star.
if (!$_COOKIE['EMAIL']) {
    header( "Location: ./account_recovery.php" );
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once SITEROOT."/templates/top.php"; ?>
</head>

<body>

    <?php require_once SITEROOT."/templates/top_menu.php"; ?>

    <!--// Page title -->
    <h3>Reset Login</h3>

    <div class="well well-lg">

        <form id="account_recovery">
            <h4><?= ucfirst($_COOKIE['QUESTION']); ?>?</h4>
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Answer</span>
                <input type="text" class="form-control" maxlength="64" placeholder="Your answer" name="answer">
            </div>

            <input type="hidden" class="form-control" name="email"    value="<?= $_COOKIE['EMAIL']; ?>">
            <input type="hidden" class="form-control" name="action"   value="account_recovery_2">

            <?php require_once SITEROOT."/templates/form_submit.php"; ?>
        </form>

    </div>

    <div class="well well-lg">
    </div>

    <?php require_once SITEROOT."/templates/bottom.php"; ?>
    <script>
        $("#account_recovery").validate({
            rules: {
                "answer": {
                  required: true,
                  lettersandspace: true
                },
            }
        });
    </script>

</body>
</html>