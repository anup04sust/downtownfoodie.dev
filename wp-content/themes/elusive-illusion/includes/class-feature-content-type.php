<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class-feature-content-type
 *
 * @author Anup Biswas <anup@illusivedesign.net>
 */
class Features_Content_Type {

  private $post_type = 'eli_features';
  private $slug = 'feature';
  private $lan = ELUSICVE_THEME_LAN;
  private $taxonomy = 'features-catalog';

  function __construct() {
    add_action('init', array($this, 'register'));
    add_action('init', array($this, 'taxonomies'));
    add_shortcode('features', array($this, 'shortcodes'));
    add_action( 'pre_get_posts', array($this, 'custom_order'), 1 );
    $this->metabox();
  }

  public function register() {
    $featured_labels = array(
      'name' => _x('Featured', 'post type general name', $this->lan),
      'singular_name' => _x('Featured', 'post type singular name', $this->lan),
      'menu_name' => _x('Featured', 'admin menu', $this->lan),
      'name_admin_bar' => _x('Feature', 'add new on admin bar', $this->lan),
      'add_new' => _x('Add New', 'Feature', $this->lan),
      'add_new_item' => __('Add New Feature', $this->lan),
      'new_item' => __('New Feature', $this->lan),
      'edit_item' => __('Edit Feature', $this->lan),
      'view_item' => __('View Features', $this->lan),
      'all_items' => __('All Features', $this->lan),
      'search_items' => __('Search Features', $this->lan),
      'parent_item_colon' => __('Parent Features:', $this->lan),
      'not_found' => __('No Features found.', $this->lan),
      'not_found_in_trash' => __('No Features found in Trash.', $this->lan)
    );
    $featured_arg = array(
      'labels' => $featured_labels,
      'description' => __('Description.', $this->lan),
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'query_var' => true,
      'rewrite' => array('slug' => $this->slug),
      'capability_type' => 'post',
      'has_archive' => true,
      'hierarchical' => false,
      'menu_position' => null,
      'show_in_nav_menus' => FALSE,
      'supports' => array('title', 'thumbnail', 'excerpt'),
      'menu_icon' => ELUSICVE_THEME_ADMIN_URI.'/images/icon-featured.png'
    );
    register_post_type($this->post_type, $featured_arg);
  }

  public function taxonomies() {
    $labels = array(
      'name' => _x('Feature Categories', 'taxonomy general name'),
      'singular_name' => _x('Category', 'taxonomy singular name'),
      'search_items' => __('Search Categories'),
      'all_items' => __('All Categories'),
      'parent_item' => __('Parent Category'),
      'parent_item_colon' => __('Parent Category:'),
      'edit_item' => __('Edit Category'),
      'update_item' => __('Update Category'),
      'add_new_item' => __('Add New Category'),
      'new_item_name' => __('New Category Name'),
      'menu_name' => __('Category'),
    );

    $args = array(
      'hierarchical' => true,
      'labels' => $labels,
      'show_ui' => true,
      'show_admin_column' => true,
      'query_var' => true,
      'rewrite' => array('slug' => $this->taxonomy),
    );

    register_taxonomy($this->taxonomy, $this->post_type, $args);
  }
  public function custom_order($query){
    if(is_archive() && get_query_var('post_type') === $this->post_type){
      print_r('i am here');
      $query->set( 'order' , 'asc' );
		  $query->set( 'orderby', 'meta_value_num');
		  $query->set( 'meta_key','custom_order');
    }
    
  }
  public function shortcodes($attrs, $content) {
    $atts = shortcode_atts(array(
      'title' => '',
      'column' => 3,
      'count'=>3,
      'cat'=>'',
        ), $attrs, 'features');
    $col_class = 'col-xs-10 col-xs-offset-1';
    $col_class .= ' col-sm-offset-0 col-sm-'.floor(12/$atts['column']);
    $posts_per_page = intval($atts['count']);
    $term = $atts['cat'];
    $featured_contents = get_eli_featured_contents(array('posts_per_page'=>$posts_per_page,'term'=>$term));
    $html = '<div class="row featured-items">';
    if(!empty($atts['title'])){
       $html .=  '<h2 class="feature-title col-xs-12">'.$atts['title'].'</h2>';       
    }
    if(!empty($featured_contents)){
      foreach($featured_contents as $featured){
        $caption = sprintf('<h3 class="ctitle">%1$s</h3><a class="readmore" href="%2$s"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>',$featured->title,$featured->url);
        $figure = sprintf('<a class="feagure" href="%3$s"> <img src="%2$s" alt="%1$s"></a>',$featured->title,$featured->icon,$featured->url);
        $html .= sprintf('<div class="featured-item %3$s"><div class="thumbnail">%1$s<div class="caption">%2$s</div></div></div>',$figure,$caption,$col_class);
      }
    }
   
    $html .= '</div>';
    return $html;
  }

  function metabox() {
    if (function_exists("register_field_group")) {
      register_field_group(array(
        'id' => 'acf_featured_metabox',
        'title' => 'Featured Fields',
        'fields' => array(
          array(
            'key' => 'featured_field_url',
            'label' => 'Details Url',
            'name' => 'featured_url',
            'type' => 'text',
            'default_value' => '#',           
          ),
          array(
            'key' => 'featured_icon',
            'label' => 'Icon Image',
            'name' => 'icon',
            'type' => 'image',
            'save_format' => 'object',
            'preview_size' => 'thumbnail',
            'library' => 'all',
          ),
          array(
            'key' => 'featured_custom_order',
            'label' => 'Order',
            'name' => 'custom_order',
            'type' => 'number',
            'default_value' => '1',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'min' => '',
            'max' => '',
            'step' => '',
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

}

new Features_Content_Type();

function get_eli_featured_contents($args = array()) {
  $defaults = array(
    'post_type' => 'eli_features',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_key' => 'custom_order',
    'posts_per_page' => -1,
  );
  $args = wp_parse_args($args, $defaults);
  
  $features_query = get_posts($args);
  $features_data = array();
  if (!empty($features_query)) {
    foreach ($features_query as $key => $feature) {
      $sdata = new stdClass();
      $sdata->title = $feature->post_title;
      $sdata->excerpt = $feature->post_excerpt;
      $sdata->content = $feature->post_content;
      $sdata->url = get_field('featured_url', $feature->ID);
      $icon_att_id = get_field('icon', $feature->ID);
      $sdata->icon = wp_get_attachment_url($icon_att_id);
      $attchment = get_post_thumbnail_id($feature->ID, 'full');
      $sdata->img = wp_get_attachment_url($attchment);
      $features_data[$key] = $sdata;
    }
  }
  return $features_data;
}
