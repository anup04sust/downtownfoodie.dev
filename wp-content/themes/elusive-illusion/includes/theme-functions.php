<?php
/*
 * @package IllusiveDesign
 * @subpackage Elusive Illusion
 * @since Elusive Illusion 1.0
 */
/*
 * WP Hooks
 */
add_action('wp_head', 'theme_custom_favicon');
add_action('wp_head', 'theme_apple_touch_icon');
add_action('wp_head', 'theme_humans_txt');
add_action('wp_footer', 'theme_google_analytics');
add_action('wp_footer', 'theme_livechat_scripts');
add_action('wp_footer', 'theme_mobileMenu');
add_shortcode('inner_tittle', 'theme_custom_inner_title');
add_shortcode('iconbox', 'theme_custom_iconbox');
add_shortcode('small_text', 'theme_custom_small_text');
add_shortcode('custom_scroller', 'customscroll_fixdheight_shortcode');
/*
 * Theme Hooks
 */
add_action('eli_after_body', 'theme_browserupgrade');

function eli_wpcf7_form_elements($html) {
    $text = 'Please select...';
    $html = str_replace('<option value="">---</option>', '<option value="">' . $text . '</option>', $html);
    return $html;
}

add_filter('wpcf7_form_elements', 'eli_wpcf7_form_elements');
/*
 * add custom  favicon
 */

function theme_mobileMenu() {
    $acive_mm = get_eli_options('active_mobile_menu');
    if (!empty($acive_mm)) {
        wp_nav_menu(array('theme_location' => 'mobile-nav', 'menu_class' => 'mm-nav', 'menu_id' => '', 'container_id' => 'mobilemenu-container', 'container_class' => 'mm-menu mm-offcanvas'));
    }
}

function theme_custom_favicon() {
    global $eli_options;
    if (!empty($eli_options['custom_favicon'])) {
        printf('<link rel="shortcut icon" href="%s" type="image/x-icon">', $eli_options['custom_favicon']['url']);
        printf('<link rel="icon" href="%s" type="image/x-icon">', $eli_options['custom_favicon']['url']);
    }
}

function theme_apple_touch_icon() {
    global $eli_options;
    if (!empty($eli_options['apple_touch_icon'])) {
        printf('<link rel="apple-touch-icon" href="%s">', $eli_options['custom_favicon']['url']);
    }
}

function theme_humans_txt() {
    global $eli_options;
    if (!empty($eli_options['humans_txt'])) {
        $link = DRJOSEPH_THEME_URL . '/humans.txt';
        echo "<link rel='author' href='{$link}' />";
    }
}

function theme_browserupgrade() {
    global $eli_options;
    if (!empty($eli_options['show_browserupgrade'])) {
        echo '<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->';
    }
}

function theme_google_analytics() {
    global $eli_options;
    if (!empty($eli_options['google_analytics'])) {

        $analytics = "<!-- Google Analytics: change {$eli_options['google_analytics']} to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','{$eli_options['google_analytics']}','auto');ga('send','pageview');
        </script>";
    }
}

function theme_layout_style() {
    global $eli_options;
    $container = (!empty($eli_options['layout']) && $eli_options['layout'] == 'fluid') ? 'container-fluid' : 'container';
    echo $container;
}

function theme_social_links($echo = TRUE) {
    global $eli_options;
    $services = array('facebook', 'twitter', 'google-plus', 'youtube', 'linkedin', 'pinterest', 'rss', 'tumblr', 'flickr', 'instagram', 'dribbble', 'skype', 'github', 'slideshare', 'vk');
    $social = '<ul  class="theme_social">';
    $prefix = $eli_options['social_icons_prefix'];
    if (!empty($prefix)) {
        $social .= '<li class="inner-dsc"><span class="sr">' . $prefix . '</span></li>';
    }

    foreach ($services as $service) :
        $active[$service] = $eli_options['social_' . $service];
        if (!empty($active[$service])) {
            $social .= '<li><a href="' . $active[$service] . '" target="_BLANK" class="social-icon ' . $service . '" title="' . __('Follow us on ', 'mclinic') . $service . '"><i class="fa fa-' . $service . '"></i></a></li>';
        }
    endforeach;
    $social .= '</ul>';
    if ($echo) {
        echo $social;
    } else {
        return $social;
    }
}

