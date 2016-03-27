<?php
/*
 * @package IllusiveDesign
 * @subpackage Elusive Illusion
 * @since Elusive Illusion 1.0
 */
global $eli_options;
$album = $eli_options['gallery_album'];
$opt_gallery = $eli_options['tpl2-gallery'];
$opt_galleries = !empty($opt_gallery) ? explode(',', $opt_gallery):array();
$galleries = get_posts(array('post_type'=>'attachment','include'=>$opt_galleries,'orderby' => 'post__in','post_mime_type' => 'image','numberposts' => -1));
if (!empty($opt_gallery)) :
  ?>
  <section id="gallery-tiles" class="page-block clearfix">
    <div class="<?php theme_layout_style(); ?>">
      <div class="row">
        <div class="col-xs-12">
          <h3 class="block-title"><?php echo $eli_options['gallery_block_title'] ?></h3>
        </div>
      </div>
      <div class="gallery-wrap clearfix">      
        <?php foreach($galleries as $key=>$attachment):
          
          $grid_size = get_post_meta($attachment->ID, 'tiles_grid', true);
          $gcol = get_eli_gallery_grid_col($grid_size);
          $img_src =  wp_get_attachment_image_src( $attachment->ID, 'full' );
         
          ?>
        <div class="gcol-xs-<?php echo $gcol .' '.$grid_size; ?> gallery-gcol" id="attachment-<?php echo $attachment->ID;?>">
            <div class="thumbnail gallery-thumb" >
              <img alt="<?php echo $attachment->post_title; ?>" src="<?php echo @$img_src[0]; ?>">
              <div class="caption">              
                <p><?php echo ($attachment->post_content)?$attachment->post_content:$attachment->post_title;?></p>
              </div>
              <a title=" <?php echo ($attachment->post_content)?$attachment->post_content:$attachment->post_title;?>" href="<?php echo @$img_src[0]; ?>" class="thumbnail-links"></a>
            </div>
            </div>          
        <?php endforeach;
          ?>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <p class="block-bottom text-capitalize text-center"><a class="btn btn-link" href="<?php echo get_post_type_archive_link( 'eli_gallery' ); ?>">View Full Gallery &RightArrow;</a></p>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>
