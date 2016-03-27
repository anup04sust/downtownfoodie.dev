<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class-gallery-content-type
 *
 * @author Anup Biswas <anup@illusivedesign.net>
 */
class Gallery_Content_Type {

  private $post_type = 'eli_gallery';
  private $slug = 'gallery';
  private $lan = ELUSICVE_THEME_LAN;
  private $taxonomy = 'gallery-album';

  function __construct() {
    add_action('init', array($this, 'register'));
    add_action('init', array($this, 'taxonomies'));
    add_shortcode('gallerys', array($this, 'shortcodes'));
    add_action('wp_enqueue_scripts', array($this, 'scripts'));
    add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
    $this->metabox();
  }

  function scripts() {
    wp_enqueue_style('grid-7', ELUSICVE_THEME_ASSETS . 'css/grid-7.css');
    
    wp_enqueue_script('eli-gallery', ELUSICVE_THEME_ASSETS . 'js/eli-gallery.js', array('jquery', 'isotope', 'jquery-masonry'), 1.0, TRUE);
  }

  function admin_scripts() {
    wp_enqueue_style('gallery-admin-style', ELUSICVE_THEME_ADMIN_URI . 'css/eli_gallery.css');
    wp_enqueue_script('gallery-admin-js', ELUSICVE_THEME_ADMIN_URI . 'js/admin-gallery.js', array('jquery', 'media-upload'), 1.0, TRUE);
    wp_localize_script('gallery-admin-js', 'ELIGALLERY_SETTINGS', array('ajax_url' => admin_url('admin-ajax.php'), 'action' => 'gallery_admin_action'));
  }

  public function register() {
    $gallery_labels = array(
      'name' => _x('Gallery', 'post type general name', $this->lan),
      'singular_name' => _x('Gallery', 'post type singular name', $this->lan),
      'menu_name' => _x('Galleries', 'admin menu', $this->lan),
      'name_admin_bar' => _x('Gallery', 'add new on admin bar', $this->lan),
      'add_new' => _x('Add New', 'Gallery', $this->lan),
      'add_new_item' => __('Add New Gallery', $this->lan),
      'new_item' => __('New Gallery', $this->lan),
      'edit_item' => __('Edit Gallery', $this->lan),
      'view_item' => __('View Gallery', $this->lan),
      'all_items' => __('All Galleries', $this->lan),
      'search_items' => __('Search Galleries', $this->lan),
      'parent_item_colon' => __('Parent Galleries:', $this->lan),
      'not_found' => __('No gallerys found.', $this->lan),
      'not_found_in_trash' => __('No gallerys found in Trash.', $this->lan)
    );
    $gallery_arg = array(
      'labels' => $gallery_labels,
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
      'supports' => array('title', 'thumbnail'),
      'menu_icon' => ELUSICVE_THEME_ADMIN_URI . '/images/icon-gallery.png'
    );
    register_post_type($this->post_type, $gallery_arg);
  }

