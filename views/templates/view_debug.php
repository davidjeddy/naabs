<?php
/**
 * Debug footer when the site's debug level is higher than CRITICAL
 */

//TODO create a view side error template
echo '<style>.debug {border-color:red}</style>';
echo '</pre>COOKIE:<PRE class="debug">';
print_r($_COOKIE);
echo '</pre>SESSION:<PRE class="debug">';
print_r($_SESSION);
echo '</pre>SERVER:<PRE class="debug">';
print_r($_SERVER);
echo '</PRE>';
?>