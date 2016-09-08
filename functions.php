<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */

/**
 * Replace Storefront parent theme Google fonts with custom child theme fonts
 */
function pm_replace_fonts() {
    //wp_dequeue_style( 'storefront-style' );
    wp_dequeue_style( 'storefront-child-style' );
    wp_dequeue_style( 'storefront-fonts' );

    $font_url = 'https://fonts.googleapis.com/css?family=Work+Sans&#038;subset=latin%2Clatin-ext';
    wp_enqueue_style('funcycled-fonts',$font_url,array(),null);
}
add_action( 'wp_enqueue_scripts', 'pm_replace_fonts', 999 );


/**
 * Register our theme stylesheet
 */
function pm_register_stylesheet() {
    wp_enqueue_style( 'funcycled-styles', get_stylesheet_directory_uri().'/assets/css/style.css');
}
add_action( 'wp_enqueue_scripts', 'pm_register_stylesheet',999999999);
//add_action('woo_head', 'pm_register_stylesheet', 99);


/**
 * Remove WooCommerce credit, add our own
 */

add_action( 'init', 'pm_remove_footer_credit', 10 );
function pm_remove_footer_credit () {
    remove_action( 'storefront_footer', 'storefront_credit', 20 );
    add_action( 'storefront_footer', 'pm_storefront_credit', 20 );
} 
function pm_storefront_credit() {
	?>
	<div class="site-info">
	<a title="FunCycled on Facebook" href="https://www.facebook.com/funcycled/" class="fa fa-facebook fa-lg" target="_blank"></a>
		<a title="FunCycled on Pinterest" href="https://pinterest.com/funcycled/" class="fa fa-pinterest fa-lg" target="_blank"></a>
		<a title="FunCycled on Instagram" href="https://instagram.com/funcycled/" class="fa fa-instagram fa-lg" target="_blank"></a>

		&nbsp;&nbsp;&nbsp; &copy; <?php echo get_bloginfo( 'name' ) . ' ' . get_the_date( 'Y' ); ?> &nbsp;&nbsp;&nbsp; <em>Ilium fuit, Troja est.</em>
			
	</div><!-- .site-info -->
	<?php
}

/**
 * Remove Storefront handheld fppter bar
 */

add_action( 'init', 'pm_remove_storefront_handheld_footer_bar' );

function pm_remove_storefront_handheld_footer_bar() {
  remove_action( 'storefront_footer', 'storefront_handheld_footer_bar', 999 );
}

?>
