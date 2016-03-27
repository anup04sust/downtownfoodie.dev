<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sliders = get_eli_slides();
if (!empty($sliders)):
  $count = count($sliders);
  ?>
  <div id="page-banner" class="slider clearfix"><!-- Slider -->
    <div id="advanced-slider" class="camera_wrap camera_azure_skin camera_eli_skin">
      <?php foreach ($sliders as $key => $slide): ?>  
        <div data-thumb="<?php echo $slide->img; ?>" data-src="<?php echo $slide->img; ?>" data-alignment="topLeft">
          <div class="camera_caption fadeFromBottom">
           
            <h2 class="caption-title"><span class="title"><?php echo $slide->title; ?></span></h2>
               <div class="container">
              <div class="caption-text">
                <?php echo wpautop($slide->content); ?>	
                <?php
                if (!empty($slide->link_text) && !empty($slide->link_url)) {
                  printf('<p class="caption-link"><a class="btn btn-custom" href="%2$s" role="button">%1$s</a></p>', $slide->link_text, $slide->link_url);
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div><!--End Slider -->
  <script>
    <?php 
    if($count>1){
      $options = " autoAdvance: true,thumbnails: false, playPause: false, pagination: false, navigation: true,alignment:'topCenter',fx: 'scrollLeft',";
    }else{
      $options = " autoAdvance: false,thumbnails: false, playPause: false, pagination: false, navigation: false,alignment:'topCenter',fx: 'simpleFade',";
    }
    ?>
    jQuery(function () {

      jQuery('#advanced-slider').camera({
        <?php echo $options; ?>
       height: '35%',
       loader: '',
        imagePath: '<?php echo ELUSICVE_THEME_ASSETS ?>/img/'
      });
    });
  </script>
  <?php
endif;
?>
  