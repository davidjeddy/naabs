<?php
/**
 * Redirect to the view/index.php
 */
try {
	header("Location: ./views/index.php");
} catch (Exception $e) {
    print $e->getMessage()." Config Error 1";
    exit;
}