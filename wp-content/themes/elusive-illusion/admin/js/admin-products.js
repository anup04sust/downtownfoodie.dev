/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var nc= jQuery.noConflict();
var ELI_PRODUCT = {
  show_order_field:function(span){
    nc(span).fadeOut();
    var spanparent = nc(span).parent();
    spanparent.find('.inline-order').fadeIn();
    spanparent.find('.button').fadeIn();
  },
  update_order:function(button,post_id){
    nc(button).attr('disabled','disabled');
    var buttonparent = nc(button).parent();
    var inputfield = buttonparent.find('.inline-order');
    nc.ajax({
      url:PRODUCT_JSOBJ.ajax_url,
      method:'post',
      data:{action:PRODUCT_JSOBJ.action,post_id:post_id,doing:'update_order',neworder:inputfield.val()},
      dataType:'json',
      success:function(responce){
        console.log(responce);
        nc(button).removeAttr('disabled');
         location.reload();
      }
    });
  }
}

