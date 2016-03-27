<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class-service-content-type
 *
 * @author Anup Biswas <anup@illusivedesign.net>
 */
class Testimonials_Content_Type {

  private $post_type = 'eli_testimonial';
  private $slug = 'testimonial';
  private $lan = ELUSICVE_THEME_LAN;

  function __construct() {
    add_action('init', array($this, 'register'));
    add_action('widgets_init', array($this, 'widgets'));
    $this->metabox();
  }

  public function register() {
    $service_labels = array(
      'name' => _x('Testimonial', 'post type general name', $this->lan),
      'singular_name' => _x('Testimonial', 'post type singular name', $this->lan),
      'menu_name' => _x('Testimonials', 'admin menu', $this->lan),
      'name_admin_bar' => _x('Testimonial', 'add new on admin bar', $this->lan),
      'add_new' => _x('Add New', 'Testimonial', $this->lan),
      'add_new_item' => __('Add New Testimonial', $this->lan),
      'new_item' => __('New Testimonial', $this->lan),
      'edit_item' => __('Edit Testimonial', $this->lan),
      'view_item' => __('View Testimonial', $this->lan),
      'all_items' => __('All Testimonials', $this->lan),
      'search_items' => __('Search Testimonials', $this->lan),
      'parent_item_colon' => __('Parent Testimonials:', $this->lan),
      'not_found' => __('No testimonials found.', $this->lan),
      'not_found_in_trash' => __('No testimonials found in Trash.', $this->lan)
    );
    $service_arg = array(
      'labels' => $service_labels,
      'description' => __('Description.', $this->lan),
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'query_var' => true,
      'rewrite' => array('slug' => $this->slug),
      'capability_type' => 'post',
      'has_archive' => false,
      'hierarchical' => false,
      'menu_position' => null,
      'exclude_from_search' => TRUE,
      'show_in_nav_menus' => FALSE,
      'supports' => array('title', 'thumbnail', 'editor'),
      'menu_icon' => ELUSICVE_THEME_ADMIN_URI . '/images/icon-testimonial.png'
    );
    register_post_type($this->post_type, $service_arg);
  }

  public function shortcodes($attrs, $content) {
    
  }

  function metabox() {
    if (function_exists("register_field_group")) {
      register_field_group(array(
        'id' => 'acf_testimonials_metabox',
        'title' => 'Testimonial Author',
        'fields' => array(
          array(
            'key' => 'testimonial_designation',
            'label' => 'Designation',
            'name' => 'designation',
            'type' => 'text',
            'default_value' => 'Secretary',
            'formatting' => 'none',
          ),
          array(
            'key' => 'testimonial_order',
            'label' => 'Custom Order',
            'name' => 'custom_order',
            'type' => 'number',
            'default_value' => '1',
          ),
        ),
        'location' => array(
          array(
            array(
              'param' => 'post_type',
              'operator' => '==',
              'value' => $this->post_type,
              'order_no' => 0,
              'group_no' => 0,
            ),
          ),
        ),
        'options' => array(
          'position' => 'normal',
          'layout' => 'default',
          'hide_on_screen' => array(
          ),
        ),
        'menu_order' => 0,
      ));
    }
  }

  function widgets() {
    register_widget('Theme_Testimonials_Widget');
  }

}

new Testimonials_Content_Type();

function get_eli_testimonials($args = array()) {
  $defaults = array(
    'post_type' => 'eli_testimonial',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_key' => 'custom_order',
    'posts_per_page' => -1,
  );
  $args = wp_parse_args($args, $defaults);
  $testimonials_query = get_posts($args);
  $testimonials_data = array();
  if (!empty($testimonials_query)) {
    foreach ($testimonials_query as $key => $testimonial) {
      $sdata = new stdClass();
      $sdata->title = $testimonial->post_title;
      $sdata->content = $testimonial->post_content;
      $sdata->designation = get_field('designation', $testimonial->ID);
      $attchment = get_post_thumbnail_id($testimonial->ID, 'full');
      $sdata->img = wp_get_attachment_url($attchment);
      $testimonials_data[$key] = $sdata;
    }
  }
  return $testimonials_data;
}

class Theme_Testimonials_Widget extends WP_Widget {

  /**
   * Sets up the widgets name etc
   */
  public function __construct() {
    parent::__construct(
        'theme_testimonials', __('Theme Testimonials Widget', ELUSICVE_THEME_LAN), array('description' => __('A Contact Widget', ELUSICVE_THEME_LAN),)
    );
  }

  /**
   * Outputs the content of the widget
   *
   * @param array $args
   * @param array $instance
   */
  public function widget($args, $instance) {
    $title = apply_filters('widget_title', $instance['title']);
    $posts_per_page = apply_filters('widget_testimonials_count', $instance['count']);
    $cid = $args['id'];
    echo $args['before_widget'];
    if (!empty($instance['title'])) {
      echo $args['before_title'] . $title . $args['after_title'];
    }
    $testimonials = get_eli_testimonials(array('posts_per_page' => $posts_per_page));
    $count = count($testimonials);
    if ($count > 0) {
      $single_slide = ($count == 1) ? 'single-slide' : '';
      echo '<div id="carousel-' . $cid . '" class="testimonials-inner carousel slide ' . $single_slide . '" data-ride="carousel">';
      echo '<div class="carousel-inner" role="listbox">';
      $pagger = '';
      foreach ($testimonials as $key => $testimonial) {
        $active_class = ($key == 0) ? 'active' : '';
        $pagger .=sprintf('<li data-target="#carousel-' . $cid . '" data-slide-to="%1$s" class="%2$s"></li>', $key, $active_class);
        echo '<div class="item ' . $active_class . '">';
        echo sprintf('<div class="qoute">%s</div>', $testimonial->content);
        $img = '';
        if (!empty($testimonial->img)) {
          $img = sprintf('<figure class="img"><img src="%2$s" alt="%1$s" /></figure>', $testimonial->title, $testimonial->img);
        }

        echo sprintf('<div class="author">%3$s<h3 class="name">%1$s</h3><span class="des">%2$s</span></div>', $testimonial->title, $testimonial->designation, $img);

        echo "</div>";
      }
      echo "</div>";
      echo '<ol class="carousel-indicators">';
      echo $pagger;
      echo '</ol>';
      echo '</div>';
    }
    echo $args['after_widget'];
  }

  /**
   * Outputs the options form on admin
   *
   * @param array $instance The widget options
   */
  public function form($instance) {

    $title = !empty($instance['title']) ? $instance['title'] : __('', ELUSICVE_THEME_LAN);
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    </p>

    <?php
    $count = !empty($instance['count']) ? intval($instance['count']) : 2;
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Count:'); ?></label> 
      <input class="widefat" type="text" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo intval($count); ?>">

    </p>
    <?php
  }

  /**
   * Processing widget options on save
   *
   * @param array $new_instance The new options
   * @param array $old_instance The previous options
   */
  public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
    $instance['count'] = (!empty($new_instance['count']) ) ? intval($new_instance['count']) : 2;
    return $instance;
  }

}