if (!function_exists('theme_primary_menu')) {

    function theme_primary_menu() {
        wp_nav_menu(array(
            'theme_location' => 'primary-menu',
            'container' => 'div',
            'container_class' => 'navbar-primary hidden-xs col-sm-12 col-md-9',
            'container_id' => 'main_menu',
            'menu_class' => 'nav navbar-nav pull-right',
            'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
            'depth' => 4,
            'walker' => new wp_bootstrap_navwalker()
        ));
    }

}

function theme_livechat_scripts() {
    global $eli_options;
    if (!empty($eli_options['livechat_active'])) {
        echo $eli_options['livechat_scripts'];
    }
}

if (!function_exists('theme_font_url')) {

    /**
     * Display the classes for the footer element.
     * @since 1.2
     */
    function theme_font_url($font_family = '', $weight = '') {
        $font_url = '';
        /*
         * Translators: If there are characters in your language that are not supported
         * by Lato, translate this to 'off'. Do not translate into your own language.
         */
        if (empty($font_family)) {
            $font_family = 'Open Sans';
        }

        if (empty($weight)) {
            $weight = '400,300,300italic,400italic,600,600italic,700,700italic';
        }

        if (is_array($font_family)) {
            $url = '';
            $index = 0;
            foreach ($font_family as $family => $weight) {
                if ($index != 0) {
                    $url .= '|';
                }
//$bind_family = str_replace(" ", "+", $family);
                $bind_weight = str_replace(" ", "", $weight);
                $url .= $family . ':' . $bind_weight;


                $index++;
            }
            $urlencode = urlencode($url);
        } else {
//$bind_family = str_replace(" ", "+", $font_family);
            $bind_weight = str_replace(" ", "", $weight);
            $urlencode = urlencode($font_family . ':' . $bind_weight);
        }
        $font_url = add_query_arg('family', $urlencode, "//fonts.googleapis.com/css");

        return $font_url;
    }

}

function theme_page_title($display = true) {
    global $wp_locale, $page, $paged;

    $m = get_query_var('m');
    $year = get_query_var('year');
    $monthnum = get_query_var('monthnum');
    $day = get_query_var('day');
    $search = get_query_var('s');
    $title = '';

    $t_sep = '%WP_TITILE_SEP%'; // Temporary separator, for accurate flipping, if necessary
    // If there is a post
    if (is_single() || ( is_home() && !is_front_page() ) || ( is_page() && !is_front_page() )) {
        $title = single_post_title('', false);
    }

    // If there's a post type archive
    if (is_post_type_archive()) {
        $post_type = get_query_var('post_type');
        if (is_array($post_type))
            $post_type = reset($post_type);
        $post_type_object = get_post_type_object($post_type);
        if (!$post_type_object->has_archive)
            $title = post_type_archive_title('', false);
    }

    // If there's a category or tag
    if (is_category() || is_tag()) {
        $title = single_term_title('', false);
    }

    // If there's a taxonomy
    if (is_tax()) {
        $term = get_queried_object();
        if ($term) {
            $tax = get_taxonomy($term->taxonomy);
            $title = single_term_title('', '', false);
        }
    }

    // If there's an author
    if (is_author() && !is_post_type_archive()) {
        $author = get_queried_object();
        if ($author)
            $title = $author->display_name;
    }

    // Post type archives with has_archive should override terms.
    if (is_post_type_archive() && $post_type_object->has_archive)
        $title = post_type_archive_title('', false);

    // If there's a month
    if (is_archive() && !empty($m)) {
        $my_year = substr($m, 0, 4);
        $my_month = $wp_locale->get_month(substr($m, 4, 2));
        $my_day = intval(substr($m, 6, 2));
        $title = $my_year . ( $my_month ? $t_sep . $my_month : '' ) . ( $my_day ? $t_sep . $my_day : '' );
    }

    // If there's a year
    if (is_archive() && !empty($year)) {
        $title = $year;
        if (!empty($monthnum))
            $title .= $t_sep . $wp_locale->get_month($monthnum);
        if (!empty($day))
            $title .= $t_sep . zeroise($day, 2);
    }

    // If it's a search
    if (is_search()) {
        /* translators: 1: separator, 2: search phrase */
        $title = sprintf(__('Search Results %1$s %2$s'), $t_sep, strip_tags($search));
    }

    // If it's a 404 page
    if (is_404()) {
        $title = __('Page not found');
    }

    // Send it out
    if ($display)
        echo $title;
    else
        return $title;
}

