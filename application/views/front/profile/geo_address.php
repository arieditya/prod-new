<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 10/8/14
 * Time: 9:39 AM
 * Proj: private-development
 */

	$markers = array();
	$addr = array();
	$i = 1;
	$latlong = array();
	foreach($geolocs as $geoloc) {
		$lat = $geoloc['geometry']['location']['lat'];
		$lng = $geoloc['geometry']['location']['lng'];
		$markers[] = "markers=color:red%7Clabel:{$i}%7C{$lat},{$lng}";
		$addr[] = $geoloc['formatted_address'];
		$latlong[$i] = "{$lat},{$lng}";
		$i++;
	}
	$marks = implode('&',$markers);
?><!DOCTYPE html>
<html>
<head>
	<style>
		.txt_sml {
			font-family: Trebuchet MS, Tahoma, Verdana, Arial, sans-serif;
			font-size: 0.9em;
		}
		img {
			display: inline-block;
			/*vertical-align: top;*/
		}
		.wdth_spc {
			width: 240px;
			display: inline-block;
		}
		.selectable {
			padding-top: 10px;
		}
		.selectable:hover {
			background-color: #ccc;
		}
	</style>
</head>
<!-- Insert Initial/Loader JS here -->
<script type="application/javascript" src="/js/jquery-1.9.1.min.js"></script>
<body>
	<div style="display: inline-block; vertical-align: top;">
		<img src="https://maps.googleapis.com/maps/api/staticmap?size=640x480&maptype=roadmap&<?php echo $marks;?>" />
	</div>
	<div style="display: inline-block; vertical-align: top;">
<?php if(count($geolocs)>0):?>
		<span class="txt_sml wdth_spc">
			Pilih lokasi yang terdekat dengan anda:
			<ol>
<?php
	$i = 0;
	$links = array();
	foreach($addr as $ad):
		$i++;
		$link = 'https://www.google.com/maps/place/'.urlencode($ad);
		$links[$i] = $link;
?>
				<li class="selectable">
					<span class="loc_selector" data-loc="<?php echo $i;?>"><?php echo $ad?></span>
					<br />
					<a href="<?php echo $link; ?>" target="_blank">View on Google Maps</a>
				</li>
<?php
	endforeach;
?>
			</ol>
		</span>
<?php else: ?>
		Empty Result!
<script type="application/javascript">
	$(document).ready(function(){
		alert('Alamat anda tidak ditemukan!\nCoba ganti alamat pencarian.');
		window.close();
	});
</script>
<?php endif;?>
	</div>
</body>
<!-- Insert JS here -->
<script type="application/javascript">
	var latlng = <?php echo json_encode($latlong);?>;
	var links = <?php echo json_encode($links);?>;

	$(document).ready(function(){
		$('.loc_selector').click(function(){
			if(confirm('Set lokasi?')) {
				window.opener.set_loc(latlng[$(this).data('loc')]+'||'+links[$(this).data('loc')]);
				window.close();
			}
		});
	});
</script>
</html>