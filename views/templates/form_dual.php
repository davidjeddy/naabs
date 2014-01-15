<?php
//If user is setting up an account, use 'next'
if (isset( $_SESSION['IS_SIGNUP'] )) {
    require_once SITEROOT."/templates/form_next.php";
//Else if user is authed, save changes
} elseif (isset( $_SESSION['IS_AUTH'] )) {
    require_once SITEROOT."/templates/form_enter.php";
//if neither, no options
} else {
    echo '<p>You are not currently authorized to submit this form.</p>';
};
?>