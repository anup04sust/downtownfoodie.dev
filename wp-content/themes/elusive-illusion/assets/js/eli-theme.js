/*
 * @package IllusiveDesign
 * @subpackage Elusive Illusion
 * @since Elusive Illusion 1.0
 */
"use strict";
var nc = jQuery.noConflict();
nc(document).ready(function () {

    /* Table */
    nc('.entry-content table').addClass('table');
    /* Embed Responsive */
    nc('.embed-responsive iframe').addClass('embed-responsive-item');
    if (typeof eli_obj.page_bg_img != "undefined") {
        nc('#page-backstretch').backstretch(eli_obj.page_bg_img);
    }
    nc('.menu-item > a', '#navbar-primary').hover(function () {
        var menuTitle = nc(this).attr('title');
        nc('#primary-menu-title').text(menuTitle);
    }, function () {
        nc('#primary-menu-title').text('');
    });
    nc('input.custom-datetime').datetimepicker({
        showTodayButton: true,
        format: 'MM/DD/YYYY hh:mm a',
        minDate: moment(),
        maxDate: moment().add(1, 'months'),
    });
    nc('#type_of_event').on('change', function () {
        if (nc(this).val() == 'Other') {
            nc('#other_event_wrap').removeClass('hidden');
        } else {
            nc('#other_event_wrap').addClass('hidden');
        }
    });
    nc('.drop_icon','#navbar-primary').on('click',function(){
        nc(this).parents('.dropdown').find('> .dropdown-menu').stop().slideToggle();
        nc(this).toggleClass('drop_up');
        return false;
    });
  
  nc('.gallery').Chocolat({
    loop: true,
    imageSize: 'default',
    overlayOpacity: 0.9,
    imageSelector:'.gallery-item a'
  }); 
 nc('.custom-scroller').mCustomScrollbar({theme:"3d-thick"});  
});
nc(window).on('load',function(){
 nc('.gallery').isotope({
    itemSelector: '.gallery-item',
    layoutMode: 'packery'
  });
});