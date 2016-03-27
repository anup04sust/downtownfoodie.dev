<?php

/*
 * @package IllusiveDesign
 * @subpackage Elusive Illusion
 * @since Elusive Illusion 1.0
 */

if (!class_exists('Redux')) {
  return;
}

class ELI_Config {

  var $opt_name = "eli_options";
  var $theme;
  var $args;
  var $media_url;

  function __construct() {
    $this->theme = wp_get_theme();
    $this->media_url = ELUSICVE_THEME_ADMIN_URI . 'images/';
    $this->opt_name = apply_filters('eli_admin_options', $this->opt_name);

    $this->addActions();
    $this->setArgs();
    $this->init();
    $this->addFilters();
  }

  public function addActions() {
    //add_action("redux/extensions/{$this->opt_name}/before", array($this, 'addExtensions'), 0);
    add_action('admin_enqueue_scripts', array($this, 'scripts'));
  }

  public function addFilters() {
    
  }

  public function init() {
    Redux::setArgs($this->opt_name, $this->args);
    $sections = $this->addSections();
    Redux::setSections($this->opt_name, $sections);
  }

  public function setArgs() {
    $this->args = array(
      'opt_name' => $this->opt_name,
      'display_name' => $this->theme->get('Name'),
      'display_version' => $this->theme->get('Version'),
      'menu_type' => 'menu',
      'allow_sub_menu' => true,
      'menu_title' => __('Theme Options', ELUSICVE_THEME_LAN),
      'page_title' => __('Theme Options', ELUSICVE_THEME_LAN),
      'google_api_key' => '',
      'google_update_weekly' => false,
      'async_typography' => true,
      'admin_bar' => true,
      'admin_bar_icon' => 'dashicons-admin-tools',
      'admin_bar_priority' => 50,
      'global_variable' => '',
      'dev_mode' => FALSE,
      'update_notice' => FALSE,
      'customizer' => true,
      'page_priority' => 50,
      'page_parent' => 'themes.php',
      'page_permissions' => 'manage_options',
      'menu_icon' => $this->media_url . 'theme-options.png',
      'last_tab' => '',
      'page_icon' => 'dashicons-admin-customizer',
      'page_slug' => 'eli-options',
      'save_defaults' => TRUE,
      'default_show' => TRUE,
      'default_mark' => '',
      'show_import_export' => TRUE,
      'transient_time' => 60 * MINUTE_IN_SECONDS,
      'output' => TRUE,
      'output_tag' => TRUE,
      'footer_credit' => '',
      'database' => '',
      'hints' => array(
        'icon' => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color' => 'lightgray',
        'icon_size' => 'normal',
        'tip_style' => array(
          'color' => 'red',
          'shadow' => true,
          'rounded' => false,
          'style' => '',
        ),
        'tip_position' => array(
          'my' => 'top left',
          'at' => 'bottom right',
        ),
        'tip_effect' => array(
          'show' => array(
            'effect' => 'slide',
            'duration' => '500',
            'event' => 'mouseover',
          ),
          'hide' => array(
            'effect' => 'slide',
            'duration' => '500',
            'event' => 'click mouseleave',
          ),
        ),
      )
    );

// ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $this->args['admin_bar_links'][] = array(
      'id' => 'redux-docs',
      'href' => 'http://docs.reduxframework.com/',
      'title' => __('Documentation', 'redux-framework-demo'),
    );

    $this->args['admin_bar_links'][] = array(
      //'id'    => 'redux-support',
      'href' => 'https://github.com/ReduxFramework/redux-framework/issues',
      'title' => __('Support', 'redux-framework-demo'),
    );

