<?php
/*
  * @package IllusiveDesign
 * @subpackage Elusive Illusion
 * @since Elusive Illusion 1.0
 */
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head() ?>
    </head>
    <body <?php body_class() ?>>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <?php
        $eli_options = get_eli_options();
        ?>
        <div id="page-backstretch" class="backstretch"></div>
        <div id="page-wrapper" class="wrapper">
            <header id="page-header" class="header-wrapper">
                <div class="container-fluid">
                    <nav class="navbar navbar-custom navbar-static-top">
                        <div class="navbar-header">
                            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar-secondary" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <h1 class="site-title">
                                <a class="navbar-brand" data-animate="fadeInLeft" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <?php
                                    if (!empty($eli_options['show_logo'])) {
                                        printf('<img class="img-responsive logo" src="%s" alt="logo"/>', $eli_options['logo_url']['url']);
                                    }
                                    ?>
                                    <span class="main_title sr-only"><?php bloginfo('name'); ?></span>

                                </a></h1> 
                        </div><!--/ navbar-header.-->                  

                        <div class="pull-right navbar-collapse collapse" id="navbar-secondary">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'secondary-menu',
                                'container' => '',
                                'menu_class' => 'nav navbar-nav pull-right',
                                'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                                'depth' => 0,
                                'walker' => new wp_bootstrap_navwalker()
                            ));
                            ?>
                        </div><!--/ navbar-collapse.-->
                    </nav>
                </div>
            </header><!--/ #page-header-->