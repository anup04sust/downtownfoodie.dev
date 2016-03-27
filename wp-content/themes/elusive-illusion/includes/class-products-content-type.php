<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class-product-content-type
 *
 * @author Anup Biswas <anup@illusivedesign.net>
 */
class Products_Content_Type {

  private $post_type = 'eli_products';
  private $slug = 'products';
  private $lan = ELUSICVE_THEME_LAN;
  private $taxonomy = 'product-catalog';

  function __construct() {
    add_action('init', array($this, 'register'));
    add_action('init', array($this, 'taxonomies'));
    add_shortcode('products', array($this, 'shortcodes'));
    add_action('pre_get_posts', array($this, 'alter_query'));
    add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
    add_action( 'wp_ajax_products_admin_ajax', array($this, 'admin_ajax'));

    add_filter('manage_eli_products_posts_columns', array($this, 'columns_head'));
    add_action('manage_eli_products_posts_custom_column', array($this, 'columns_content'), 10, 2);

    $this->metabox();
  }
 public function admin_scripts(){
    wp_enqueue_style('eli_products_css', ELUSICVE_THEME_ADMIN_URI . 'css/eli_products.css');   
    wp_enqueue_script('eli_products', ELUSICVE_THEME_ADMIN_URI . 'js/admin-products.js', array('jquery'), 1.0, TRUE);  
    wp_localize_script('eli_products', 'PRODUCT_JSOBJ', array('ajax_url'=>admin_url('admin-ajax.php'),'action'=>'products_admin_ajax'));
 }
  public function register() {
    $product_labels = array(
      'name' => _x('Products', 'post type general name', $this->lan),
      'singular_name' => _x('Product', 'post type singular name', $this->lan),
      'menu_name' => _x('Products', 'admin menu', $this->lan),
      'name_admin_bar' => _x('Product', 'add new on admin bar', $this->lan),
      'add_new' => _x('Add New', 'Product', $this->lan),
      'add_new_item' => __('Add New Product', $this->lan),
      'new_item' => __('New Product', $this->lan),
      'edit_item' => __('Edit Product', $this->lan),
      'view_item' => __('View Product', $this->lan),
      'all_items' => __('All Products', $this->lan),
      'search_items' => __('Search Products', $this->lan),
      'parent_item_colon' => __('Parent Products:', $this->lan),
      'not_found' => __('No products found.', $this->lan),
      'not_found_in_trash' => __('No products found in Trash.', $this->lan)
    );
    $product_arg = array(
      'labels' => $product_labels,
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
      'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
      'menu_icon' => ELUSICVE_THEME_ADMIN_URI . '/images/icon-product.png'
    );
    register_post_type($this->post_type, $product_arg);
  }

  public function taxonomies() {
    $labels = array(
      'name' => _x('Product Catalogs', 'taxonomy general name'),
      'singular_name' => _x('Catalog', 'taxonomy singular name'),
      'search_items' => __('Search Catalogs'),
      'all_items' => __('All Catalogs'),
      'parent_item' => __('Parent Catalog'),
      'parent_item_colon' => __('Parent Catalog:'),
      'edit_item' => __('Edit Catalog'),
      'update_item' => __('Update Catalog'),
      'add_new_item' => __('Add New Catalog'),
      'new_item_name' => __('New Catalog Name'),
      'menu_name' => __('Catalog'),
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

  public function shortcodes($attrs, $content) {
    $atts = shortcode_atts(array(
      'title' => '',
      'column' => '3',
      'cat' => '',
        ), $attrs, 'products');
    wpprint($atts);
  }

  function metabox() {
    if (function_exists("register_field_group")) {
      register_field_group(array(
        'id' => 'acf_product_metabox',
        'title' => 'Product Fields',
        'fields' => array(
          array(
            'key' => 'featured_product',
            'label' => 'Is Featured?',
            'instructions' => 'If Featured showing front page automatically',
            'name' => 'featured',
            'type' => 'true_false',
            'default_value' => '0',
          ),
          array(
            'key' => 'product_subtitle',
            'label' => 'Sub Title',
            'instructions' => 'Additional product Field',
            'name' => 'subtitle',
            'type' => 'text',
            'default_value' => '',
          ),
          array(
            'key' => 'product_icon',
            'label' => 'Icon Image',
            'name' => 'icon',
            'type' => 'image',
            'save_format' => 'object',
            'preview_size' => 'thumbnail',
            'library' => 'all',
          ),
          array(
            'key' => 'product_custom_order',
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

  function alter_query($query) {
    global $wp_query;
    if ($query->is_main_query() && $query->query_vars['post_type'] === $this->post_type) {
      $query->set('orderby', 'meta_value_num');
      $query->set('order', 'ASC');
      $query->set('meta_key', 'custom_order');
    }
  }

  function columns_head($defaults) {
    eli_array_insert($defaults, 2,array('featured_image' => __('Image')));
    eli_array_insert($defaults, 4,array('custom_order' => __('Order')));
   
    return $defaults;
  }

  function columns_content($column_name, $post_id) {
    if ($column_name == 'featured_image') {
      $thumbnail_id = get_post_thumbnail_id($post_id, 'thumbnail');
      $thumbnail= wp_get_attachment_url($thumbnail_id);
      echo sprintf('<img src="%1$s" alt="thumb" style="width:64px;height:auto;" />',$thumbnail);
    }
    if ($column_name == 'custom_order') {
      $order = get_field('custom_order', $post_id);
      echo sprintf('<div class="edit-custom-order"><span class="sr" onclick="ELI_PRODUCT.show_order_field(this,%2$s)">%1$s</span><input class="inline-order" type="text" value="%1$s" /><input type="button" onclick="ELI_PRODUCT.update_order(this,%2$s)" value="OK" class="button button-primary button-small" />',$order,$post_id);
    }
  }
 function admin_ajax(){
   $postData = $_POST;
   unset($_POST);
   $doing = $postData['doing'];
   if($doing === 'update_order'){
     $post_id = intval($postData['post_id']);
     $value = intval($postData['neworder']);
     $update = update_post_meta($post_id,'custom_order', $value);
     if($update){
       echo json_encode(array('status'=>'success','msg'=>__('Updae successfull')));
     }else{
       echo json_encode(array('status'=>'error','msg'=>__('Update Error!!!')));
     }
   }
   exit();
 }
}

new Products_Content_Type();

function get_eli_products($args = array()) {
  $defaults = array(
    'post_type' => 'eli_products',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_key' => 'custom_order',
    'posts_per_page' => -1,
  );
  $args = wp_parse_args($args, $defaults);
  $products_query = get_posts($args);
  $products_data = array();
  if (!empty($products_query)) {
    foreach ($products_query as $key => $product) {
      $sdata = new stdClass();
      $sdata->title = $product->post_title;
      $sdata->excerpt = $product->post_excerpt;
      $sdata->content = $product->post_content;
      $sdata->url = get_the_permalink($product->ID);
      $icon_att_id = get_field('icon', $product->ID);
      $sdata->icon = wp_get_attachment_url($icon_att_id);
      $attchment = get_post_thumbnail_id($product->ID, 'full');
      $sdata->img = wp_get_attachment_url($attchment);
      $sdata->featured = get_field('featured', $product->ID);
      $sdata->subtitle = get_field('subtitle', $product->ID);
      $products_data[$key] = $sdata;
    }
  }
  return $products_data;
}
