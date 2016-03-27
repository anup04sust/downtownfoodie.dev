<script type="text/javascript" src="wp-content/themes/twentythirteen/js/Mootools1.2.More.js"></script>
<script type="text/javascript" src="wp-content/themes/twentythirteen/js/QuickBox.js"></script>

<script type="text/javascript" src="http://chamasdubai.com/js/instafeed.min.js"></script>
<link rel="stylesheet" type="text/css" href="wp-content/themes/twentythirteen/css/quickbox.css" />

<div id="instafeed" style="width:750px; height:395px; overflow:hidden"></div>

<script>
var feed = new Instafeed({
	limit: 24,
	get: 'tagged',
	tagName: 'crowneplazaabudhabi',
	clientId: '8582c580b5a2492d85d80631bf871c1c',
	resolution: 'standard_resolution',
	template: '<a rel="quickbox" href="{{image}}"><img height="25%" alt="{{caption}}" src="{{image}}" /></a>'
});
feed.run();
</script>
<script type="text/javascript">
window.onload=function(){new QuickBox();};	
</script>

