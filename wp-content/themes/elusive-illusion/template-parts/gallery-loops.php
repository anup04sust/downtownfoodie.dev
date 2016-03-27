<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="album-wrap">
  <h2 class="album-title"><?php the_title(); ?> </h2>
  <div class="row">
    <?php
    $post_id = get_the_ID();
    $gallery_images = get_post_meta($post_id, '_gattachment', TRUE);
    $gattachments = maybe_unserialize($gallery_images);
    if(isset($gattachments[0])){
      unset($gattachments[0]);
    }
    
    if (!empty($gattachments)):
        $cointer = 1;
      foreach ($gattachments as $attachment_id => $img):
      
             $attchment = wp_get_attachment_image_src($attachment_id, 'medium');
             $thumbnail = @$attchment[0];
             $att = get_gallery_attachment($attachment_id);
        ?>
        <div class="col-xs-6 col-sm-3 gallery-item">
          <div class="thumbnail">
            <img src="<?php echo $thumbnail; ?>" alt="<?php echo $att->title; ?>" />
            <a class="caption" href="<?php echo @$img['url']; ?>" title="<?php echo  !empty($att->caption)? $att->caption:$att->title; ?>">
              <span><?php echo  !empty($att->caption)? $att->caption:$att->title; ?></span>
            </a>
          </div>
        </div>
        <?php
        if($cointer == 4) break;
        $cointer ++;
      endforeach;
    else:
      echo '<p class="alert alert-info">' . __('No gallery image found.') . '</p>';
    endif;
    ?>
  </div>

<?php
$album_link = get_the_permalink($post_id);
if (!empty($gattachments))
  echo sprintf('<a href="%s" class="btn btn-link">View Album →</a>', $album_link);
?>
</div>
