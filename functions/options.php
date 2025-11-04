<?php 
/**
 * 	Posttype Referenzen
*/
add_action( 'init', 'register_referenzen', 1 );
function register_referenzen(){
	register_post_type( 'referenzen', array(
			'labels'              => array(
				'name'               => 'Referenzen',
				'singular_name'      => 'Referenz',
				'menu_name'          => 'Referenzen',
				'all_items'          => 'Referenzen',
				'add_new'            => 'Referenz',
				'add_new_item'       => 'Neue Referenz hinzufügen',
				'edit'               => 'Bearbeiten',
				'edit_item'          => 'Referenz bearbeiten',
				'new_item'           => 'Neue Referenzen',
				'view_item'          => 'Referenzen ansehen',
				'search_items'       => 'Referenzen durchsuchen',
				'not_found'          => 'Keine Referenzen gefunden.',
				'not_found_in_trash' => 'Keine Referenzen im Papierkorb.',
				'parent_item_colon'  => ''
			),
			'public'              => true,
			'query_var'           => true,
			'show_in_rest'		  => true,
			'has_archive'         => true,
			'rewrite'             => array( 'slug' => 'referenz', 'with_front' => false ),			
			'supports'            => array( 'title', 'revisions', 'editor', 'thumbnail', 'excerpt'),
			'menu_position'       => 9,
			'menu_icon'           => 'dashicons-editor-table',
			'template'     => array(),
			#'capability_type'     => 'post',
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'hierarchical'        => true,
			'show_ui'             => true,
			#'taxonomies'          => array('category') 
		)
	);
}

// CPT-Name ändern

add_filter( 'register_post_type_args', 'fescon_change_Termine_Name', 111111, 2 );
function fescon_change_Termine_Name( $args, $post_type ) {
	
    // Ersetze "mein_cpt" durch den Slug deines Parent-CPT
    if ( 'termin' === $post_type ) {

        // Labels ändern (Name etc.)
		$name = 'Webinare';
		$slug = 'webinare';
        $args['labels']['name'] = $name;
        $args['labels']['singular_name'] = 'Neues Webinar';
		$args['labels']['menu_name'] = $name;

        // Slug ändern
        $args['rewrite']['slug'] = $slug;
		
    }

	
    return $args;
}

// Init Category to Termin
function addCategoryToWebinar(){
	register_taxonomy_for_object_type('category', 'termin');
}
add_action('init', 'addCategoryToWebinar', 15);


/**
 * 	Referenz-Bild in Loop
 */
function get_referenz_logo_func(){
    register_block_type('fse-fescon/referenz-logo-function', array(
        'render_callback' => 'ref_logo_id',
        'uses_context' => array('postId', 'postType'),
    ));
}
add_action('init', 'get_referenz_logo_func', 1);
function ref_logo_id($block) {
        $post_id = isset($block->context['postId']) ? $block->context['postId'] : get_the_ID();
        return referenzLogo($post_id);
}
function referenzLogo($pID){
    $logourl = get_field('firmen-logo', $pID);
    $html = "<figure class='wp-block-post-featured-image'>";
    if($logourl){
        $html .= '<img src="'.$logourl.'" alt="Referenz Logo"/>';
    }
    $html .= "</figure>";
    return $html;
}