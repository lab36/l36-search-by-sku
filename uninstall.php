<?php

if ( ! current_user_can( 'activate_plugins' ) ) {
	return;
}

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

delete_option( 'l36sku' );
delete_site_option( 'l36sku' );
