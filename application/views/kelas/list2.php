<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 2/27/15
 * Time: 3:00 PM
 * Proj: prod-new
 */
$this->load->helper('text');
$this->load->view('vendor/general/header2');
?>
<script type="application/javascript">
//	$.parseJSON();

	var delete_cookie = function(key) {
		document.cookie = key+'=;path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;'
	};

	var set_cookie = function(key, value) {
		console.log(key+'='+value+';');
		document.cookie = key+'='+value+';path=/';
		//if(!wait2second) clearTimeout(wait2second);
		//wait2second = window.setTimeout('window.location.reload()', 2000);
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
	var c_filter = get_cookie['filter'];

	var _filter_ = !c_filter?{}:$.parseJSON(get_cookie('filter'));
	if(!_filter_) _filter_ = {};

	var wait2second = null;

	var set_filter = function(key, value) {
		var keys = ['level','province','type','category'];
		if($.inArray(key, keys) >= 0) {
			_filter_[key] = value;
			set_cookie('filter', JSON.stringify(_filter_));
			//if(!wait2second) clearTimeout(wait2second);
			//wait2second = window.setTimeout('window.location.reload()', 2000);
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
		delete_cookie('filter');
		_filter_ = {};
		//window.location.reload();
	};

	$(document).ready(function(){
		$('#filter_container');
		reset_filter();
	});
</script>

	<div class="container content">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="block-title text-center">Kelas Pilihan</h3>
			</div>
		</div>
		<div class="row">
<?php
	$i = 0;
	$j = 0;
	if(!empty($featured)):
		foreach($featured as $kelas):
			if($i < 6) :
				if($i % 3 == 0 && $i > 0):
					$j++;
?>
		</div>
		<div class="row">
<?php 
				endif;
				$imgparts = explode('.',$kelas->class_image);
				$ext = array_pop($imgparts);
				array_push($imgparts, $ext);
				$img = empty($kelas->class_image)?'images/default_profile_image.png':('images/class/'.$kelas->id.'/'
						.implode('.', $imgparts));
				$vendor_img = explode('.',$kelas->vendor['info']->vendor_logo);
				$ext_vendor_img = array_pop($vendor_img);
				array_push($vendor_img, '40x40');
				array_push($vendor_img, $ext_vendor_img);
				$vendor_icon = implode('.',$vendor_img);
				$price = (int)$kelas->price_per_session;
				$disc = (int)$kelas->discount;
				if($kelas->class_paket == 2) {
					$_price = rupiah_format(($price * $kelas->count_session)-$disc).' /paket';
				} else {
					$_price = rupiah_format($price).' /sesi';
				}
				if($price==0) {
					$_price = "GRATIS";
				}
?>
			<div class="col-sm-4">
				<div class="content-grid <?php if($disc>0){ echo 'diskon';} ?>">
					<a href="<?php echo base_url().'kelas/'.$kelas->class_uri?>">
						<div class="grid-top" style="background-image: url('<?php echo base_url().$img;?>');">
							<img src="<?php echo base_url("images/vendor/{$kelas->vendor['profile']->id}/{$vendor_icon}")?>"
								 class="img-responsive logo-vendor-mini" alt="">
							<div class="grid-title-wrap" style="width: 100%">
								<h3 class="grid-title"><?php echo $kelas->class_nama?></h3>
							</div><!-- grid-title-wrap -->
						</div><!-- grid-top -->  
					</a>
					<div class="grid-bottom">
						<?php if($kelas->available == 1): ?>
							<span class="price"><?php echo $_price; ?></span>
						<?php else : ?>
							<span class="price">SOLD OUT</span>
						<?php endif; ?>
						<a href="<?php echo base_url().'kelas/'.$kelas->class_uri?>">
							<span class="details">Details</span>
						</a>
						<div class="description">
							<div class="calender-icon icon"><i class="fa fa-calendar-o"></i></div>
							<span class="date"> <?php echo date('d M Y', strtotime($kelas->class_tanggal));?> |
								<?php echo double_digit($kelas->class_jam_mulai).'.'.double_digit($kelas->class_menit_mulai)?> -
								<?php echo double_digit($kelas->class_jam_selesai).'.'.double_digit($kelas->class_menit_selesai)?> WIB
							</span>
							<?php if($kelas->count_session-1 > 0):
								?>
								dan <a href="<?php echo base_url('kelas/'.$kelas->class_uri)?>"
									   class="pink">
												<span class="link-sesi"><?php echo $kelas->count_session-1;?> sesi
													lainnya</span>
							</a>
							<?php else: ?>
								<br />
							<?php endif; ?>
							<div class="location">
								<?php if(!empty($kelas->lokasi_title)): ?>
									<div class="icon tag"><i class="fa fa-map-marker fa-2"></i></div>
									<b><span><?php echo $kelas->lokasi_title;?></span></b>
								<?php endif; ?>
							</div>
						</div><!-- description -->
						<div class="review">
							<div class="vendor-name"
								data-toggle="tooltip" data-placement="right" title="<?php echo $kelas->vendor['profile']->name;?>" data-original-title="<?php echo $kelas->vendor['profile']->name;?>">
								<div class="icon tag"><i class="fa fa-user fa-2"></i></div>
								<a href="<?php echo base_url()."vendor/detail/{$kelas->vendor['profile']->uri}"?>">
									<?php echo character_limiter($kelas->vendor['profile']->name,12);?>
								</a>
							</div>
							<div class="rating">
								<div class="icon tag"><i class="fa fa-star"></i></div>
								<b><?php echo (int)$kelas->rating->rate;?></b> (<?php echo $kelas->rating->counter?> review)
							</div>
						</div>
					</div><!-- grid-bottom -->
				</div> <!-- content-grid -->
			</div><!-- col-sm-4 -->
<?php 
			endif;
			$i++;
		endforeach;
	endif;
?>

		</div>
	</div> <!-- /container -->
	<div class="related">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="block-title text-center">Kelas Terbaru</h3>
				</div>
<?php
	$i = 0;
	$j = 0;
	$kelas = null;
	if(!empty($class)):
		foreach($class as $kelas):
			if($i < 6) :
				if($i % 3 == 0 && $i > 0){
					$j++;
?>
			</div> <!-- /row -->

			<div class="row">
<?php
				}
				$imgparts = explode('.',$kelas->class_image);
				$ext = array_pop($imgparts);
				array_push($imgparts, $ext);
				$img = empty($kelas->class_image)?'images/default_profile_image.png':('images/class/'.$kelas->id.'/'
					.implode('.', $imgparts));
				$vendor_img = explode('.',$kelas->vendor['info']->vendor_logo);
				$ext_vendor_img = array_pop($vendor_img);
				array_push($vendor_img, '40x40');
				array_push($vendor_img, $ext_vendor_img);
				$vendor_icon = implode('.',$vendor_img);
				$price = (int)$kelas->price_per_session;
				$disc = (int)$kelas->discount;
				if($kelas->class_paket == 2) {
					$_price = rupiah_format(($price * $kelas->count_session)-$disc).' /paket';
				} else {
					$_price = rupiah_format($price).' /sesi';
				}
				if($price==0) {
					$_price = "GRATIS";
				}
?>
				<div class="col-sm-4">
					<div class="content-grid <?php if($disc>0){ echo 'diskon';} ?>">
						<a href="<?php echo base_url().'kelas/'.$kelas->class_uri?>">
							<div class="grid-top" style="background-image: url('<?php echo base_url().$img;?>');">
								<img src="<?php echo base_url("images/vendor/{$kelas->vendor['profile']->id}/{$vendor_icon}")?>"
									 class="img-responsive logo-vendor-mini" alt="">
								<div class="grid-title-wrap" style="width: 100%">
									<h3 class="grid-title"><?php echo $kelas->class_nama?></h3>
								</div><!-- grid-title-wrap -->
							</div><!-- grid-top -->
						</a>
						<div class="grid-bottom">
<?php if($kelas->available == 1): ?>
								<span class="price"><?php echo $_price; ?></span>
<?php else : ?>
								<span class="price">SOLD OUT</span>
<?php endif; ?>
							<a href="<?php echo base_url().'kelas/'.$kelas->class_uri?>">
								<span class="details">Details</span>
							</a>
							<div class="description">
								<div class="calender-icon icon"><i class="fa fa-calendar-o"></i></div>
							<span class="date"> <?php echo date('d M Y', strtotime($kelas->class_tanggal));?> |
								<?php echo double_digit($kelas->class_jam_mulai).'.'.double_digit($kelas->class_menit_mulai)?> -
								<?php echo double_digit($kelas->class_jam_selesai).'.'.double_digit($kelas->class_menit_selesai)?> WIB
							</span>
<?php 
	if($kelas->count_session-1 > 0):
?>
									dan <a href="<?php echo base_url('kelas/'.$kelas->class_uri)?>"
										   class="pink">
												<span class="link-sesi"><?php echo $kelas->count_session-1;?> sesi
													lainnya</span>
								</a>
<?php else: ?>
									<br />
<?php endif; ?>
								<div class="location">
<?php if(!empty($kelas->lokasi_title)): ?>
										<div class="icon tag"><i class="fa fa-map-marker fa-2"></i></div>
										<b><span><?php echo $kelas->lokasi_title;?></span></b>
<?php endif; ?>
								</div>
							</div><!-- description -->
							<div class="review">
								<div class="vendor-name">
									<div class="icon tag"><i class="fa fa-user fa-2"></i></div>
									<a href="<?php echo base_url()."vendor/detail/{$kelas->vendor['profile']->uri}"?>"
										data-toggle="tooltip" data-placement="bottom" title="<?php echo $kelas->vendor['profile']->name;?>"
										>
										<?php echo character_limiter($kelas->vendor['profile']->name,12);?>
									</a>
								</div>
								<div class="rating">
									<div class="icon tag"><i class="fa fa-star"></i></div>
									<b><?php echo (int)$kelas->rating->rate;?></b> (<?php echo $kelas->rating->counter?> review)
								</div>
							</div>
						</div><!-- grid-bottom -->
					</div> <!-- content-grid -->
				</div><!-- col-sm-4 -->
<?php
			endif;
			$i++;
		endforeach;
	endif;
?>

				<div class="col-sm-4 col-sm-offset-4">
					<a href="<?php echo base_url()?>kelas/index/all" class="btn main-button text-center btn-orange">
						<i class="fa fa-list-ul"></i>
						Lihat Semua Kelas
					</a>
				</div>
			</div> <!-- /row -->
		</div> <!-- /container -->
	</div> <!-- /related -->
<?php
$this->load->view('vendor/general/footer2');