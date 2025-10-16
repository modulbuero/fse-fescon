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
			'supports'            => array( 'title', 'revisions' ),
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
add_filter( 'register_post_type_args', 'fescon_change_Termine_Name', 10, 2 );
function fescon_change_Termine_Name( $args, $post_type ) {
    // Ersetze "mein_cpt" durch den Slug deines Parent-CPT
    if ( 'termin' === $post_type ) {

        // Labels ändern (Name etc.)
        $args['labels']['name'] = 'Webinare';
        $args['labels']['singular_name'] = 'Neues Webinar';

        // Slug ändern
        $args['rewrite']['slug'] = 'webinar';

    }
    return $args;
}

// Init Category to Termin
function addCategoryToWebinar(){
	register_taxonomy_for_object_type('category', 'termin');
}
add_action('init', 'addCategoryToWebinar', 15);
