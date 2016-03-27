// rollOvers pour les images
// Application : class="roll"
window.addEvent('domready', function() {
	//preload images
	var aPreLoad = new Array();
	var aPreLoadi = 0;
	
	//do rollover
	$$('img.roll', 'input.roll').each(function(el){
		//let's preload
		aPreLoad[aPreLoadi] = new Image();
		aPreLoad[aPreLoadi].src = el.src.replace('_off.', '_on.');
		aPreLoadi++;
	
		el.addEvent('mouseover',function(){
			this.setAttribute('src',this.src.replace('_off_', '_on_'));
		});
	
		el.addEvent('mouseout',function(){
			this.setAttribute('src',this.src.replace('_on_','_off_'));
		});
	});
	
	// resize the background please
	resize_background_image_now();	
});

// On IMG Error
window.addEvent('domready',function() {
	$$('img').addEvent('error',function() {
		var notification = new Request({
			url: 'ajax-image-error.php',
			method: 'post',
			data: {
				'image': this.get('src'),
				'page': window.location.href
			}
		}).send();
	});
});

// un background toujours visible, dependant la largeur et hauteur de la page
window.addEvent('resize', resize_background_image_now);

function resize_background_image_now()
{	
	var bg = $('background').getElement('img');
	
	var ratio = 12/8;
	
	bg.set('width', window.getWidth());
	bg.set('height', window.getWidth() / ratio);
	
	if (bg.getStyle('height').toInt() < window.getHeight()) {
		bg.set('height', window.getHeight());
		bg.set('width', window.getHeight() * ratio);
	}
}

function toggle_content()
{
	var el = $('container');
	var img = $('content-toggler').getElement('img');
	
	if (parseInt(el.getStyle('top')) < 70) {
		el.tween('top', 70);
		img.src = 'wp-content/themes/twentythirteen/images/hide.png';
	} else {
		el.tween('top', -370);
		img.src = 'wp-content/themes/twentythirteen/images/show.png';
	}
}
 
 function toggle_content_e()
{
	var el = $('container');
	var img = $('content-toggler').getElement('img');
	
	if (parseInt(el.getStyle('top')) < 70) {
		el.tween('top', 70);
		img.src = 'wp-content/themes/twentythirteen/images/hide.png';
	} else {
		el.tween('top', -370);
		img.src = 'wp-content/themes/twentythirteen/images/show.png';
	}
}

function show_error(id,message){
	alert(message);
	document.getElementById(id).focus();
	}	