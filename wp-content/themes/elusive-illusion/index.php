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
                            <?php the_title();?>
                        </h2>
                    </div>
                </div>
                <div id="main-content" class="content col-xs-12 col-sm-8">
                    <?php while (have_posts()):the_post(); ?>

                    <div class="inner  clearfix">
                        <?php the_content();?>
                    </div>

                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
get_footer();
?>