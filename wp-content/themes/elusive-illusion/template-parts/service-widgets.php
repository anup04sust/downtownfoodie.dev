<?php
/*
 * @package IllusiveDesign
 * @subpackage Elusive Illusion
 * @since Elusive Illusion 1.0
 */
global $eli_options;
if (is_active_sidebar('sidebar-pagetpl-2')) :
  ?>

  <section id="service-widgets" class="page-block clearfix">
    <div class="<?php theme_layout_style(); ?>">
      <div class="row">
        <div class="col-xs-12">
          <h3 class="block-title"><?php echo $eli_options['service_block_title'] ?></h3>
        </div>
      </div>
      <div class="widgets-areas tpl-widgets row js-masonry">      
        <?php dynamic_sidebar('sidebar-pagetpl-2'); ?>
      </div>
    </div>
  </section>
<?php endif; ?>
