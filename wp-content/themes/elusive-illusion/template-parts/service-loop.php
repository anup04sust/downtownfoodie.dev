<?php
/*
 * @package IllusiveDesign
 * @subpackage Elusive Illusion
 * @since Elusive Illusion 1.0
 */
?>
<div <?php post_class(); ?>>
    <?php if (has_post_thumbnail()): ?>
      <div class="row entry-content-wrap">
        <figure class="featured-image col-xs-8 col-xs-offset-2 col-sm-3 col-sm-offset-0">
          <?php the_post_thumbnail('full'); ?>
        </figure>
        <div class="entry-content col-xs-10  col-sm-9">  
          <header class="entry-header">
            <h3 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title() ?></a></h3>
          </header>
          <div class="entry-excerpt">
            <?php the_excerpt(); ?> 
            <a class="btn btn-link" href="<?php the_permalink() ?>">Read More →</a>
          </div>

        </div>
      </div>
    <?php else: ?>
      <div class="entry-content">  
        <header class="entry-header">
          <h3 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title() ?></a></h3>
        </header>
        <div class="entry-excerpt">
          <?php the_excerpt(); ?> 
          <a class="btn btn-link" href="<?php the_permalink() ?>">Read More →</a>
        </div>

      </div>
    <?php endif; //has_post_thumbnail ?>
</div>
