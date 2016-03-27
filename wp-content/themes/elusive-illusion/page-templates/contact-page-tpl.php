<?php
/*
 * Template Name: Contact Us
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

                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="the-content">
                                        <?php the_content(); ?>
                                    </div>
                                    <div class="gmap embed-responsive embed-responsive-16by9">
                                     <?php echo $eli_options['contact_map_script']; ?>
                                    </div>
                                    
                                    <div class="address-wrap">
                                        <?php 
                                        echo  $eli_options['contact_address'];
                                        ?>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="cform-wrap">
                                       <?php echo do_shortcode($eli_options['contact_form_shortcode']); ?>
                                    </div>
                                </div>
                            </div>

                        </div>

                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
get_footer()?>