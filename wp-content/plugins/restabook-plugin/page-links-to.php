<?php

// Main plugin class.
require( dirname( __FILE__ ) . '/classes/plugin.php' );

// Functions.
require( dirname( __FILE__ ) . '/inc/functions.php' );

// Bootstrap everything.
new CWS_PageLinksTo( __FILE__ );