/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var nc = jQuery.noConflict();
var ELIGALLERY = {
  UploadImage: function (button, postID) {
    var $button = nc(button);
    var button_id = '#' + $button.attr('id');
    var gallerywrap = $button.parents('.admin-gallery-images').find('.eli-gallery-wrap');
    var send_attachment_bkp = wp.media.editor.send.attachment;
    var _custom_media = true;
    wp.media.editor.send.attachment = function (props, attachment) {
      nc('#preview-wrap-' + attachment.id).remove();
      var previewWrap = nc('<figure>');
      previewWrap.attr('id', 'preview-wrap-' + attachment.id);

      var imgUrl = nc('<input />');
      imgUrl.attr('name', 'gattachment[' + attachment.id + '][url]');
      imgUrl.attr('value', attachment.url);
      imgUrl.attr('type', 'hidden');         
      imgUrl.appendTo(previewWrap);
      console.log(attachment);
      if (nc.type(attachment.sizes.medium)  === "undefined") {
        var thumbnail = nc('<input />');
        thumbnail.attr('name', 'gattachment[' + attachment.id + '][thumbnail]');
        thumbnail.attr('value', attachment.sizes.thumbnail.url);
        thumbnail.attr('type', 'hidden');
        thumbnail.appendTo(previewWrap);
      } else {
        var thumbnail = nc('<input />');
        thumbnail.attr('name', 'gattachment[' + attachment.id + '][thumbnail]');
        thumbnail.attr('value', attachment.sizes.medium.url);
        thumbnail.attr('type', 'hidden');
        thumbnail.appendTo(previewWrap);
      }


      var imgpreview = nc('<img />');
      imgpreview.attr('src', attachment.sizes.thumbnail.url);
      imgpreview.attr('alt', attachment.id);
      imgpreview.appendTo(previewWrap);

      var closeButton = nc('<button type="button" onclick="ELIGALLERY.removeImage(' + attachment.id + ')"><span class="dashicons dashicons-no-alt"></span></button>');
      closeButton.appendTo(previewWrap);
      previewWrap.appendTo(gallerywrap);

    }
    wp.media.editor.open();
    return false;
  },
  removeImage: function (attachmentID) {
    nc('#preview-wrap-' + attachmentID).fadeIn('slow').remove();
  },
}
/*
 if (_custom_media) {
 $button.closest('.theme-media-box').find('input.image_url').val(attachment.url);
 if($button.closest('.theme-media-box').find('img').hasClass('media-box-img')){
 $button.closest('.theme-media-box').find('img').attr('src',attachment.url).slideDown();
 }else{
 var img = nc('<img/>');
 img.attr('src',attachment.url).attr('alt','Media Image').addClass('media-box-img');
 $button.closest('.theme-media-box').find('.mcontent').html(img);
 
 }
 $button.closest('.theme-media-box').find('.media-close').fadeIn();
 $button.fadeOut();
 
 } else {
 return _orig_send_attachment.apply(button_id, [props, attachment]);
 }
 */