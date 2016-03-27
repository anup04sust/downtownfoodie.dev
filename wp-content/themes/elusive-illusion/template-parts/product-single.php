<?php
/*
 * @package IllusiveDesign
 * @subpackage Elusive Illusion
 * @since Elusive Illusion 1.0
 */
?>
<div <?php post_class('single-product'); ?>>
  <?php if (has_post_thumbnail()): ?>
    <div class="row entry-content-wrap">
      <div class="entry-content col-xs-12">
        <div class="entry-excerpt">
          <figure class="wp-caption alignleft">           
            <?php the_post_thumbnail('full'); ?>
          </figure>
          <?php the_content(); ?>            
        </div>

      </div>
    </div>
  <?php else: ?>
    <div class="entry-content">  
      <header class="entry-header">
        <h3 class="entry-title"><?php the_title() ?></h3>
      </header>
      <div class="entry-excerpt">
        <?php the_content(); ?>         
      </div>

    </div>
  <?php
  endif;
  ?>
  <footer class="entry-footer">
    <?php
  the_post_navigation(array(
    'next_text' => '<span class="meta-nav" aria-hidden="true">' . __('Next') . '</span> ' .    
    '<span class="post-title">%title</span>',
    'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __('Previous') . '</span> ' .    
    '<span class="post-title">%title</span>',    
    'screen_reader_text'=> __('Product navigation'),
  ));
  ?>
</footer>
</div>
