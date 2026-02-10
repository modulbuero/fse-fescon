<?php
function alte_termine_shortcode($atts) {
   // pre_get_posts temporär entfernen
    remove_action('pre_get_posts', 'mbfse_sort_termine_query');
    // Shortcode Attribute
    $atts = shortcode_atts(array(
        'posts_per_page' => 3,
    ), $atts);
    
    // Query Parameter
    $current_year = date('Y');
$today = date('Y-m-d'); // z.B. 2026-02-06

$args = array(
        'post_type' => 'termin',
        'posts_per_page' => $atts['posts_per_page'],
        'orderby' => 'meta_value',
        'order' => 'DESC',
        'meta_key' => '_start_datum',
        'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => '_start_datum',
                'value' => $today,
                'compare' => '<',
                'type' => 'DATE'
            ),
            array(
                'key' => '_start_datum',
                'value' => array($current_year . '-01-01', $current_year . '-12-31'),
                'compare' => 'BETWEEN',
                'type' => 'DATE'
            )
        )
    );

    
    $query = new WP_Query($args);
    
    // Output buffering starten
    ob_start();
    
    if ($query->have_posts()) : ?>
    
        <div class="wp-block-query alignwide mbfse-block-termine-template query-loop-termine old-webinars webinar-shortcode">
            <div class="wp-block-post-template alignwide">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="wp-block-post-featured-image">
                                <?php the_post_thumbnail('medium_large'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="wp-block-group query-text-container mbfse-block-termine-text-container">
                            
                            <?php 
                            // Termin-Infos Block (falls du einen Custom Block hast)
                             echo do_blocks('<!-- wp:fse-modulbuero/termin-infos-block /-->');
                            ?>
                            
                            <h3 class="wp-block-post-title">
                                <?php the_title(); ?>
                            </h3>
                            
                            <div class="wp-block-post-excerpt">
                                <?php
                                add_filter('excerpt_length', function() { return 20; }, 999);
                                the_excerpt(); 
                                remove_filter('excerpt_length', function() { return 20; }, 999);
                                ?>
                            </div>
                            
                            <div class="wp-block-group no-distance-bottom has-global-padding is-layout-constrained wp-block-group-is-layout-constrained">
                                    
                                <div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex">
                                    <div class="wp-block-button">
                                        <a class="wp-block-button__link wp-element-button">Details</a>    
                                    </div>
                                </div>
                                
                                
                                <?php 
                                $categories = get_the_terms(get_the_ID(), 'category');
                                if ($categories && !is_wp_error($categories)) : ?>
                                    <div class="wp-block-post-terms">
                                        <?php foreach ($categories as $category) : ?>
                                            <a href="<?php echo get_term_link($category); ?>"><?php echo esc_html($category->name); ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <a class="wp-block-read-more"  href="<?php the_permalink(); ?>">Weiterlesen</a>
                        
                    </article>
                <?php endwhile; ?>
            </div>
            
            <?php if ($query->max_num_pages > 1) : ?>
                <div class="wp-block-query-pagination alignwide">
                    <?php
                    echo paginate_links(array(
                        'total' => $query->max_num_pages,
                        'current' => max(1, get_query_var('paged')),
                        'prev_text' => '←',
                        'next_text' => '→',
                        'type' => 'list'
                    ));
                    ?>
                </div>
            <?php endif; ?>
            
        </div>
    <?php else : ?>
        <p>Keine alten Webinare in diesem jahr.</p>
    <?php endif;
    
    wp_reset_postdata();
    add_action('pre_get_posts', 'mbfse_sort_termine_query');
    return ob_get_clean();
}
add_shortcode('alte_termine', 'alte_termine_shortcode');
?>