<?php

/*
 * @package IllusiveDesign
 * @subpackage Elusive Illusion
 * @since Elusive Illusion 1.0
 */
global  $eli_options;
  if ($eli_options['show_footer_widgets'] && !empty($eli_options['footer_widgets_count'])):
?>
<section id="bottom-widgets">
  <div class="<?php theme_layout_style();?>">
    <div class="widgets-areas bottom-widgets row">
      <?php
    $col_class = 'col-xs-10 col-xs-offset-1';
    $col_class .= ' col-sm-offset-0 col-sm-'.floor(12/$eli_options['footer_widgets_count']);
        for ($i = 1; $i <= intval($eli_options['footer_widgets_count']); $i++) {
          if ( is_active_sidebar( 'footer-area-'.$i ) ){
            echo "<div id=\"widget-area\" class=\"widget-area {$col_class}\" role=\"complementary\">";
            dynamic_sidebar( 'footer-area-'.$i );
            echo '</div>';
          }
        }
          
      ?>
    </div>
  </div>
</section>
<?php endif;?>
