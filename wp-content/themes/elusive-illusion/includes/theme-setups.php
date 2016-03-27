<?php

/*
 * @package IllusiveDesign
 * @subpackage Elusive Illusion
 * @since Elusive Illusion 1.0
 */
/*
 * Theme Supports
 */
if (!function_exists('eli_wptheme_setup')) :

    function eli_wptheme_setup() {
        load_theme_textdomain(ELUSICVE_THEME_LAN, ELUSICVE_THEME_PATH . 'languages');
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_post_type_support('page', 'excerpt');
        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ));
        add_theme_support('post-formats', array(
            'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio',
        ));
        add_theme_support('post-thumbnails');
        //set_post_thumbnail_size(825, 510, true);
        //add_image_size('square-thumb', 480, 480, true);

        register_nav_menu('primary-menu', __('Primary Menu', ELUSICVE_THEME_LAN));
        register_nav_menu('secondary-menu', __('Secondary Menu', ELUSICVE_THEME_LAN));
        //register_nav_menu('mobile-nav', __('Small Device Menu', ELUSICVE_THEME_LAN));
        //register_nav_menu('footer-menu', __('Footer Menu', ELUSICVE_THEME_LAN));
    }

    add_action('after_setup_theme', 'eli_wptheme_setup');
endif;

if (!function_exists('eli_wptheme_scripts')) :

    function eli_wptheme_scripts() {
        global $drjoseph_options;
        /* Fonts */
        $fonts = array(
            'Varela Round' => '400',
        );
        wp_enqueue_style('theme-fonts', theme_font_url($fonts), array(), null);
        wp_enqueue_style('font-awesome', ELUSICVE_THEME_ASSETS . 'css/font-awesome.min.css');
        /* Style */
        wp_enqueue_style('bootstrap', ELUSICVE_THEME_ASSETS . 'css/bootstrap.min.css');

        wp_enqueue_style('mmenu-css', ELUSICVE_THEME_ASSETS . 'css/jquery.mmenu.all.min.css');
        wp_enqueue_style('bootstrap-datetimepicker', ELUSICVE_THEME_ASSETS . 'css/bootstrap-datetimepicker.min.css');
        wp_enqueue_style('jquery.mCustomScrollbar-css', ELUSICVE_THEME_ASSETS . 'css/jquery.mCustomScrollbar.css');
        wp_enqueue_style('eli-css', ELUSICVE_THEME_ASSETS . 'css/main.css', array('bootstrap'));
        /* Javascripts */
        wp_enqueue_script('bootstrap', ELUSICVE_THEME_ASSETS . 'js/vendor/bootstrap.min.js', array('jquery'), 3.0, TRUE);
        //wp_enqueue_script('mmenu', ELUSICVE_THEME_ASSETS . 'js/vendor/jquery.mmenu.min.all.js', array('jquery'), 3.0, TRUE);
        //wp_enqueue_script('owl', ELUSICVE_THEME_ASSETS . 'js/vendor/owl.carousel.min.js', array('jquery'), 3.0, TRUE);
        wp_enqueue_script('easing', ELUSICVE_THEME_ASSETS . 'js/vendor/jquery.easing.1.3.js', array('jquery'), 3.0, TRUE);
        wp_enqueue_script('backstretch', ELUSICVE_THEME_ASSETS . 'js/vendor/jquery.backstretch.min.js', array('jquery'), 3.0, TRUE);
        wp_enqueue_script('enquire', ELUSICVE_THEME_ASSETS . 'js/vendor/enquire.min.js', array('jquery'), 3.0, TRUE);
        wp_enqueue_script('moment', ELUSICVE_THEME_ASSETS . 'js/vendor/moment.js', array('jquery'), 3.0, TRUE);
        wp_enqueue_script('datetimepicker', ELUSICVE_THEME_ASSETS . 'js/vendor/bootstrap-datetimepicker.min.js', array('jquery'), 3.0, TRUE);
        wp_enqueue_style('chocolat-css', ELUSICVE_THEME_ASSETS . 'chocolat-lightbox/css/chocolat.css');
        wp_enqueue_script('isotope', ELUSICVE_THEME_ASSETS . 'js/vendor/isotope.pkgd.min.js', array('jquery'), 3.0, TRUE);
        wp_enqueue_script('chocolat-lightbox', ELUSICVE_THEME_ASSETS . 'chocolat-lightbox/js/jquery.chocolat.min.js', array('jquery'), 3.0, TRUE);
        wp_enqueue_script('mCustomScrollbar', ELUSICVE_THEME_ASSETS . 'js/vendor/jquery.mCustomScrollbar.concat.min.js', array('jquery'), 3.0, TRUE);
        if (is_page_template('tpl-frotpage2.php')) {
            wp_enqueue_style('camera-css', ELUSICVE_THEME_ASSETS . 'css/camera.css');
            wp_enqueue_script('mobile.customized', ELUSICVE_THEME_ASSETS . 'js/vendor/jquery.mobile.customized.min.js', array('jquery'), 3.0, TRUE);
            wp_enqueue_script('camera', ELUSICVE_THEME_ASSETS . 'js/vendor/camera.min.js', array('jquery'), 3.0, TRUE);
        }
        wp_enqueue_script('eli-js', ELUSICVE_THEME_ASSETS . 'js/eli-theme.js', array('jquery', 'masonry'), 1.0, TRUE);
        $eli_options = get_eli_options();
        $page_id = get_the_ID();
        $page_bg_img_url = get_field('page_bg_image', $page_id);
        $page_bg_img_url = empty($page_bg_img_url) ? $eli_options['default_page_bg']['url'] : $page_bg_img_url;

        wp_localize_script('eli-js', 'eli_obj', array(
            'site_url' => get_site_url(),
            'ajaxUrl' => admin_url('ajax.php'),
            'mm_theme' => $eli_options['mobile_menu_theme'],
            'mm_show_logo' => ($eli_options['show_logo_sx']) ? TRUE : FALSE,
            'mm_logo' => $eli_options['logo_url_sx']['url'],
            'mm_close' => MCLINIC_THEME_URL . '/images/mm-close.png',
            'page_bg_img' => $page_bg_img_url,
                )
        );
    }

    add_action('wp_enqueue_scripts', 'eli_wptheme_scripts');
endif;