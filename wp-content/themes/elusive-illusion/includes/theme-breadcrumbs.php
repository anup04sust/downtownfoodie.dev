<?php

/**
 * @package ERGOV
 * @since Ergov 1.2
 * @author: anup
 */
function theme_breadcrumbs() {

    $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter = ''; // delimiter between crumbs
    $home = 'Home'; // text for the 'Home' link
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $before = '<li class="active"><span class="current">'; // tag before the current crumb
    $after = '</span></li>'; // tag after the current crumb

    global $post, $wp_query;
    $homeLink = get_bloginfo('url');

    if (is_home() || is_front_page()) {

        if ($showOnHome == 1)
            echo '<ol id="crumbs" class="breadcrumb"><li class="startup"><a href="' . $homeLink . '">' . $home . '</a></li></ol>';
    } else {

        //echo '<ol id="crumbs" class="breadcrumb"><li class="startup"><span>You are in: </span></li><li><a href="' . $homeLink . '">' . $home . '</a></li> ' . $delimiter . ' ';
        echo '<ol id="crumbs" class="breadcrumb"><li class="startup"><a href="' . $homeLink . '">' . $home . '</a></li> ' . $delimiter . ' ';

        if (is_category()) {
            $thisCat = get_category(get_query_var('cat'), false);            
            $thisTerm = get_query_var('cat');
            $termObj = get_term_by('id', $thisTerm, 'category');
           
            if (!empty($termObj->parent)) {
                echo ergov_bcm_term_tree($termObj,$before,$after);
            }
            echo $before . single_cat_title('', false). $after;
        } elseif (is_search()) {
            echo $before . 'Search results for "' . get_search_query() . '"' . $after;
        } elseif (is_day()) {
            echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
            echo '<li><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
            echo $before . get_the_time('d') . $after;
        } elseif (is_month()) {
            echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
            echo $before . get_the_time('F') . $after;
        } elseif (is_year()) {
            echo $before . get_the_time('Y') . $after;
        } elseif (is_tax()) {
            $thisTax = get_query_var('taxonomy');
            $thisTerm = get_query_var('term');
            $termObj = get_term_by('slug', $thisTerm, $thisTax);
            if (!empty($termObj->parent)) {
                echo ergov_bcm_term_tree($termObj,$before,$after);
            }
            echo $before . $termObj->name . $after;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $ptype_archive_link = get_post_type_archive_link( $post_type->name );
                
                //$taxonomy_names = get_object_taxonomies( $post_type->name);
                $taxonomies = get_post_taxonomies($post);
                //$terms = wp_get_post_terms( $post_id, $taxonomy, $args );
                $terms = wp_get_post_terms(get_the_ID(), $taxonomies);
                if (empty($terms)) {
                    echo '<li><a href="' .$ptype_archive_link . '">' . $post_type->labels->name . '</a></li>';
                } else {
                  $termObj = end($terms);
                    if (!empty($termObj->parent)) {
                        
                    }
                    $term_link = get_term_link( $termObj->term_id, $termObj->taxonomy );
                    echo '<li>'. sprintf('<a href="%2$s" title="%1$s">%1$s</a>',$termObj->name,$term_link) . '</li>';
                }
                if ($showCurrent == 1)
                    echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, '  ');
                if ($showCurrent == 0)
                    $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                if (!empty($cats))
                    echo '<li>' . $cats . '</li>';
                if ($showCurrent == 1)
                    echo $before . get_the_title() . $after;
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());            
            echo $before . $post_type->labels->name . $after;
        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            if(!empty($cat)){
              $cat = $cat[0];
            echo get_category_parents($cat->term_id, TRUE, ' ' . $delimiter . ' ');
            echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
            }
            
            if ($showCurrent == 1)
                echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
        } elseif (is_page() && !$post->post_parent) {
            if ($showCurrent == 1)
                echo $before . get_the_title() . $after;
        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo $breadcrumbs[$i];
                if ($i != count($breadcrumbs) - 1)
                    echo ' ' . $delimiter . ' ';
            }
            if ($showCurrent == 1)
                echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
        } elseif (is_tag()) {
            echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . 'Articles posted by ' . $userdata->display_name . $after;
        } elseif (is_404()) {
            echo $before . 'Error 404' . $after;
        }

        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ' (';
            echo __(' | Page ') . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ')';
        }

        echo '</ol>';
    }
}

// end ergov_breadcrumbs()
function ergov_bcm_term_tree($term) {   
    if(!empty($term->parent)){
          $term = get_term_by('id', $term->parent, $term->taxonomy);
          $term_link = get_term_link( $term, $term->taxonomy );
          echo sprintf('<li><a href="%1$s" title="%2$s">%2$s</a></li>',$term_link,$term->name);
          ergov_bcm_term_tree($termObj);
    }
}

?>