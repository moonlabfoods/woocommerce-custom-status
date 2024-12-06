<?php
/**
 * Plugin Name: Moonlab Custom Order Status
 * Description: Adds custom order status(es) to WooCommerce
 * Version: 1.0
 * Text Domain: custom-woocommerce
 * Author: James Bell
 * Author URI: https://bdigital.asia
 */

add_action( 'init', 'shipped_status' );
add_filter( 'wc_order_statuses', 'custom_order_status');
add_action( 'admin_head', 'set_shipped_status_color');

function shipped_status() {
    register_post_status( 'wc-shipped', array(
        'label'                     => 'Shipped',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Shipped <span class="count">(%s)</span>', 'Shipped <span class="count">(%s)</span>' )
    ) );
}

function custom_order_status( $order_statuses ) {
    $order_statuses['wc-shipped'] = _x( 'Shipped', 'Order status', 'custom-woocommerce' );
    return $order_statuses;
}

function set_shipped_status_color(){ ?>
    <style>
        .order-status.status-shipped {
            background: darkgreen !important;
            color: white !important;
        }
    </style>
<?php }