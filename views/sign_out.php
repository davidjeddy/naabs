
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
            echo "<p>Thank you for using  ".SITEOWNER."'s web portal. you have been successfully signed out.</p>";
        }; ?>
        
        <p>Thank you.</p>
    </div>

    <form id="sign_out">
        <input type="hidden" name="action" value="sign_out" />
    </form>

    <?php require_once SITEROOT."/templates/bottom.php"; ?>
    
    <script>
    // Trigger the ajax call to sign the user out once the page has loaded.
    $(document).ready(function(){
        if ( $.cookie('AUTH') ) {
            $("form#sign_out").trigger("submit");
        };
    });
    </script>
</body>
</html>