  public function taxonomies() {
    $labels = array(
      'name' => _x('Gallery Album', 'taxonomy general name'),
      'singular_name' => _x('Album', 'taxonomy singular name'),
      'search_items' => __('Search Albums'),
      'all_items' => __('All Albums'),
      'parent_item' => __('Parent Album'),
      'parent_item_colon' => __('Parent Album:'),
      'edit_item' => __('Edit Album'),
      'update_item' => __('Update Album'),
      'add_new_item' => __('Add New Album'),
      'new_item_name' => __('New Album Name'),
      'menu_name' => __('Album'),
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
        ), $attrs, 'gallerys');
  }

  function metabox() {
    add_action('add_meta_boxes', array($this, 'gallery_admin'));
    add_action('save_post', array($this, 'gallery_save_data'));

    if (function_exists("register_field_group")) {
      /*      register_field_group(array(
        'id' => 'acf_album_metabox',
        'title' => 'Cover Photo',
        'fields' => array(
        array(
        'key' => 'gallery_album_cover',
        'label' => 'Cover Image(358X254)',
        'name' => 'cover_image',
        'type' => 'image',
        'save_format' => 'object',
        'preview_size' => 'thumbnail',
        'library' => 'all',
        ),
        array(
        'key' => 'gallery_custom_order',
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
        'param' => 'ef_taxonomy',
        'operator' => '==',
        'value' => 'gallery-album',
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
       */
      register_field_group(array(
        'id' => 'acf_images',
        'title' => 'Additional Fields',
        'fields' => array(
        /*  array(
            'key' => 'gallery_image_grid_size',
            'label' => 'Tile Grid Size',
            'name' => 'grid_size',
            'type' => 'radio',
            'instructions' => 'Select a size depends on your thumbnail size',
            'choices' => array(
              'small' => 'Small',
              'medium' => 'Medium',
              'large' => 'Large',
            ),
            'other_choice' => 0,
            'save_other_choice' => 0,
            'default_value' => 'small',
            'layout' => 'horizontal',
          ),
          array(
            'key' => 'gallery_image_thumbnail',
            'label' => 'Tile Thumbnail',
            'name' => 'thumbnail',
            'type' => 'image',
            'instructions' => 'Small (150X110), Medium (320X230),	Large (450X350) in pixel
	',
            'save_format' => 'url',
            'preview_size' => 'thumbnail',
            'library' => 'all',
          ),
          array(
            'key' => 'gallery_image_cover',
            'label' => 'Listing Cover Image',
            'name' => 'listing_cover_image',
            'type' => 'image',
            'instructions' => 'Same size for all gallery e.g.(358X254)',
            'save_format' => 'object',
            'preview_size' => 'thumbnail',
            'library' => 'all',
          ),*/
          array(
            'key' => 'gallery_image_custom_order',
            'label' => 'Order',
            'name' => 'custom_order',
            'type' => 'number',
            'default_value' => 1,
          ),
        ),
        'location' => array(
          array(
            array(
              'param' => 'post_type',
              'operator' => '==',
              'value' => 'eli_gallery',
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

  function gallery_admin() {
    $screens = array($this->post_type);
    add_meta_box('gallery_metabox', __('Gallery Images'), array($this, 'gallery_admin_calback'), $screen, 'advanced', 'core');
  }

  function gallery_admin_calback($post) {
    echo '<div class="admin-gallery-images">';
    echo '<div class="eli-gallery-wrap">';
   
    $gallery_images = get_post_meta($post->ID, '_gattachment', TRUE);
    
    if (!empty($gallery_images)) {
       $gattachments = maybe_unserialize($gallery_images);      
      foreach ($gattachments as $attid => $img) {
        if(!empty($img))
        echo sprintf('<figure id="preview-wrap-%1$s"><input type="hidden" name="gattachment[%1$s][url]" value="%2$s"><input type="hidden" name="gattachment[%1$s][thumbnail]" value="%3$s"><img src="%3$s" alt="%1$s"><button onclick="ELIGALLERY.removeImage(%1$s)" type="button"><span class="dashicons dashicons-no-alt"></span></button></figure>',$attid,$img['url'],$img['thumbnail']);
      }
    }else{
       echo '<input type="hidden" name="gattachment[0]" value="0" />';
    }
    echo '</div>';
    echo '<div id="upload-button-' . $post->ID . '" class="eli-gfooter"><button class="upload-button button button-hero" type="button" onclick="ELIGALLERY.UploadImage(this,' . $post->ID . ')">Upload Images</button></div>';
    echo '</div>';
  }

  function gallery_save_data($post_id) {
    if (!isset($_POST['gattachment'])) {
      return;
    }
    $gattachment = maybe_serialize($_POST['gattachment']);
    update_post_meta( $post_id, '_gattachment', $gattachment );  
  }

}

new Gallery_Content_Type();

function get_eli_galleries($args = array()) {
  $defaults = array(
    'post_type' => 'eli_gallery',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_key' => 'custom_order',
    'posts_per_page' => -1,
  );
  $args = wp_parse_args($args, $defaults);
  $gallerys_query = get_posts($args);
  $gallerys_data = array();
  if (!empty($gallerys_query)) {
    foreach ($gallerys_query as $key => $gallery) {
      $sdata = new stdClass();
      $sdata->ID = $gallery->ID;
      $sdata->title = $gallery->post_title;
      $sdata->grid_size = get_field('grid_size', $gallery->ID);
      $thumbnail_att_id = get_field('thumbnail', $gallery->ID);
      $sdata->thumbnail = wp_get_attachment_url($thumbnail_att_id);
      $sdata->link = get_the_permalink($gallery->ID);
      $attchment = get_post_thumbnail_id($gallery->ID, 'full');
      $sdata->cover_preview = wp_get_attachment_url($attchment);
      $gallerys_data[$key] = $sdata;
    }
  }
  return $gallerys_data;
}

function get_eli_gallery_grid_col($size) {
  $size = trim($size);
  $col = 1;
  switch ($size) {
    case 'large':
      $col = 3;
      break;
    case 'medium':
      $col = 2;
      break;
    case 'small':
      $col = 1;
      break;
  }
  return $col;
}

function get_gallery_attachment( $attachment_id ) {

	$attachment = get_post( $attachment_id );
  
  $attm = new stdClass();
  $attm->alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );
  $attm->caption = $attachment->post_excerpt;
  $attm->description = $attachment->post_content;
  $attm->href = get_permalink( $attachment->ID );
  $attm->src = $attachment->guid;
  $attm->title = $attachment->post_title;
	return $attm;
}
function get_gallery_popupobjs($post_id,$title_prefix=''){
  $attachments = get_post_meta($post_id, '_gattachment', TRUE);
  wpprint($attachments);
  if($attachments){
    $gattachments = maybe_unserialize($attachments);
    $imagedata = array();
        foreach ($gattachments as $attid => $img) {
        if(!empty($img)){
          $attachment = get_gallery_attachment($attid); 
          $imagedata[] = array('src'=>$img['url'],'title'=>$title_prefix.$attachment->title);
        }        
      }
      return json_encode($imagedata);
  }
}