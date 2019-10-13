<?php
/*
  Plugin Name: Simple SKU Search
  Plugin URI: https://github.com/lab36/woocommerce-search-by-sku
  Description: Woocommerce plugin to add simple search by sku using widget or shortcode
  Author: Lab36
  Author URI: https://lab36solutions.com
  Version: 1.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class L36_Search_By_Sku_Init {

	public function __construct() {
		$this->define( 'L36SKU_PATH', plugin_dir_path( __FILE__ ) );
		$this->init();
		$this->init_frontend();
		if ( is_admin() ) {
			$this->init_admin();
		}
	}

	public function init() {
		load_plugin_textdomain( 'l36sku', false, L36SKU_PATH . 'languages/' );

		if ( ! class_exists( 'WooCommerce' ) ) {
			add_action( 'admin_notices', array( &$this, 'install_woocommerce_admin_notice' ) );
		}

		add_filter(
			'plugin_action_links_' . plugin_basename( __FILE__ ),
			array( &$this, 'l36sku_search_settings_link' )
		);
	}

	public function init_frontend() {
		require_once 'class-l36-search-by-sku.php';
		require_once 'class-l36-sku-search-form-shortcode.php';
		require_once 'class-l36-sku-search-form-widget.php';
	}

	public function init_admin() {
		require_once 'class-l36-sku-search-admin-options.php';
	}

	public function install_woocommerce_admin_notice() {
		?>
        <div class="error">
            <p><?php
				_e( 'Simple SKU Search is enabled but not effective! It requires WooCommerce in order to work.', 'l36sku' );
				?></p>
        </div>
		<?php
	}

	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	public function l36sku_search_settings_link( $links ) {
		$links[] = '<a href="' .
		           admin_url( 'admin.php?page=l36-search-by-sku' ) .
		           '">' . __( 'Settings', 'l36sku' ) . '</a>';

		return $links;
	}
}


add_action( 'plugins_loaded', function () {
	new L36_Search_By_Sku_Init();
} );
