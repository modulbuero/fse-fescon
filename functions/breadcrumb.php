<?php
/**
 * Breadcrumb System für Fescon
 */

// Breadcrumb Funktion
function theme_breadcrumb() {
    // Breadcrumb nur auf Frontend anzeigen
    if (is_admin()) return;

    $separator = '<span class="breadcrumb-separator"><i class="bi bi-chevron-right"></i></span>';
    $home_title = 'fescon';
    
    echo '<nav class="breadcrumb-navigation" aria-label="Breadcrumb">';
    echo '<ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">';
    
    // Home Link
    echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
    echo '<a href="' . esc_url(home_url('/')) . '" itemprop="item"><span itemprop="name">' . esc_html($home_title) . '</span></a>';
    echo '<meta itemprop="position" content="1" />';
    echo '</li>';
    
    $position = 2;
    
    // Einzelne Post-Typen
    if (is_single()) {
        $post_type = get_post_type();
        $post_type_obj = get_post_type_object($post_type);
        
        // Post Type Archive Link (wenn nicht "post")
        if ($post_type !== 'post' && $post_type_obj->has_archive) {
            echo $separator;
            echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<a href="' . esc_url(get_post_type_archive_link($post_type)) . '" itemprop="item">';
            echo '<span itemprop="name">' . esc_html($post_type_obj->labels->name) . '</span></a>';
            echo '<meta itemprop="position" content="' . $position++ . '" />';
            echo '</li>';
        }
        
        // Kategorien für normale Posts
        if ($post_type === 'post') {
            echo $separator;
            echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<a href="' . esc_url(get_permalink( get_page_by_path( 'blog' ) )) . '" itemprop="item">';
            echo '<span itemprop="name">Blog</span></a>';
            echo '<meta itemprop="position" content="' . $position++ . '" />';
            echo '</li>';

            // $categories = get_the_category();
            // if ($categories) {
            //     $category = $categories[0];
            //     $cat_parents = array();
                
            //     // Eltern-Kategorien sammeln
            //     while ($category->parent) {
            //         $category = get_category($category->parent);
            //         $cat_parents[] = $category;
            //     }
                
            //     // Eltern-Kategorien ausgeben (umgekehrte Reihenfolge)
            //     $cat_parents = array_reverse($cat_parents);
            //     foreach ($cat_parents as $parent_cat) {
            //         echo $separator;
            //         echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            //         echo '<a href="' . esc_url(get_category_link($parent_cat->term_id)) . '" itemprop="item">';
            //         echo '<span itemprop="name">' . esc_html($parent_cat->name) . '</span></a>';
            //         echo '<meta itemprop="position" content="' . $position++ . '" />';
            //         echo '</li>';
            //     }
                
            //     // Aktuelle Kategorie
            //     $main_category = $categories[0];
            //     echo $separator;
            //     echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            //     echo '<a href="' . esc_url(get_category_link($main_category->term_id)) . '" itemprop="item">';
            //     echo '<span itemprop="name">' . esc_html($main_category->name) . '</span></a>';
            //     echo '<meta itemprop="position" content="' . $position++ . '" />';
            //     echo '</li>';
            // }
        }
        
        // Aktueller Beitrag
        echo $separator;
        echo '<li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name">' . esc_html(get_the_title()) . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    }
    
    // Seiten
    elseif (is_page()) {
        $parent_pages = array();
        $page_id = get_the_ID();
        
        // Eltern-Seiten sammeln
        while ($page_id = wp_get_post_parent_id($page_id)) {
            $parent_pages[] = $page_id;
        }
        
        // Eltern-Seiten ausgeben (umgekehrte Reihenfolge)
        $parent_pages = array_reverse($parent_pages);
        foreach ($parent_pages as $parent_id) {
            echo $separator;
            echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<a href="' . esc_url(get_permalink($parent_id)) . '" itemprop="item">';
            echo '<span itemprop="name">' . esc_html(get_the_title($parent_id)) . '</span></a>';
            echo '<meta itemprop="position" content="' . $position++ . '" />';
            echo '</li>';
        }
        
        // Aktuelle Seite
        echo $separator;
        echo '<li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name">' . esc_html(get_the_title()) . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    }
    
    // Archive
    elseif (is_archive()) {
        if (is_category()) {
            $category = get_queried_object();
            $cat_parents = array();
            
            // Eltern-Kategorien sammeln
            $temp_cat = $category;
            while ($temp_cat->parent) {
                $temp_cat = get_category($temp_cat->parent);
                $cat_parents[] = $temp_cat;
            }
            
            // Eltern-Kategorien ausgeben (umgekehrte Reihenfolge)
            $cat_parents = array_reverse($cat_parents);
            foreach ($cat_parents as $parent_cat) {
                echo $separator;
                echo '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
                echo '<a href="' . esc_url(get_category_link($parent_cat->term_id)) . '" itemprop="item">';
                echo '<span itemprop="name">' . esc_html($parent_cat->name) . '</span></a>';
                echo '<meta itemprop="position" content="' . $position++ . '" />';
                echo '</li>';
            }
            
            echo $separator;
            echo '<li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<span itemprop="name">' . esc_html($category->name) . '</span>';
            echo '<meta itemprop="position" content="' . $position . '" />';
            echo '</li>';
        }
        elseif (is_tag()) {
            echo $separator;
            echo '<li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<span itemprop="name">' . esc_html(single_tag_title('', false)) . '</span>';
            echo '<meta itemprop="position" content="' . $position . '" />';
            echo '</li>';
        }
        elseif (is_post_type_archive()) {
            $post_type_obj = get_queried_object();
            echo $separator;
            echo '<li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<span itemprop="name">' . esc_html($post_type_obj->labels->name) . '</span>';
            echo '<meta itemprop="position" content="' . $position . '" />';
            echo '</li>';
        }
        elseif (is_author()) {
            echo $separator;
            echo '<li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<span itemprop="name">' . esc_html(get_the_author()) . '</span>';
            echo '<meta itemprop="position" content="' . $position . '" />';
            echo '</li>';
        }
        elseif (is_date()) {
            echo $separator;
            echo '<li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<span itemprop="name">' . esc_html(get_the_date()) . '</span>';
            echo '<meta itemprop="position" content="' . $position . '" />';
            echo '</li>';
        }
    }
    
    // Suche
    elseif (is_search()) {
        echo $separator;
        echo '<li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name">' . sprintf(__('Suchergebnisse für: %s', 'your-theme-textdomain'), esc_html(get_search_query())) . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    }
    
    // 404
    elseif (is_404()) {
        echo $separator;
        echo '<li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name">' . __('Seite nicht gefunden', 'your-theme-textdomain') . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    }
    
    echo '</ol>';
    echo '</nav>';
}

