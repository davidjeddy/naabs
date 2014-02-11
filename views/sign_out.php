
<?php require_once "../config.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once SITEROOT."/templates/top.php"; ?>
</head>

<body>

    <?php require_once SITEROOT."/templates/top_menu.php"; ?>

    <!--// Page title -->
    <h3>Signed Out</h3>

    <div class="well well-lg">
        <?php 
        if ( isset($_COOKIE['AUTH']) ) {
            echo "<p>Singing you out now, please stand by.</p>";
        } else {
            echo "<p>You have been signed out of  ".SITEOWNER."'s web portal.</p>";
        }; ?>
        
        <p>Thank you.</p>
    </div>

    <form name="logout_user" id="logout_user">
        <input type="hidden" name="action" value="logout_user" />
    </form>

    <?php require_once SITEROOT."/templates/bottom.php"; ?>
    
    <script>
    // Trigger the ajax call to sign the user out once the page has loaded.
    $(document).ready(function(){
        if ( $.cookie('AUTH') ) {
            $("#logout_user").trigger("submit");
        };
    });
    </script>
</body>
</html>