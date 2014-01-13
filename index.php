<?php
/**
 * Redirect to the view/index.php
 */
try {
	require_once "./views/index.php";
} catch (Exception $e) {
    print $e->getMessage()." Config Error 1";
    exit;
}