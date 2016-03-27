<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width">
            <title><?php wp_title('|', true, 'right'); ?></title>
            <link rel="profile" href="http://gmpg.org/xfn/11">
                <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
                    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
                        <!--[if lt IE 9]>
                        <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
                        <![endif]-->

                        <?php if ($_REQUEST['page_id'] == 41 or $_REQUEST['page_id'] == 24) { ?>

                            <link rel='stylesheet' id='twentythirteen-style-css'  href='/wp-content/themes/twentythirteen/css/global.css?ver=2013-07-18' type='text/css' media='all' />

                            <script type='text/javascript' src='/wp-content/themes/twentythirteen/js/features.js'></script>
                            <script src="/wp-content/themes/twentythirteen/js/mootools-core.js" type="text/javascript"></script>
                            <script src="/wp-content/themes/twentythirteen/js/mootools-more.js" type="text/javascript"></script>

                            <script src="/wp-content/themes/twentythirteen/js/Locale.en-US.DatePicker.js" type="text/javascript"></script>
                            <script src="/wp-content/themes/twentythirteen/js/Picker.js" type="text/javascript"></script>
                            <script src="/wp-content/themes/twentythirteen/js/Picker.Attach.js" type="text/javascript"></script>
                            <script src="/wp-content/themes/twentythirteen/js/Picker.Date.js" type="text/javascript"></script>

                            <link  href="/wp-content/themes/twentythirteen/js/datepicker_dashboard/datepicker_dashboard.css" rel="stylesheet" type="text/css" media="screen" />

                            <link href="/wp-content/themes/twentythirteen/js/datepicker.css" rel="stylesheet">

                                <script>

                                    window.addEvent('domready', function () {
                                        myPicker = new Picker.Date($('time'), {
                                            pickOnly: 'time',
                                            timeWheelStep: 5
                                        });
                                    });

                                    window.addEvent('domready', function () {
                                        new Picker.Date('date', {
                                            pickerClass: 'datepicker_dashboard'
                                        });

                });</script>


                                <link rel='stylesheet' id='twentythirteen-style-css'  href='/wp-content/themes/twentythirteen/css/shadowbox.css' type='text/css'  />

                                <script type='text/javascript' src='/wp-content/themes/twentythirteen/js/shadowbox.js'></script>
                                <script type='text/javascript' src='/wp-content/themes/twentythirteen/js/features.js'></script>


                            <?php } else { ?> 
                                <link rel='stylesheet' id='twentythirteen-style-css'  href='/wp-content/themes/twentythirteen/css/global.css?ver=2013-07-18' type='text/css' media='all' />

                                <script type='text/javascript' src='/wp-content/themes/twentythirteen/js/mootools-1.2.2-core.js'></script>
                                <script type='text/javascript' src='/wp-content/themes/twentythirteen/js/mootools-1.2.2.2-more.js'></script>
                                <script type='text/javascript' src='/wp-content/themes/twentythirteen/js/features.js'></script>

                                <link rel='stylesheet' id='twentythirteen-style-css'  href='/wp-content/themes/twentythirteen/css/shadowbox.css' type='text/css'  />

                                <script type='text/javascript' src='/wp-content/themes/twentythirteen/js/shadowbox.js'></script>
                                <script type='text/javascript' src='/wp-content/themes/twentythirteen/js/features.js'></script>

                            <?php } ?>
                            <link href="/wp-content/themes/twentythirteen/css/responsive.css" rel="stylesheet">   
                                <script src="/wp-content/themes/twentythirteen/js/jquery-1.12.0.min.js"></script>    
                                <script src="/wp-content/themes/twentythirteen/js/jquery-migrate-1.2.1.min.js"></script>
                                <script>
                                       var nc = jQuery.noConflict();
                                       nc(document).ready(function () {
                                           nc('.toggle-menu', '#menu').on('click', function () {
                                               var mm = nc(this);
                                               nc('.menu-item', '#menu').slideToggle('slow',function(){
                                                   mm.toggleClass('active');
                                               });
                                           })
                                       });
                                </script>
                                <?php //wp_head(); ?>
                                </head>

                                <body <?php body_class(); ?>>
                                    <?php
                                    $group = get_group();

                                    $bg_image = get_bg_image();
                                    ?>


                                    <div id="background_container">
                                        <div id="background">


                                            <img id="bg_image" src="images/<?php echo $bg_image; ?>" width="1200" height="800" alt=" " />

                                        </div>
                                    </div>

                                    <div id="pagess">	
                                        <?php ?>
                                    <!-- <table style="border:none"><tr>
                                    <td><?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'nav-menu')); ?></td></tr>
                                        -->