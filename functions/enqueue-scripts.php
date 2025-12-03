<?php 
/**
 * 	Collecttion of Style-/CSS-files
 */
function mbfse_child_style_Files(){
	$f_ass = '/assets/';
	$f_CSS = $f_ass.'scss/';
	$f_JS  = $f_ass.'js/';

	wp_enqueue_style(
		'mb-child-main',
		get_stylesheet_directory_uri().'/style.css',
		array('mbfse-menu-mobile'),
		wp_get_theme()->get( 'Version' )
	);

	/*CSS*/
	wp_enqueue_style(
		'mb-child-header',
		get_stylesheet_directory_uri().$f_CSS.'header.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_style(
		'mb-child-styling',
		get_stylesheet_directory_uri().$f_CSS.'main.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_style(
		'mb-child-blog',
		get_stylesheet_directory_uri().$f_CSS.'blog.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_style(
		'mb-child-leistungen',
		get_stylesheet_directory_uri().$f_CSS.'leistungen-slider.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_style(
		'mb-child-webinar',
		get_stylesheet_directory_uri().$f_CSS.'webinar-slider.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_style(
		'mb-child-aboutus',
		get_stylesheet_directory_uri().$f_CSS.'about-us.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);
	
	wp_enqueue_style(
		'mb-child-single',
		get_stylesheet_directory_uri().$f_CSS.'single.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);

	/*JS*/
	wp_enqueue_script(
		'mb-child-script',
		get_stylesheet_directory_uri().$f_JS.'scripts.js',
		array('jquery', 'mbfse-main', 'mbfse-libs-custom-swiper'),
		wp_get_theme()->get( 'Version' )
	);
}
add_action('wp_enqueue_scripts', 'mbfse_child_style_Files', 999);
add_filter( 'render_block', function( $block_content, $block ) {
    if ( empty( $block['blockName'] ) ) {
        return $block_content;
    }
    // Next Page
    if ( $block['blockName'] === 'core/query-pagination-next' ) {
        $block_content = str_replace( 'Nächste Seite', '>', $block_content );
    }
    // Previous Page
    if ( $block['blockName'] === 'core/query-pagination-previous' ) {
        $block_content = str_replace( 'Vorherige Seite', '<', $block_content );
    }
    return $block_content;

}, 10, 3 );
