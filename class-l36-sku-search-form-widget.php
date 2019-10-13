<?php
/**
 * Created by Lab36.
 * User: Cosmin Natea (cosmin.natea@lab36.ro)
 * Date: 10/12/19
 * Time: 5:13 PM
 */


/**
 * Class L36_Sku_Search_Form_Widget
 *
 * Widget for the search by sku form
 */
class L36_Sku_Search_Form_Widget extends WP_Widget {

	public function __construct() {
		$widget_options = array(
			'classname'   => 'l36-sku-search-form',
			'description' => __( 'Search by Sku Form Widget', 'l36sku' ),
		);
		parent::__construct(
			'l36_sku_search_form',
			__( 'Lab36 Search by Sku Form Widget', 'l36sku' ),
			$widget_options
		);
	}


	public function widget( $args, $instance ) {
		$sku = get_query_var( L36_Search_By_Sku::get_sku_search_var(), false );
		echo $args['before_widget'];
		?>
        <div class="l36-sku-search-wg-container">
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
		echo $args['after_widget'];
	}


	public function form( $instance ) {
	}


	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		return $instance;
	}
}


function l36_register_search_by_sku_form_widget() {
	register_widget( 'L36_Sku_Search_Form_Widget' );
}

add_action( 'widgets_init', 'l36_register_search_by_sku_form_widget' );
