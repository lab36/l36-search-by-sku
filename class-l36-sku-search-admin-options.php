<?php
/**
 * Created by Lab36.
 * User: Cosmin Natea (cosmin.natea@lab36.ro)
 * Date: 10/13/19
 * Time: 11:20 AM
 */


class L36_Sku_Search_Admin_Options {
    
	public function __construct() {
		add_action( 'admin_menu', array( &$this, 'add_woocommerce_settings_menu' ), 11 );
		add_action( 'admin_init', array( &$this, 'init' ), 11 );
	}

	public function init() {
		register_setting( 'l36sku', 'l36sku', array( &$this, 'options_validate' ) );
		add_settings_section(
			'l36sku_main',
			__( 'Main Settings', 'l36sku' ),
			array( &$this, 'main_section_text' ),
			'l36sku_options'
		);
		add_settings_field(
			'l36sku_exact_match',
			__( 'Use Exact Match', 'l36sku' ),
			array( &$this, 'exact_match_field' ),
			'l36sku_options',
			'l36sku_main'
		);
		add_settings_field( 'l36sku_query_var',
			__( 'Query var', 'l36sku' ),
			array( &$this, 'query_var_field' ),
			'l36sku_options',
			'l36sku_main'
		);
	}

	public function add_woocommerce_settings_menu() {
		add_submenu_page( 'woocommerce',
			__( 'Simple SKU Search', 'l36sku' ),
			__( 'Simple SKU Search', 'l36sku' ),
			'manage_options',
			'l36-search-by-sku',
			function () {
				$this->build_form();
			} );
	}

	public function build_form() {
		?>
        <div class="wrap">
            <h2><?php _e( 'Simple SKU Search', 'l36sku' ); ?></h2>
            <form action="options.php" method="post">
				<?php settings_fields( 'l36sku' ); ?>
				<?php do_settings_sections( 'l36sku_options' ); ?>
				<?php submit_button(); ?>
            </form>
        </div>
		<?php
	}

	public function options_validate( $input ) {
		$input['exact_match'] = ( $input['exact_match'] == 1 ? 1 : 0 );
		$input['query_var']   = wp_filter_nohtml_kses( $input['query_var'] );

		return $input;
	}

	function main_section_text() {
		echo '<p>' . sprintf( __( 'Please choose whether to use exact match for SKU search and the sku query var (default: %s)', 'l36sku' ), L36_Search_By_Sku::SKU_SEARCH_VAR ) . '</p>';
	}

	public function exact_match_field() {
		$options     = get_option( 'l36sku' );
		$exact_match = isset( $options['exact_match'] ) ? $options['exact_match'] : 1;
		?>
        <input name="l36sku[exact_match]" id='l36sku_exact_match' type="checkbox" value="1" <?php checked( '1', $exact_match ); ?> />
		<?php
	}

	public function query_var_field() {
		$options   = get_option( 'l36sku' );
		$query_var = isset( $options['query_var'] ) ? $options['query_var'] : L36_Search_By_Sku::SKU_SEARCH_VAR;
		?>
        <input name="l36sku[query_var]" id='l36sku_query_var' type="text" value="<?php echo $query_var ?>"/>
		<?php
	}
}


new L36_Sku_Search_Admin_Options();
