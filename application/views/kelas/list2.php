<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 2/27/15
 * Time: 3:00 PM
 * Proj: prod-new
 */
$this->load->view('vendor/general/header2');
?>
<script type="application/javascript">
//	$.parseJSON();

	var set_cookie = function(key, value) {
		console.log(key+'='+value+';');
		document.cookie = key+'='+value+';';
		if(!wait2second) clearTimeout(wait2second);
		wait2second = window.setTimeout('window.location.reload()', 2000);
	};
	var get_cookie = function(ckey) {
		var ret;
		document.cookie.split(';').forEach(
				function(a){
					var a=a.trim();
					var b = a.split('=');
					var key = b.shift(); 
					var value = b.join('=');
					if(ckey == key) ret = value;
				});
		return ret;
	};

	var _filter_ = $.parseJSON(get_cookie('filter'));
	if(!_filter_) _filter_ = {};

	var wait2second = null;

	var set_filter = function(key, value) {
		var keys = ['day','level','province','type','price_range','category'];
		if($.inArray(key, keys) >= 0) {
			_filter_[key] = value;
			set_cookie('filter', JSON.stringify(_filter_));
			if(!wait2second) clearTimeout(wait2second);
			wait2second = window.setTimeout('window.location.reload()', 2000);
		}
	};

	var get_filter = function(key) {
		var keys = ['day','level','province','type','price_range','category'];
		if($.inArray(key, keys) >= 0) {
			return _filter_[key];
		}
	};

	var reset_filter = function() {
		set_cookie('filter', '');
		_filter_ = {};
		window.location.reload();
	};

	$(document).ready(function(){
		$('#filter_container')
	});
</script>

	<div class="container content">
		<div class="row">
			<div class="col-sm-12 block-title-wrap">
				<h2 class="block-title text-center text-uppercase">Kelas Pilihan</h2>
			</div>
<?php
	$i = 0;
	$j = 0;
	if(!empty($class)):
		foreach($class as $kelas):
			if($i < 6) :
				if($i % 3 == 0 && $i > 0){
					$j++;
?>
					</div>
					<div class="row">
<?php 
				}
				$imgparts = explode('.',$kelas->class_image);
				$ext = array_pop($imgparts);
				array_push($imgparts, $ext);
				$img = empty($kelas->class_image)?'images/default_profile_image.png':('images/class/'.$kelas->id.'/'
						.implode('.', $imgparts));
				$price = (int)$kelas->price_per_session;
				$disc = (int)$kelas->discount;
				if(empty($price)){
					$_price = '0,-';
				} else {
					$_price = number_format($price).',-';
				}
?>
			<div class="col-sm-4">
				<div class="content-grid diskon">
					<a href="#">
						<div class="grid-top" style="background-image: url('<?php echo base_url().$img;?>');">
							<div class="grid-title-wrap">
								<h3 class="grid-title"><?php echo $kelas->class_nama?></h3>
							</div><!-- grid-title-wrap -->
						</div><!-- grid-top -->  
					</a>
					<div class="grid-bottom">
						<span class="price"><?php echo $_price.' /sesi'; ?></span>
						<a href="<?php echo base_url().'kelas/'.$kelas->class_uri?>">
							<span class="details">Details</span>
						</a>
						<div class="description">
							<div class="icon"><i class="fa fa-calendar-o"></i></div>
							<span class="date"> <?php echo date('d M Y', strtotime($kelas->class_tanggal));?> | 
								<?php echo double_digit($kelas->class_jam_mulai).'.'.double_digit($kelas->class_menit_mulai)?> - 
								<?php echo double_digit($kelas->class_jam_selesai).'.'.double_digit($kelas->class_menit_selesai)?> WIB
							</span>
						</div><!-- description -->
						<div class="review">
							<div class="icon"><i class="fa fa-shopping-cart"></i></div>
							<span class="tag"><?php echo $kelas->vendor['profile']->name?></span>
							<div class="rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o"></i>
								<i class="fa fa-star-o"></i>
							</div>
						</div>
					</div><!-- grid-bottom -->
				</div> <!-- content-grid -->
			</div><!-- col-sm-4 -->
<?php 
			endif;
		endforeach;
	endif;
?>

			<div class="col-sm-4">
				<div class="content-grid">
					<a href="#">
						<div class="grid-top" style="background-image: url('<?php echo 
						base_url().'.';?>/assets/images/main_picture.jpg');">
							<div class="grid-title-wrap">
								<h3 class="grid-title">Training CodeIgniter: Breaking The Frame[works]</h3>
							</div><!-- grid-title-wrap -->
						</div><!-- grid-top -->  
					</a>
					<div class="grid-bottom">
						<span class="price">Rp 75,000,- /sesi</span>
						<a href="#"><span class="details">Details</span></a>
						<div class="description">
							<div class="icon"><i class="fa fa-calendar-o"></i></div>
							<span class="date"> 08 Mar 2015 | 17.00 - 19.00 WIB</span>
						</div><!-- description -->
						<div class="review">
							<div class="icon"><i class="fa fa-shopping-cart"></i></div>
							<span class="tag">kelas ruangguru</span>
							<div class="rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>
						</div>
					</div><!-- grid-bottom -->
				</div> <!-- content-grid -->
			</div><!-- col-sm-4 -->
			<div class="col-sm-4">
				<div class="content-grid">
					<a href="#">
						<div class="grid-top" style="background-image: url('<?php echo 
						base_url().'.';?>/assets/images/main_picture.jpg');">
							<div class="grid-title-wrap">
								<h3 class="grid-title">Training CodeIgniter: Breaking The Frame[works]</h3>
							</div><!-- grid-title-wrap -->
						</div><!-- grid-top -->  
					</a>
					<div class="grid-bottom">
						<span class="price">Rp 75,000,- /sesi</span>
						<a href="#"><span class="details">Details</span></a>
						<div class="description">
							<div class="icon"><i class="fa fa-calendar-o"></i></div>
							<span class="date"> 08 Mar 2015 | 17.00 - 19.00 WIB</span>
						</div><!-- description -->
						<div class="review">
							<div class="icon"><i class="fa fa-shopping-cart"></i></div>
							<span class="tag">kelas ruangguru</span>
							<div class="rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>
						</div>
					</div><!-- grid-bottom -->
				</div> <!-- content-grid -->
			</div><!-- col-sm-4 -->
			<div class="col-sm-4 col-sm-offset-4">
				<a href="#" class="main-button text-center">Lihat Semua Kelas</a>
			</div>
		</div>
	</div> <!-- /container -->
<?php
$this->load->view('vendor/general/footer2');