    $this->args['admin_bar_links'][] = array(
      'id' => 'redux-extensions',
      'href' => 'reduxframework.com/extensions',
      'title' => __('Extensions', 'redux-framework-demo'),
    );

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $this->args['share_icons'][] = array(
      'url' => 'https://github.com/ReduxFramework/ReduxFramework',
      'title' => 'Visit ReduxFramework on GitHub',
      'icon' => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $this->args['share_icons'][] = array(
      'url' => 'https://www.facebook.com/illusivedesign',
      'title' => 'Like us on Facebook',
      'icon' => 'el el-facebook'
    );
    $this->args['share_icons'][] = array(
      'url' => 'https://twitter.com/iLLusiveDesign2',
      'title' => 'Follow us on Twitter',
      'icon' => 'el el-twitter'
    );
    $this->args['share_icons'][] = array(
      'url' => 'https://www.linkedin.com/pub/illusive-design/8a/7a4/951',
      'title' => 'Find us on LinkedIn',
      'icon' => 'el el-linkedin'
    );
    $this->args['share_icons'][] = array(
      'url' => 'https://www.youtube.com/channel/UC4vJqSU7BdgR19t16Y8xMJA',
      'title' => 'Find us on Youtube',
      'icon' => 'el el-youtube'
    );
    // Panel Intro text -> before the form
    if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
      if (!empty($this->args['global_variable'])) {
        $v = $this->args['global_variable'];
      }
      else {
        $v = str_replace('-', '_', $this->args['opt_name']);
      }
      $this->args['intro_text'] = sprintf(__('<p>To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', ELUSICVE_THEME_LAN), $v);
    }
    else {
      $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', ELUSICVE_THEME_LAN);
    }

