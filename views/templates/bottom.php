<!--// jQ and other jQ libas added via composer -->
<script language="javascript" src="<?= SITEROOT; ?>/../vendor/components/jquery/jquery.min.js"></script>
<script language="javascript" src="<?= SITEROOT; ?>/../vendor/twitter/bootstrap/dist/js/bootstrap.min.js"></script>
<script language="javascript" src="<?= SITEROOT; ?>/../vendor/balupton/jquery-scrollto/src/documents/lib/jquery-scrollto.js"></script>
<script language="javascript" src="<?= SITEROOT; ?>/../vendor/makeusabrew/bootbox/bootbox.js"></script>
<script language="javascript" src="<?= SITEROOT; ?>/../vendor/carhartl/jquery-cookie/jquery.cookie.js"></script>

<!--// Manually added libs -->
<script language="javascript" src="<?= SITEROOT; ?>/../global_assets/js/jquery_validate/dist/jquery.validate.min.js" ></script>
<script language="javascript" src="<?= SITEROOT; ?>/../global_assets/js/jquery.unserialize.js" ></script>

<!--// Application JS logic -->
<script language="javascript" src="<?= SITEROOT; ?>/../global_assets/js/site.js"></script>

<?php
//If localhost, show debug
if ($_SERVER["SERVER_ADDR"] == DEVIP) {
	echo'<hr /><h1>DEBUG DATA:</h1>';
	include_once( __DIR__.'/view_debug.php');
}
?>