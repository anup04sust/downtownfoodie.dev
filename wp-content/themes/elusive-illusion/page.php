<?php
/*

 * @package IllusiveDesign
 * @subpackage Elusive Illusion
 * @since Elusive Illusion 1.0
 */
get_header();
$eli_options = get_eli_options();
?>
<div id="page-content" class="main-content-wrapper clearfix">
    <div class="container">
        <?php if (have_posts()): ?>
            <div class="entry-content row">
                <div id="sidebar-left" class="sidebar-content col-xs-12 col-sm-4">
                    <div class="inner clearfix">
                        <h2 class="page_title">
                            <span class="sr-only"><?php the_title(); ?></span>
                            <?php theme_page_subtitle(); ?>
                        </h2>
                        <div class="subpage-menus">
                            <?php theme_submenu_links(); ?>
                        </div>
                    </div>
                </div>
                <div id="main-content" class="content col-xs-12 col-sm-8">
                    <?php while (have_posts()):the_post(); ?>
                        <?php $bottom_content = get_field('page_bottom_content'); ?>
                        <div class="inner  clearfix <?php echo empty($bottom_content) ? 'empty-bottom' : 'has-bottom'; ?>">
                            <?php if (has_post_thumbnail()): ?>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-4 pull-right">
                                        <?php the_post_thumbnail(); ?>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 pull-left the-content">
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                                <div class="row content-bottom">
                                    <div class="col-xs-12">
                                        <?php echo do_shortcode($bottom_content); ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="row">
                                    <div class="col-xs-12 the-content">
                                        <?php the_content(); ?>
                                    </div>
                                </div>

                                <div class="row content-bottom">
                                    <div class="col-xs-12">
                                        <?php echo do_shortcode($bottom_content); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php //the_content(); ?>
                        </div>

                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
get_footer()?>