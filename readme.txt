=== Simple SKU Search ===
Contributors: cosminnatea, andreamolnar
Tags: woocommerce, sku, search
Requires at least: 5.0
Tested up to: 5.2.3
Requires PHP: 7.0
License: MIT

WooCommerce plugin to add simple search by SKU using widget or shortcode

== Description ==
We just wanted a plugin to search for the SKU and only the SKU using WooCommerce. Also we wanted to do an exact search for this, although this is configurable.

We develop this plugin completely free of charge and will constantly update new features as required by the community. We do not offer any paid versions for additional features, if you need any other features please send us a request, we will update the plugin according to your needs.

== Installation ==
1. Unzip the downloaded zip file.
2. Upload the plugin folder into the `wp-content/plugins/` directory of your WordPress site.
3. Activate `Simple SKU Search` from Plugins page
4. Use the widget or shortcode anywhere you want
    Widget name: Lab36 Search by Sku Form Widget
    Shorcode name: [l36-sku-search-form]

== Frequently Asked Questions ==
1. How to style the input and button?
We chose not to style the inputs, so they follow your theme styles. If you want to style the inputs we provided some classes so you can customize the appearance.  Use l36-sku-search-wg-container or l36-sku-search-sc-container for this.
2. How to make the input and button stay on the same row?
Just put this in your style.css:
.l36-sku-search-wg-container form, .l36-sku-search-sc-container form {
    display: flex;
}
