/*
 * @package IllusiveDesign
 * @subpackage Elusive Illusion
 * @since Elusive Illusion 1.0
 */
"use strict";
var nc = jQuery.noConflict();
  /*
   * MobileMenu
   */
  nc('#mobilemenu-container').mmenu({
    extensions: [eli_obj.mm_theme, "effect-slide-listitems"],
    searchfield: false,
    counters: false,
    navbar: {
      title: 'MENU',
    },
    navbars: [
      {
        position: 'top',
        content: ['<a href="' + eli_obj.site_url + '" class="mm-logo"><img src="' + eli_obj.mm_logo + '" /></a>'], height: 2,
      }, {
        position: 'top',
        content: [
          'prev',
          'title',
          'close'
        ]
      }
    ],
    offCanvas: {
      position: "right",
      zposition: "front",
    },
  });
  var mmenuAPI = nc("#mobilemenu-container").data("mmenu");

  nc('#mm-button-toggle').on('click', function () {
    mmenuAPI.open();
    return false;
  });
  nc('.mm-custom-close').on('click', function () {
    mmenuAPI.close();
    return false;
  });