// Block Pattern für Breadcrumb registrieren
function theme_register_breadcrumb_pattern() {
    register_block_pattern(
        'fse-fescon/breadcrumb',
        array(
            'title'       => __('Breadcrumb Navigation', 'your-theme-textdomain'),
            'description' => __('Zeigt eine Breadcrumb-Navigation an', 'your-theme-textdomain'),
            'categories'  => array('text'),
            'content'     => '<!-- wp:html --><?php theme_breadcrumb(); ?><!-- /wp:html -->',
        )
    );
}
add_action('init', 'theme_register_breadcrumb_pattern');

// Custom Block registrieren (empfohlene Methode für FSE)
function theme_register_breadcrumb_block() {
    register_block_type('fse-fescon/breadcrumb', array(
        'render_callback' => 'theme_breadcrumb_render',
        'api_version' => 2,
    ));
}
add_action('init', 'theme_register_breadcrumb_block');

function theme_breadcrumb_render($attributes, $content) {
    ob_start();
    theme_breadcrumb();
    return ob_get_clean();
}

// Filter für Archive-Titel (Breadcrumb vor dem Titel einfügen)
function theme_add_breadcrumb_before_archive_title($title) {
    if (is_archive() || is_search()) {
        ob_start();
        theme_breadcrumb();
        $breadcrumb = ob_get_clean();
        return $breadcrumb . $title;
    }
    return $title;
}
add_filter('get_the_archive_title', 'theme_add_breadcrumb_before_archive_title');