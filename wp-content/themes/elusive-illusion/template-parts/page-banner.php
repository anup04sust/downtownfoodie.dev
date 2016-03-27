<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $eli_options;
$page_id = get_the_ID();
$banner_img_src = get_field('banner_image',$page_id);
$banner_img = empty($banner_img_src) ? sprintf('style="background-image: url(%s);"',$eli_options['default_page_banner']['url']):sprintf('style="background-image: url(%s);"',$banner_img_src);

?>
  <div id="page-banner" class="innerbanner" <?php echo $banner_img;?>><!-- Slider -->
    <div class="container">
      <div class="row">
        <div class="col-xs-12 banner-content">
          <h2 class="page-title"><?php theme_page_title();?></h2>
          <?php if(!empty($eli_options['show_subtitle'])):?>
          <h4 class="page-subtitle"><?php theme_page_subtitle();?></h4>
          <?php endif;?>
           <?php if(!empty($eli_options['show_breadcrumbs'])):
             theme_breadcrumbs();
           endif;?>
        </div>
      </div>
    </div>
  </div><!--End Slider -->