function theme_page_subtitle($display = true) {
    global $wp_locale, $page, $paged;
    $subtitle = get_option('blogname');

// If there is a post
    if (is_page() || is_single()) {
        $page_id = get_the_ID();
        $subtitle = get_field('page_sub_title', $page_id);
        $subtitle = empty($subtitle) ? get_the_title($page_id) : $subtitle;
    }
//    if (is_single()) {
//        $post_type = get_query_var('post_type');
//        $post_typeobj = get_post_type_object($post_type);
//        $subtitle = $post_typeobj->labels->name;
//    }
    if (is_tax()) {
        $term = get_queried_object();
        if ($term) {
            $tax = get_taxonomy($term->taxonomy);
            $subtitle = $tax->labels->name;
        }
    }
// Send it out
    if ($display)
        echo $subtitle;
    else
        return $subtitle;
}

/* Login Screen Hooks */
add_action('login_enqueue_scripts', 'eli_login_scripts');

function eli_login_scripts() {
    global $eli_options;
//wpprint($eli_options);
    if (!empty($eli_options['customized-login'])) {
        $logo = $eli_options['login_scn_logo']['url'];
        ?>
        <style type="text/css">
            body.login{
                background-color:<?php echo $eli_options['login_scn_bg']['background-color']; ?>;
                background-repeat:<?php echo $eli_options['login_scn_bg']['background-repeat']; ?>;
                background-size:<?php echo $eli_options['login_scn_bg']['background-size']; ?>;
                background-position:<?php echo $eli_options['login_scn_bg']['background-position']; ?>;
                background-image:url(<?php echo $eli_options['login_scn_bg']['background-image']; ?>);
            }
            .login h1 a {
                background-image: url(<?php echo $logo; ?>);
                margin-bottom: 15px;
                width:100%;    
                background-size:100% auto;
                background-position: center top;
            }
            .login #loginform{
                border-width: 0;
                background-color: <?php echo $eli_options['login_form_bg']['rgba']; ?>;
                border-color: <?php echo $eli_options['login_form_border']['border-color']; ?>;
                border-style: <?php echo $eli_options['login_form_border']['border-style']; ?>;
                border-left-width: <?php echo $eli_options['login_form_border']['border-left']; ?>;
                border-top-width: <?php echo $eli_options['login_form_border']['border-top']; ?>;
                border-right-width: <?php echo $eli_options['login_form_border']['border-right']; ?>;
                border-bottom-width: <?php echo $eli_options['login_form_border']['border-bottom']; ?>;
            }
            .login #loginform label{
                color:<?php echo $eli_options['login_form_color']; ?>;       
            }
            .login #loginform input.button{
                border:0;
                color:<?php echo $eli_options['login_button_text']; ?>;
                background:<?php echo $eli_options['login_button_bg']; ?>;
                border-radius: 2px;        
                box-shadow: none;
                padding: 0 25px;
            }
            .login #nav a,.login #backtoblog a{
                color:<?php echo $eli_options['login_link_color']; ?>;       
            }

        </style>
        <?php
    }
}

