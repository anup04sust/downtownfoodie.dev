/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
"use strict";
var nc = jQuery.noConflict();
nc(document).ready(function () {
  var $grid = nc('#gallery-tiles .gallery-wrap').isotope({
    itemSelector: '.gallery-gcol',
    layoutMode: 'packery'
  });
  // layout Masonry after each image loads
  $grid.imagesLoaded().progress(function () {
    $grid.isotope('layout');
  });
  var $grid2 = nc('#inner-content .album-page').isotope({
    itemSelector: '.gallery-item',
    layoutMode: 'packery'
  });
  $grid2.imagesLoaded().progress(function () {
    $grid2.isotope('layout');
  });
  var $grid3 = nc('#gattachment-gallery').isotope({
    itemSelector: '.ggird',
    layoutMode: 'packery'
  });
  $grid3.imagesLoaded().progress(function () {
    $grid3.isotope('layout');
  });
//  nc('#gattachment-gallery').Chocolat({
//    loop: false,
//    imageSize: 'default',
//    overlayOpacity: 0.9,
//    imageSelector: '.gattachment-preview'
//  });
  nc('.album-wrap').Chocolat({
    loop: false,
    imageSize: 'default',
    overlayOpacity: 0.9,
    imageSelector: '.caption'
  });
  nc('#gallery-tiles').Chocolat({
    loop: true,
    imageSize: 'container',
    overlayOpacity: 0.9,
    imageSelector: '.thumbnail-links'
  });
});

