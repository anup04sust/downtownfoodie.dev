<?php
/*
 * @package IllusiveDesign
 * @subpackage Elusive Illusion
 * @since Elusive Illusion 1.0
 */
$post_id = get_the_ID();
$gallery_images = get_post_meta($post_id, '_gattachment', TRUE);
?>
<div <?php post_class('single-post'); ?>>
  <div id="gattachment-gallery" class="gattachment album-wrap clearfix row">

    <?php
    $gattachments = maybe_unserialize($gallery_images);
    unset($gattachments[0]);
    if (!empty($gattachments)):

      foreach ($gattachments as $attid => $img) {
        if (!empty($img)) {
          $attachment = get_gallery_attachment($attid);
          $rand_size = 3;
          $thumb = wp_get_attachment_image_src($attid, 'medium');
          $thumb_src = empty($thumb[0]) ? $img['thumbnail'] : $thumb[0];
          $attchment = wp_get_attachment_image_src($attid, 'medium');
          $thumbnail = @$attchment[0];
          $att = get_gallery_attachment($attid);
          ?>
    <div class="ggird gallery-item col-xs-6 col-sm-<?php echo $rand_size;?>">
          <div class="thumbnail">
            <img src="<?php echo $thumbnail; ?>" alt="<?php echo $att->title; ?>" />
            <a class="caption" href="<?php echo @$img['url']; ?>" title="<?php echo!empty($att->caption) ? $att->caption : $att->title; ?>">
              <span><?php echo!empty($att->caption) ? $att->caption : $att->title; ?></span>
            </a>
          </div>
      </div>
          <?php
         // echo sprintf('<div class="ggird col-xs-%5$s"><figure id="preview-wrap-%1$s" class="thumbnail"><a class="gattachment-preview" href="%2$s" title="%4$s"> <img src="%3$s" alt="%1$s"></a><span class="caption"></span></figure></div>', $attid, $img['url'], $thumb_src, $attachment->title, $rand_size);
        }
      }
      ?>

    <?php else: ?>
      <div class="entry-content">      
        <p class="alert alert-info"><?php _e('No gallery image found!!!') ?></p>
      </div>
    <?php
    endif;
    ?>
  </div>
  <footer class="entry-footer">
    <?php
    the_post_navigation(array(
      'next_text' => '<span class="meta-nav" aria-hidden="true">' . __('Next') . '</span> ' .
      '<span class="post-title">%title</span>',
      'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __('Previous') . '</span> ' .
      '<span class="post-title">%title</span>',
      'screen_reader_text' => __('Gallery navigation'),
    ));
    ?>
  </footer>
</div>