    // Add content after the form.
    $this->args['footer_text'] = __("<p>&copy;2015 Modified by <a href=\"{$this->theme->ThemeURI}\">{$this->theme->Author}</a></p>", ELUSICVE_THEME_LAN);
  }

  public function addSections() {
    $sections[] = $this->optionBasic();
    $sections[] = $this->optionHeader();
    $sections[] = $this->optionInnerContent();
    $sections[] = $this->optionFooter();
    $sections[] = $this->optionContact();
    $sections[] = $this->optionSocial();
    //$sections[] = $this->optionTweet();
    $sections[] = $this->optionloginScreen();
    $sections[] = $this->frontPageTpl1();


    return apply_filters('add_eli_theme_option', $sections);
  }

  function optionBasic() {
    $fields = array(
      array(
        'id' => 'show_logo',
        'type' => 'switch',
        'title' => __('Show Logo', ELUSICVE_THEME_LAN),
        'subtitle' => __('Others showing site title.', ELUSICVE_THEME_LAN),
        'default' => true,
      ),
      array(
        'id' => 'logo_url',
        'type' => 'media',
        'url' => true,
        'title' => __('Logo', ELUSICVE_THEME_LAN),
        'compiler' => 'true',
        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
        'desc' => __('Basic media uploader with disabled URL input field.', ELUSICVE_THEME_LAN),
        'default' => array('url' => $this->media_url . 'logo.png'),
        'required' => array('show_logo', '=', '1'),
      ),
      array(
        'id' => 'show_logo_sx',
        'type' => 'switch',
        'title' => __('Enable Mobile Logo', ELUSICVE_THEME_LAN),
        'subtitle' => __('In small device  show a alternative Logo', ELUSICVE_THEME_LAN),
        'default' => true,
      ),
      array(
        'id' => 'logo_url_sx',
        'type' => 'media',
        'url' => true,
        'title' => __('Logo', ELUSICVE_THEME_LAN),
        'compiler' => 'true',
        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
        'desc' => __('Basic media uploader with disabled URL input field.', ELUSICVE_THEME_LAN),
        'default' => array('url' => $this->media_url . 'logo-sm.png'),
        'required' => array('show_logo_sx', '=', '1'),
      ),
      array(
        'id' => 'show_tagline',
        'type' => 'switch',
        'title' => __('Show Tagline', ELUSICVE_THEME_LAN),
        'default' => FALSE,
      ),
      array(
        'id' => 'custom_favicon',
        'type' => 'media',
        'url' => true,
        'title' => __('Custom Favicon Icon', ELUSICVE_THEME_LAN),
        'default' => array('url' => $this->media_url . 'favicon.ico'),
        'preview' => false,
      ),
      array(
        'id' => 'show_browserupgrade',
        'type' => 'switch',
        'title' => __('Show Browser Upgrade Message', ELUSICVE_THEME_LAN),
        'subtitle' => __('If Someone use Old Browser like IE6,IE7..', ELUSICVE_THEME_LAN),
        'default' => true,
      ),
    );
    return array(
      'title' => __('Basic Fields', ELUSICVE_THEME_LAN),
      'id' => 'eli-basic',
      'desc' => __('', ELUSICVE_THEME_LAN),
      'customizer_width' => '400px',
      'icon' => 'el el-home',
      'fields' => apply_filters('redux/' . $this->opt_name . '/sections/eli-basic/fields', $fields),
    );
  }

  function optionHeader() {
    $fields = array(
      array(
        'id' => 'active_mobile_menu',
        'type' => 'switch',
        'title' => __('Active Sliding Mobile Menu', ELUSICVE_THEME_LAN),        
        'default' => false,
      ),
      array(
        'id' => 'mobile_menu_theme',
        'type' => 'image_select',
        'title' => __('Mobile Menu Theme', 'mclinic'),
        'options' => Array(
          'theme-ffffff' => $this->media_url . '/patterns/ffffff.png',
          'theme-000000' => $this->media_url . '/patterns/000000.png',
          'theme-333333' => $this->media_url . '/patterns/333333.png',
          'theme-ff0000' => $this->media_url . '/patterns/ff0000.png',
          'theme-6cb543' => $this->media_url . '/patterns/6cb543.png',
          'theme-193874' => $this->media_url . '/patterns/193874.png',
        ),
        'default' => 'theme-ffffff',
      ),
      array(
        'id' => 'show_subtitle',
        'type' => 'switch',
        'title' => __('Show Subtitle', ELUSICVE_THEME_LAN),
        'subtitle' => __('Show subtitle below page title', ELUSICVE_THEME_LAN),
        'default' => false,
      ),
      array(
        'id' => 'is_fixed_top',
        'type' => 'switch',
        'title' => __('Fixed Top/Header', ELUSICVE_THEME_LAN),
        'default' => false,
      ),
      array(
        'id' => 'header-bg',
        'type' => 'color_rgba',
        'output' => array('#header'),
        'title' => __('Header Background', ELUSICVE_THEME_LAN),
        'subtitle' => __('Pick a background color for Header (default: #FFFFFF).', ELUSICVE_THEME_LAN),
        'default' => array(
          'color' => '#FFFFFF',
          'alpha' => '1'
        ),
        'mode' => 'background-color',
      ),
      array(
        'id' => 'header-bg-affix',
        'type' => 'color_rgba',
        'output' => array('#header.affix'),
        'title' => __('Header Background Fixed', ELUSICVE_THEME_LAN),
        'subtitle' => __('Pick a background color for Header (default: #FFFFFF).', ELUSICVE_THEME_LAN),
        'default' => array(
          'color' => '#FFFFFF',
          'alpha' => '.8'
        ),
        'mode' => 'background',
      ),
    );
    return array(
      'title' => __('Page Header', ELUSICVE_THEME_LAN),
      'id' => 'theme-header-otions',
      'icon' => 'el el-website',
      'fields' => apply_filters('redux/' . $this->opt_name . '/sections/header/fields', $fields),
        //'subsection' => TRUE,
    );
  }

  function optionInnerContent() {
    $fields = array(
      array(
        'id' => 'default_page_bg',
        'type' => 'media',
        'url' => true,
        'title' => __('Default Page Background', ELUSICVE_THEME_LAN),
        'compiler' => 'true',        
        'default' => array('url' => $this->media_url . 'default-bg.jpg'),
      ),
      array(
        'id' => 'show_subtitle',
        'type' => 'switch',
        'title' => __('Show Subtitle', ELUSICVE_THEME_LAN),
        'subtitle' => __('Show subtitle below page title', ELUSICVE_THEME_LAN),
        'default' => false,
      ),
      array(
        'id' => 'show_breadcrumbs',
        'type' => 'switch',
        'title' => __('Show Breadcrumbs', ELUSICVE_THEME_LAN),
        'subtitle' => __('Show breadcrumbs inner pages', ELUSICVE_THEME_LAN),
        'default' => false,
      ),
    );
    return array(
      'title' => __('Page Inner', ELUSICVE_THEME_LAN),
      'id' => 'theme-optioninner-content',
      'icon' => 'el el-th-large',
      'fields' => apply_filters('redux/' . $this->opt_name . '/sections/inner-content/fields', $fields),
        //'subsection' => TRUE,
    );
  }

  function optionFooter() {
    $fields = array(
      array(
        'id' => 'show_footer_nav',
        'type' => 'switch',
        'title' => __('Show Footer Navigation', ELUSICVE_THEME_LAN),
        'default' => true,
      ),
      array(
        'id' => 'show_footer_widgets',
        'type' => 'switch',
        'title' => __('Show Footer Widgets', ELUSICVE_THEME_LAN),
        'default' => true,
      ),
      array(
        'id' => 'footer_widgets_count',
        'type' => 'text',
        'title' => __('Show Footer Widgets', ELUSICVE_THEME_LAN),
        'default' => 2,
      ),
      array(
        'id' => 'site_copyright',
        'type' => 'editor',
        'title' => __('Copyright', ELUSICVE_THEME_LAN),
        'default' => '&copy; ' . date('Y') . ' <a href="' . get_bloginfo('site_url') . '">' . get_bloginfo('name') . '</a>',
      ),
      array(
        'id' => 'google_analytics',
        'type' => 'text',
        'title' => __('Google Analytics ID', ELUSICVE_THEME_LAN),
        'default' => 'UA-XXXXX-X',
      ),
      array(
        'id' => 'livechat_active',
        'type' => 'switch',
        'title' => __('LiveChat', ELUSICVE_THEME_LAN),
        'default' => true,
      ),
      array(
        'id' => 'livechat_status',
        'type' => 'button_set',
        'title' => __('LiveChat Status', ELUSICVE_THEME_LAN),
        'default' => 'online',
        'options' => array(
          'online' => 'Online',
          'offline' => 'Offline',
        ),
      ),
      array(
        'id' => 'livechat_scripts',
        'type' => 'ace_editor',
        'title' => __('LiveChat Script', ELUSICVE_THEME_LAN),
        'default' => '',
        'required' => array('livechat_active', '=', '1'),
        'mode' => 'html',
      ),
    );
    return array(
      'title' => __('Footer', ELUSICVE_THEME_LAN),
      'id' => 'eli-footer',
      'icon' => 'el el-adjust',
      'fields' => apply_filters('redux/' . $this->opt_name . '/sections/footer/fields', $fields),
        //'subsection' => TRUE,
    );
  }

  function optionTweet() {
    $fields = array(
      array(
        'id' => 'show_tweet_feed',
        'type' => 'switch',
        'title' => __('Show Tweet Feeds', ELUSICVE_THEME_LAN),
        'default' => true,
      ),
      array(
        'id' => 'tweet_feed_title',
        'type' => 'text',
        'title' => __('Block Title', ELUSICVE_THEME_LAN),
        'default' => 'Tweet feeds',
      ),
      array(
        'id' => 'tweet_api_consumer_key',
        'type' => 'text',
        'title' => __('API Consumer key', ELUSICVE_THEME_LAN),
        'default' => '8mbnJ5zNFFtNTPxobaIwOHftX',
      ),
      array(
        'id' => 'tweet_api_consumer_secret',
        'type' => 'text',
        'title' => __('API Consumer Secret', ELUSICVE_THEME_LAN),
        'default' => 'S7rMqmMN1vCWJLOuQilZMX8VpTWZ8uuTJQuK69Z77mIW1lVDj3',
      ),
      array(
        'id' => 'tweet_api_access_token',
        'type' => 'text',
        'title' => __('API Access Token', ELUSICVE_THEME_LAN),
        'default' => '262489722-wvxZkFQPFzm6FcxxVney65EJz2sFgIZ9gsLMfxZj',
      ),
      array(
        'id' => 'tweet_api_access_secret',
        'type' => 'text',
        'title' => __('API Access Secret', ELUSICVE_THEME_LAN),
        'default' => '2HDXekYaE6hKmVCJevN7QmKboiafHGnfS127KJ1c9g7hf',
      ),
      array(
        'id' => 'tweet_username',
        'type' => 'text',
        'title' => __('Twitter User name', ELUSICVE_THEME_LAN),
        'default' => 'iLLusiveDesign2',
      ),
    );
    return array(
      'title' => __('Tweet', ELUSICVE_THEME_LAN),
      'id' => 'eli-tweets',
      'icon' => 'el el-twitter',
      'fields' => apply_filters('redux/' . $this->opt_name . '/sections/tweets/fields', $fields),
        //'subsection' => TRUE,
    );
  }

  function optionContact() {
    $fields = array(
      array(
        'title' => __('Address', ELUSICVE_THEME_LAN),
        'id' => 'contact_address',
        'type' => 'editor'
      ),
      array(
        'title' => __('Email', ELUSICVE_THEME_LAN),
        'id' => 'contact_email',
        'type' => 'text'
      ),
      array(
        'title' => __('Phone', ELUSICVE_THEME_LAN),
        'id' => 'contact_phone',
        'type' => 'text'
      ),
      array(
        'title' => __('Fax', ELUSICVE_THEME_LAN),
        'id' => 'contact_fax',
        'type' => 'text'
      ),
      array(
        'title' => __('Web Address', ELUSICVE_THEME_LAN),
        'id' => 'contact_website',
        'type' => 'text'
      ),
      array(
        'id' => 'contact_map_script',
        'type' => 'ace_editor',
        'title' => __('Google Map Script', ELUSICVE_THEME_LAN),
        'default' => '',
        'mode' => 'html',
      ),
      array(
        'id' => 'contact_form_shortcode',
        'type' => 'text',
        'title' => __('Add Form Shortcode(Contact Form 7)', ELUSICVE_THEME_LAN),
      ),
    );
    return array(
      'title' => __('Contact', ELUSICVE_THEME_LAN),
      'id' => 'theme-optioncontact',
      'icon' => 'el el-map-marker',
      'fields' => apply_filters('redux/' . $this->opt_name . '/sections/contact/fields', $fields),
        //'subsection' => TRUE,
    );
  }

  function optionSocial() {
    $fields = array(
      array(
        'title' => __('Widget Inner Text', ELUSICVE_THEME_LAN),
        'id' => 'social_icons_prefix',
        'type' => 'text'
      ),
      array(
        'title' => __('Facebook', ELUSICVE_THEME_LAN),
        'id' => 'social_facebook',
        'type' => 'text'
      ),
      array(
        'title' => __('Twitter', ELUSICVE_THEME_LAN),
        'id' => 'social_twitter',
        'type' => 'text'
      ),
      array(
        'title' => __('Google+', ELUSICVE_THEME_LAN),
        'id' => 'social_google-plus',
        'type' => 'text'
      ),
      array(
        'title' => __('Youtube', ELUSICVE_THEME_LAN),
        'id' => 'social_youtube',
        'type' => 'text'
      ),
      array(
        'title' => __('LinkedIn', ELUSICVE_THEME_LAN),
        'id' => 'social_linkedin',
        'type' => 'text'
      ),
      array(
        'title' => __('Pinterest', ELUSICVE_THEME_LAN),
        'id' => 'social_pinterest',
        'type' => 'text'
      ),
      array(
        'title' => __('RSS Feed', ELUSICVE_THEME_LAN),
        'id' => 'social_rss',
        'type' => 'text'
      ),
      array(
        'title' => __('Tumblr', ELUSICVE_THEME_LAN),
        'id' => 'social_tumblr',
        'type' => 'text'
      ),
      array(
        'title' => __('Flickr', ELUSICVE_THEME_LAN),
        'id' => 'social_flickr',
        'type' => 'text'
      ),
      array(
        'title' => __('Instagram', ELUSICVE_THEME_LAN),
        'id' => 'social_instagram',
        'type' => 'text'
      ),
      array(
        'title' => __('Dribbble', ELUSICVE_THEME_LAN),
        'id' => 'social_dribbble',
        'type' => 'text'
      ),
      array(
        'title' => __('Skype', ELUSICVE_THEME_LAN),
        'id' => 'social_skype',
        'type' => 'text'
      ),
      array(
        'title' => __('Github', ELUSICVE_THEME_LAN),
        'id' => 'social_github',
        'type' => 'text'
      ),
      array(
        'title' => __('Slideshare', ELUSICVE_THEME_LAN),
        'id' => 'social_slideshare',
        'type' => 'text'
      ),
      array(
        'title' => __('VK.com', ELUSICVE_THEME_LAN),
        'id' => 'social_vk',
        'type' => 'text'
      ),
    );
    return array(
      'title' => __('Social', ELUSICVE_THEME_LAN),
      'id' => 'theme-optionsocial',
      'icon' => 'el el-star',
      'fields' => apply_filters('redux/' . $this->opt_name . '/sections/social/fields', $fields),
        //'subsection' => TRUE,
    );
  }

  function optionloginScreen() {
    $fields = array(
      array(
        'id' => 'customized-login',
        'type' => 'switch',
        'title' => __('Enable Customized Login Screen', ELUSICVE_THEME_LAN),
        'default' => true,
      ),
      array(
        'id' => 'login_scn_logo',
        'type' => 'media',
        'url' => true,
        'title' => __('Screen Logo', ELUSICVE_THEME_LAN),
        'compiler' => 'true',
        'desc' => __('Basic media uploader with disabled URL input field. maximum image height 84px', ELUSICVE_THEME_LAN),
        'default' => array('url' => $this->media_url . 'logo.png'),
      ),
      array(
        'id' => 'login_scn_bg',
        'type' => 'color',
        'title' => __('Background Color', ELUSICVE_THEME_LAN),
        'default' => '#f1f1f1',
      ),
      array(
        'id' => 'login_scn_bg',
        'type' => 'background',
        'title' => __('Background', ELUSICVE_THEME_LAN),
        'default' => '#f1f1f1',
      ),
      array(
        'id' => 'login_form_bg',
        'type' => 'color_rgba',
        'title' => __('Form Background', ELUSICVE_THEME_LAN),
        'default' => array(
          'color' => '#ffffff',
          'alpha' => '.9'
        )
      ),
      array(
        'id' => 'login_form_border',
        'type' => 'border',
        'title' => __('Form Border', ELUSICVE_THEME_LAN),
        'default' => array(
          'border-color' => '#f4f4f4',
          'border-style' => 'solid',
          'border-top' => '1px',
          'border-right' => '1px',
          'border-bottom' => '1px',
          'border-left' => '1px'
        )
      ),
      array(
        'id' => 'login_form_color',
        'type' => 'color',
        'title' => __('Form Text Color', ELUSICVE_THEME_LAN),
        'default' => '#333333'
      ),
      array(
        'id' => 'login_link_color',
        'type' => 'color',
        'title' => __('Others Link Color', ELUSICVE_THEME_LAN),
        'default' => '#333333'
      ),
      array(
        'id' => 'login_button_bg',
        'type' => 'color',
        'title' => __('Button Color', ELUSICVE_THEME_LAN),
        'default' => '#333333'
      ),
      array(
        'id' => 'login_button_text',
        'type' => 'color',
        'title' => __('Button Text Color', ELUSICVE_THEME_LAN),
        'default' => '#fff'
      ),
    );
    return array(
      'title' => __('Login Screen', ELUSICVE_THEME_LAN),
      'id' => 'eli-login-screen',
      'icon' => 'el el-cogs',
      'fields' => apply_filters('redux/' . $this->opt_name . '/sections/eli-login-screen/fields', $fields),
    );
  }
  function frontPageTpl1() {
    $fields = array(
      array(
        'id' => 'fontpage_tpl1_active',
        'type' => 'switch',
        'title' => __('Active Front Page Template', ELUSICVE_THEME_LAN),      
        'default' => true,
      ),
      
    );
    return array(
      'title' => __('Front Page Layout 1', ELUSICVE_THEME_LAN),
      'id' => 'eli-tpl-front1',
      'desc' => __('If you use page template "Front Page 1"', ELUSICVE_THEME_LAN),
      'customizer_width' => '400px',
      'icon' => 'el el-magic',
      'fields' => apply_filters('redux/' . $this->opt_name . '/sections/tpl-front1/fields', $fields),
    );
  }
  function frontPageTpl2() {
    $fields = array(
      array(
        'id' => 'product_block_title',
        'type' => 'text',
        'title' => __('Product Block Title', ELUSICVE_THEME_LAN),
        'default' => __('Products'),
      ),
      array(
        'id' => 'product_block_style',
        'type' => 'background',
        'output' => array('#products-block'),
        'title' => __('Block Background', ELUSICVE_THEME_LAN),
        'subtitle' => __('Style Block (default: #FFFFFF).', ELUSICVE_THEME_LAN),
        'default' => '#FFFFFF',
        'mode' => 'background',
      ),
      array(
        'id' => 'service_block_title',
        'type' => 'text',
        'title' => __('Service Block Title', ELUSICVE_THEME_LAN),
        'default' => __('Services'),
      ),
      array(
        'id' => 'service_block_style',
        'type' => 'background',
        'output' => array('#service-widgets'),
        'title' => __('Block Background', ELUSICVE_THEME_LAN),
        'subtitle' => __('Style Block (default: #FFFFFF).', ELUSICVE_THEME_LAN),
        'default' => '#000',
        'mode' => 'background',
      ),
      array(
        'id' => 'gallery_block_title',
        'type' => 'text',
        'title' => __('Gallery Block Title', ELUSICVE_THEME_LAN),
        'default' => __('Gallery'),
      ),
      /*      array(
        'id' => 'gallery_album',
        'type' => 'select',
        'data' => 'terms',
        'args' => array('taxonomies'=>'gallery-album'),
        'title' => __('Album', ELUSICVE_THEME_LAN),
        ),
        array(
        'id' => 'gallery_album',
        'type' => 'select',
        'data' => 'posts',
        'multi'=>true,
        'args' => array('post_type'=>'eli_gallery','posts_per_page'=>-1),
        'title' => __('Galleries', ELUSICVE_THEME_LAN),
        ), */
      array(
        'id' => 'tpl2-gallery',
        'type' => 'gallery',
        'title' => __('Add/Edit Gallery', ELUSICVE_THEME_LAN),
        'subtitle' => __('Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', ELUSICVE_THEME_LAN),
        'desc' => __('Select Grid for each image. Small (150X110), Medium (320X230), Large (450X350) in pixel or its rational size.', ELUSICVE_THEME_LAN),
      ),
      array(
        'id' => 'gallery_block_img_count',
        'type' => 'text',
        'title' => __('Number of image show', ELUSICVE_THEME_LAN),
        'default' => 10,
      ),
    );
    return array(
      'title' => __('Front Page 2', ELUSICVE_THEME_LAN),
      'id' => 'eli-tpl-front2',
      'desc' => __('If you use page template "Front Page 2"', ELUSICVE_THEME_LAN),
      'customizer_width' => '400px',
      'icon' => 'el el-magic',
      'fields' => apply_filters('redux/' . $this->opt_name . '/sections/tpl-front2/fields', $fields),
    );
  }

  public function addExtensions($ReduxFramework) {
    return false;
    $path = dirname(__FILE__) . '/extensions/';
    $folders = scandir($path, 1);
    if (empty($folders))
      return false;
    foreach ($folders as $folder) {
      if ($folder === '.' or $folder === '..' or ! is_dir($path . $folder)) {
        continue;
      }
      $extension_class = 'ReduxFramework_Extension_' . $folder;
      if (!class_exists($extension_class)) {
        // In case you wanted override your override, hah.
        $class_file = $path . $folder . '/extension_' . $folder . '.php';
        $class_file = apply_filters('redux/extension/' . $ReduxFramework->args['opt_name'] . '/' . $folder, $class_file);
        if ($class_file) {
          require_once( $class_file );
        }
      }
      if (!isset($ReduxFramework->extensions[$folder])) {
        $ReduxFramework->extensions[$folder] = new $extension_class($ReduxFramework);
      }
    }
  }

  public function scripts() {
    //wp_enqueue_style();
  }

}

