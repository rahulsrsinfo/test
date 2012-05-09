<?php

/**
 * Jcrop image cropping plugin for jQuery
 * Example cropping script
 * @copyright 2008-2009 Kelly Hallman
 * More info: http://deepliquid.com/content/Jcrop_Implementation_Theory.html
 * RAHSRS
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$targ_w = $targ_h = 150;
	$jpeg_quality = 90;

	$src = 'demo_files/userpicture_temp3851.jpg';
	$img_r = imagecreatefromjpeg($src);
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
	$targ_w,$targ_h,$_POST['w'],$_POST['h']);


	header('Content-type: image/jpeg');
	imagejpeg($dst_r,'demo_files/crop.jpg',$jpeg_quality);

}

// If not a POST request, display page below:
?>
<html>
	<head>

		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.Jcrop.js"></script>
		<link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
		<link rel="stylesheet" href="demo_files/demos.css" type="text/css" />

		<script language="Javascript">

			$(function(){

				$('#cropbox').Jcrop({
					aspectRatio: 1,
					onSelect: updateCoords
				});

			});

			function updateCoords(c)
			{
				$('#x').val(c.x);
				$('#y').val(c.y);
				$('#w').val(c.w);
				$('#h').val(c.h);
			};

			function checkCoords()
			{
				if (parseInt($('#w').val())) return true;
				alert('Please select a crop region then press submit.');
				return false;
			};

		</script>

	</head>

	<body>

	<div id="outer">
	<div class="jcExample">
	<div class="article">

		<h1>Jcrop - Crop Behavior</h1>

		<!-- This is the image we're attaching Jcrop to -->
		<img src="demo_files/userpicture_temp3851.jpg" id="cropbox" />

		<!-- This is the form that our event handler fills -->
		<form action="crop.php" method="post" onSubmit="return checkCoords();">
			<input type="text" id="x" name="x" />
			<input type="text" id="y" name="y" />
			<input type="text" id="w" name="w" />
			<input type="text" id="h" name="h" />
			<input type="submit" value="Crop Image" />
		</form>

	</div>
	</div>
	</div>
	</body>

</html>
