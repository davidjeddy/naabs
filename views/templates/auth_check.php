<?php
/**
 * Check that to user has valid auth for view
 */

//
if ( !isset($_COOKIE['AUTH'])
	|| $_COOKIE['AUTH'] !== "true"
) {
	header( 'Location: ./not_auth.php' ) ;
}