function eli_login_logo_url($url) {
    global $eli_options;
    if (!empty($eli_options['customized-login'])) {
        $url = home_url();
    }
    return $url;
}

add_filter('login_headerurl', 'eli_login_logo_url');

function eli_login_logo_url_title($title) {
    global $eli_options;
    if (!empty($eli_options['customized-login'])) {
        $title = get_bloginfo('name');
    }
    return $title;
}

add_filter('login_headertitle', 'eli_login_logo_url_title');

function eli_array_insert(&$array, $position, $insert_array) {
    $first_array = array_splice($array, 0, $position);
    $array = array_merge($first_array, $insert_array, $array);
}

function theme_submenu_links() {
    $post_ID = get_the_ID();
    if (!empty($post_ID)) {
        $parent_id = wp_get_post_parent_id($post_ID);
        $parent_id = empty($parent_id) ? $post_ID : $parent_id;
        $subpages = get_pages(array('sort_column' => 'menu_order', 'child_of' => $parent_id));
        $menu_html = '';
        $title = get_field('page_submenu_title', $parent_id);
        $link = get_the_permalink($parent_id);
        $active = is_page($parent_id) ? 'active-link' : '';
        $terget = '';
        $menu_html .= sprintf('<li class="subpage-menuitem %3$s" %4$s><a href="%2$s" title="%1$s">%1$s</a></li>', $title, $link, $active, $terget);
        if (!empty($subpages)) {
            foreach ($subpages as $key => $page) {
                $title = get_field('page_submenu_title', $page->ID);
                $title = empty($title)?$page->post_title:$title;
                $link = get_the_permalink($page->ID);
                $active = is_page($page->ID) ? 'active-link' : '';
                $ext_link = get_field('page_external_url', $page->ID);
                $terget = !empty($ext_link) ? ' target="_blank" ' : '';
                $link = empty($ext_link) ? $link : $ext_link;
                $menu_html .= sprintf('<li class="subpage-menuitem %3$s" ><a href="%2$s" title="%1$s" %4$s>%1$s</a></li>', $title, $link, $active, $terget);
            }
        }
        echo sprintf('<ul class="page-submenu">%s</ul>', $menu_html);
    }
}

function theme_custom_inner_title($attrs, $contents) {
    return sprintf('<h2 class="page-inner-title">%s</h2>', $contents);
}

function theme_custom_iconbox($atts, $contents) {
    $atts = shortcode_atts(
            array(
        'title' => '',
        'icon' => '',
        'bottom' => '',
        'link' => '',
            ), $atts, 'iconbox');
    $contents = '';
    $contents .= empty($atts['title']) ? '' : sprintf('<span class="sr">%s</span>', $atts['title']);
    $icon = empty($atts['icon']) ? '' : sprintf('<img src="%s" alt="icon" />', $atts['icon']);
    $contents .= empty($atts['link']) ? $icon : sprintf('<a href="%1$s" target="_BLANK">%2$s</a>', $atts['link'], $icon);
    $contents .= empty($atts['bottom']) ? '' : sprintf('<span class="sr sr-bottom">%s</span>', $atts['bottom']);

    return sprintf('<div class="iconbox">%s</div>', $contents);
}

function theme_custom_small_text($attrs, $contents) {
    $contents = wpautop($contents);
    return sprintf('<div class="small-text">%s</div>', $contents);
}

function customscroll_fixdheight_shortcode($atts,$contents) {
    $atts = shortcode_atts(
            array(
        'height' => '',
        'class' => '',        
            ), $atts, 'custom_scroller');
    $contents = do_shortcode($contents);
    $height = !empty($atts['height'])? 'style="height:'.$atts['height'].'"':'';
    return sprintf('<div class="fixed-height-content custom-scroller %3$s" %2$s>%1$s</div>', $contents,$height,$atts['class']);
}
