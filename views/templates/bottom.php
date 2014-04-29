<!--// jQ and other jQ libas added via composer -->
<script language="javascript" src="<?= SITEROOT; ?>/../vendor/components/jquery/jquery.min.js"></script>
<script language="javascript" src="<?= SITEROOT; ?>/../vendor/twitter/bootstrap/dist/js/bootstrap.min.js"></script>
<script language="javascript" src="<?= SITEROOT; ?>/../vendor/makeusabrew/bootbox/bootbox.js"></script>
<script language="javascript" src="<?= SITEROOT; ?>/../vendor/carhartl/jquery-cookie/jquery.cookie.js"></script>

<!--// Manually added libs -->
<script language="javascript" src="<?= SITEROOT; ?>/../global_assets/js/jquery_validate/dist/jquery.validate.min.js" ></script>
<script language="javascript" src="<?= SITEROOT; ?>/../global_assets/js/jquery_validate.error_overrides.js" ></script>
<script language="javascript" src="<?= SITEROOT; ?>/../global_assets/js/jquery.unserialize.js" ></script>

<!--// Application JS logic -->
<script language="javascript" src="<?= SITEROOT; ?>/../global_assets/js/site.js"></script>

<?php
//If localhost, show debug
if ($_SERVER["SERVER_ADDR"] == "127.0.0.1" || $_SERVER["SERVER_ADDR"] == "localhost") {
	echo'<hr /><h1>DEBUG DATA:</h1>';
	include_once( __DIR__.'/view_debug.php');
}
?>

<?php
/**
 * Basic full screen overlay during ajax processing
 *
 *@source http://stackoverflow.com/questions/1964839/jquery-please-wait-loading-animation
 */
 ?>
 <style>
/* Start by setting display:none to make this hidden.
Then we position it in relation to the viewport window
with position:fixed. Width, height, top and left speak
speak for themselves. Background we set to 80% white with
our animation centered, and no-repeating */
.loading_overlay {
    text-align: center;
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    padding-top: 10%;
    background: rgba( 255, 255, 255, .90 ) 
                url('<?= SITEROOT; ?>/../global_assets/images/ajax_processing.gif') 
                50% 25% 
                no-repeat;
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
body.loading {
    overflow: hidden;   
}

/* Anytime the body has the loading class, our
   modal element will be visible */
body.loading .loading_overlay {
    display: block;
}
</style>
<div class="loading_overlay">
    <h3>Please be patient, this process can take up to a minute.</h3>
    <h3>Please do not hit the back button or close the page.</h3>
</div>
