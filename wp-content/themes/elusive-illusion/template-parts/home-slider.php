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
    <div id="page-carousel-slider" class="carousel slide <?php echo ($count == 1) ? 'single-slide' : ''; ?>" data-ride="carousel">
      <div class="carousel-inner" role="listbox">
        <?php
        $pagger = '';
        foreach ($sliders as $key => $slide):
          $active_class = ($key == 0) ? 'active' : '';
          $pagger .=sprintf('<li data-target="#page-carousel-slider" data-slide-to="%1$s" class="%2$s"></li>', $key, $active_class);
          ?>  
          <div class="item <?php echo $active_class; ?>">
            <img src="<?php echo $slide->img; ?>" alt="Image: <?php echo $slide->title; ?>">
            <div class="container">
              <div class="carousel-caption">

                <h2 class="banner-title"><?php echo $slide->title; ?></h2>
                <?php echo wpautop($slide->content); ?>	
                <?php
                if (!empty($slide->link_text) && !empty($slide->link_url)) {
                  printf('<p class="text-center"><a class="btn btn-custom" href="%2$s" role="button">%1$s</a></p>', $slide->link_text, $slide->link_url);
                }
                ?>


              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Controls -->
      <a data-slide="prev" role="button" href="#page-carousel-slider" class="left carousel-control">
        <span aria-hidden="true" class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a data-slide="next" role="button" href="#page-carousel-slider" class="right carousel-control">
        <span aria-hidden="true" class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
      <ol class="carousel-indicators">
        <?php echo $pagger; ?>
      </ol>

    </div>
  </div><!--End Slider -->

  <?php

 endif;