<?php require_once "../config.php"; ?>
<?php $question = explode("=", $_SERVER['QUERY_STRING']); ?>

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
        <form id="account_recovery_step1">
            <h4>Your security question:</h4>
            <h4><?= ucfirst(urldecode($question[1]));?>?</h4>
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Answer</span>
                <input type="text" class="form-control" maxlength="64" placeholder="answer" name="answer">
            </div>

            <input type="text" class="form-control" name="action" value="account_recovery">

            <?php require_once SITEROOT."/templates/form_submit.php"; ?>
        </form>

    </div>

    <div class="well well-lg">
    </div>

    <?php require_once SITEROOT."/templates/bottom.php"; ?>
    <script>
        $("#account_recovery_step1").validate({
            rules: {
                "answer": {
                  required: true,
                  email: true
                },
            }
        });
    </script>

</body>
</html>