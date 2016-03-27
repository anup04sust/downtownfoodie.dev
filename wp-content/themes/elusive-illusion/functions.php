<?php
/*
 * @package WPExpress
 * @subpackage Elusive Illusion
 * @since Elusive Illusion 1.0
 */
if(!defined('ABSPATH')) die();
define('ELUSIVE_ELLUSION_V', '1.1');
define('ELUSICVE_THEME_PATH',get_template_directory().'/');
define('ELUSICVE_THEME_INC',ELUSICVE_THEME_PATH.'includes/');
define('ELUSICVE_THEME_LAN',ELUSICVE_THEME_PATH.'ellusiveillusion');
define('ELUSICVE_THEME_SHORT',ELUSICVE_THEME_PATH.'eli');
define('ELUSICVE_THEME_URI',get_template_directory_uri().'/');
define('ELUSICVE_THEME_ASSETS',ELUSICVE_THEME_URI.'assets/');
define('ELUSICVE_THEME_ADMIN',ELUSICVE_THEME_PATH.'admin/');
define('ELUSICVE_THEME_ADMIN_URI',ELUSICVE_THEME_URI.'admin/');

/*
 * Admin Required Files
 * =============================================================================
 */
require_once ELUSICVE_THEME_ADMIN.'tgm-plugin-activation.php';
require_once ELUSICVE_THEME_ADMIN.'ReduxCore/framework.php';
require_once ELUSICVE_THEME_ADMIN.'eli-config.php';
require_once ELUSICVE_THEME_ADMIN.'admin-init.php';

/*
 * Required Files
 * =============================================================================
 */
require_once ELUSICVE_THEME_INC.'navwalker.php';
require_once ELUSICVE_THEME_INC.'theme-setups.php';
require_once ELUSICVE_THEME_INC.'theme-functions.php';
require_once ELUSICVE_THEME_INC.'theme-breadcrumbs.php';


/*
 * Register Content type
 * =============================================================================
 */
//require_once ELUSICVE_THEME_INC.'class-slider-content-type.php';
//require_once ELUSICVE_THEME_INC.'class-products-content-type.php';
//require_once ELUSICVE_THEME_INC.'class-gallery-content-type.php';
//require_once ELUSICVE_THEME_INC.'class-service-content-type.php';
//require_once ELUSICVE_THEME_INC.'class-testimonial-content-type.php';

/*
 * Register Widgets
 * =============================================================================
 */
require_once ELUSICVE_THEME_INC.'widgets/widgets-init.php';
require_once ELUSICVE_THEME_INC.'tweetie/tweet-init.php';


/*
 * Function for theme options
 * =============================================================================
 */
function get_eli_options($key = null){
    global $eli_options;
    return !empty($key) ? $eli_options[$key]: $eli_options;
}
function wpprint($data){
  echo '<pre>';
  print_r($data);
  echo '</pre>';
}

