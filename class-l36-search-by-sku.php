<?php
/**
 * Created by Lab36.
 * User: Cosmin Natea (cosmin.natea@lab36.ro)
 * Date: 10/12/19
 * Time: 4:47 PM
 */


/**
 * Class L36SearchBySku
 *
 * Add query var for sku search and modify the main query if set
 */
class L36_Search_By_Sku {

	const SKU_SEARCH_VAR = 'ssku';

	public function __construct() {
		add_filter( 'query_vars', array( &$this, 'add_query_var_sku' ), 11 );
		add_action( 'pre_get_posts', array( &$this, 'search_by_sku' ) );
	}


	public function add_query_var_sku( $vars ) {
		$vars[] = L36_Search_By_Sku::get_sku_search_var();

		return $vars;
	}


	function search_by_sku( $query ) {
		$sku              = get_query_var( L36_Search_By_Sku::get_sku_search_var(), false );
		$options          = get_option( 'l36sku' );
		$use_exact_match  = isset( $options['exact_match'] ) ? $options['exact_match'] : 1;
		$compare_operator = $use_exact_match ? '=' : 'LIKE';

		if ( ! $this->should_sku_search_run( $query, $sku ) ) {
			return;
		}

		$meta_query_array = array( 'relation' => 'AND' );
		array_push(
			$meta_query_array,
			array( 'key' => '_sku', 'value' => $sku, 'compare' => $compare_operator )
		);
		$query->set( 'meta_query', $meta_query_array );
	}

	private function should_sku_search_run( $query, $sku ) {
		if ( $query->is_main_query() && ! is_admin() && $sku ) {
			return true;
		}

		return false;
	}

	public static function get_sku_search_var() {
		$options = get_option( 'l36sku' );

		return isset( $options['query_var'] ) ? $options['query_var'] : L36_Search_By_Sku::SKU_SEARCH_VAR;
	}
}


new L36_Search_By_Sku();