$theme_options = new ELI_Config();
$theme_options->init();

if(is_admin()){
  add_filter('attachment_fields_to_edit', 'be_attachment_field_tiles_grid', 10, 2);
  add_filter('attachment_fields_to_save', 'be_attachment_field_tiles_grid_save', 10, 2);
}
function be_attachment_field_tiles_grid($form_fields, $post) {
    $cgrid = get_post_meta($post->ID, 'tiles_grid', true);
    $grid = "<select name='attachments[{$post->ID}][tiles_grid]'>";
    $grid .= "<option value='small' ".selected( $cgrid, 'small',FALSE )  .">".__('Small')."</option>"; 
    $grid .= "<option value='medium' ".selected( $cgrid, 'medium',FALSE )  .">".__('Medium')."</option>"; 
    $grid .= "<option value='large' ".selected( $cgrid, 'large',FALSE )  .">".__('Large')."</option>"; 
    $grid .= '</select>';
    $form_fields['tiles-gallary-grid'] = array(
      'label' => 'Grid',
      'input' => 'html',
      'html' => $grid,     
    );

  return $form_fields;
}
function be_attachment_field_tiles_grid_save($post, $attachment) { 
  if (isset($attachment['tiles_grid']))
    update_post_meta($post['ID'], 'tiles_grid', $attachment['tiles_grid']);

  return $post;
}


