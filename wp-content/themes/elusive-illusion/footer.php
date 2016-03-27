<?php
/*
 * @package IllusiveDesign
 * @subpackage Elusive Illusion
 * @since Elusive Illusion 1.0
 */
$eli_options = get_eli_options();
?>

<footer id="page-footer" class="footer-wrapper clearfix">
    <div class="container-fluid">
        <nav class="navbar navbar-footer navbar-static-top ">
            <div class="navbar-header pull-right">
                <button aria-controls="navbar" aria-expanded="false" data-target="#navbar-primary" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <h2 class="site-title">
                    <a class="navbar-brand" data-animate="fadeInLeft" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php
                        if (!empty($eli_options['show_logo'])) {
                            printf('<img class="img-responsive logo" src="%s" alt="logo"/>', $eli_options['logo_url']['url']);
                        }
                        ?>
                        <span class="main_title sr-only"><?php bloginfo('name'); ?></span>

                    </a></h2> 
            </div><!--/ navbar-header.-->                  

            <div class="navbar-collapse collapse  pull-left" id="navbar-primary">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary-menu',
                    'container' => '',
                    'menu_class' => 'nav navbar-nav pull-left',
                    'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                    'depth' => 0,
                    'walker' => new wp_bootstrap_navwalker()
                ));
                ?>
                <div id="primary-menu-title" class="hidden-xs"></div>
            </div><!--/ navbar-collapse.-->
        </nav>
        <div class="footer-bottom row">
            <div class="social-items col-xs-12 col-sm-4 pull-right">
                <?php theme_social_links(); ?>
            </div>
            <div class="footer-texts col-xs-12 col-sm-8 pull-left">
                <?php echo $eli_options['site_copyright']; ?>
            </div>
        </div>
    </div>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>


