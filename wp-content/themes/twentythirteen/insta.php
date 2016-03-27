<link rel="stylesheet" type="text/css" href="wp-content/themes/twentythirteen/css/quickbox.css" />
<style type="text/css">
#style-1 img{padding:4px; float:left;}

.scrollbar
{
	float: left;
	height: 430px;
	width: 715px;
	overflow-y: scroll;
}

.force-overflow
{
	min-height: 650px;
}

#style-1::-webkit-scrollbar-track
{
	background-color: #F5F5F5;
}

#style-1::-webkit-scrollbar
{
	width: 10px;
	background-color: #000;
}

#style-1::-webkit-scrollbar-thumb
{
	background-color: #33CC00;
}

</style>


<div  class="scrollbar" id="style-1">

<?php

$dir = 'gallery/';
$thumb_dir = 'thumbs/';
$i=0;
if ($handle = opendir($thumb_dir)) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
			$i++;

            $list[] = $entry; 
		
        }
    }
    closedir($handle);
}
//print_r($list);
sort($list);
//print_r($list);

foreach($list as $entry){
	
		echo "<a rel='quickbox' href='$dir$entry'><img style='float:left' height='84' src='$thumb_dir$entry' /></a> 					";
	}


?>

<div class="force-overflow"></div>				 
</div>


<script type="text/javascript" src="wp-content/themes/twentythirteen/js/Mootools1.2.More.js"></script>
<script type="text/javascript" src="wp-content/themes/twentythirteen/js/QuickBox.js"></script>
<script type="text/javascript">
	
new QuickBox();

</script>