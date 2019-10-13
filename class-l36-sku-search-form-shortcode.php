<?php
/**
 * Created by Lab36.
 * User: Cosmin Natea (cosmin.natea@lab36.ro)
 * Date: 10/12/19
 * Time: 5:13 PM
 */


/**
 * Class L36_Sku_Search_Form_Shortcode
 *
 * Shortcode for the search by sku form
 */
class L36_Sku_Search_Form_Shortcode {

	public function __construct() {
		add_shortcode( 'l36-sku-search-form', array( $this, 'display_search_form' ) );
	}


	public function display_search_form() {
		ob_start();
		L36_Sku_Search_Form_Shortcode::build_search_form();
		$html = ob_get_contents();
		ob_end_clean();

		return $html;
	}

	public static function build_search_form() {
		$sku = get_query_var( L36_Search_By_Sku::get_sku_search_var(), false );
		?>
        <div class="l36-sku-search-sc-container">
            <form method="get" action="<?php echo get_home_url(); ?>">
                <input type="text"
                       placeholder="<?php _e( 'SKU:', 'l36sku' ); ?>"
                       value="<?php echo $sku; ?>"
                       name="<?php echo L36_Search_By_Sku::get_sku_search_var(); ?>"
                       id="l36_sku_search_<?php echo L36_Search_By_Sku::get_sku_search_var(); ?>">
                <input type="hidden" name="post_type" value="product" id="l36_sku_search_post_type">
                <input type="submit"
                       value="<?php _e( 'Search', 'l36sku' ); ?>"
                       class="l36-sku-search-sc-submit">
            </form>
        </div>
		<?php
	}
}


new L36_Sku_Search_Form_Shortcode();
