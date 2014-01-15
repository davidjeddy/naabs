<?php
/**
 * Default Top menu template
 *
 * @author  David Eddy <me@davidjeddy.com>
 * @date    2014-01-13
 * @since   0.0.1
 * @version 0.0.1
 */
?>
<nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?= SITEROOT; ?>/">Winds.net</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="<?= SITEROOT; ?>/learn_more.php">Learn More</a></li>
            <li><a href="<?= SITEROOT; ?>/sign_up.php">Sign up</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php 
            if ( 1==1 ) {
            //if ( isset($_SESSION['IS_AUTH']) && $_SESSION['IS_AUTH'] == true ){
            ?>
                <li><a href="#">Status: OK</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account&nbsp;<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= SITEROOT; ?>/my_addresses.php">My Addresses</a></li>
                        <li class="divider"></li>
                        <li><a href="<?= SITEROOT; ?>/my_time.php">My Time</a></li>
                        <li class="divider"></li>
                        <li><a href="<?= SITEROOT; ?>/my_devices.php">My Device</a></li>
                        <li class="divider"></li>
                        <li><a href="<?= SITEROOT; ?>/my_history.php">My History</a></li>
                    </ul>
                </li>
                <li><a href="<?= SITEROOT; ?>/sign_out.php">Sign Out</a></li>
            <?php } else {; ?>
                <li><a href="<?= SITEROOT; ?>/sign_in.php">Sign In</a></li>
            <?php }; ?>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>