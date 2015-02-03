<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 10/14/14
 * Time: 7:52 AM
 * Proj: private-development
 */
$this->load->view('vendor/general/header');
?>
<link href="<?php echo base_url();?>assets/css/bootstrap-slider.css" rel="stylesheet" />
<script src="<?php echo base_url();?>assets/js/bootstrap-slider.js" type="application/javascript"></script>
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="row">
<?php /*
				<div class="col-md-offset-2 col-md-8" style="margin-bottom: 20px;">
					<ul class="filter_container">
						<li>
							<p>Filter:</p>
							<div>
								<?php echo nl2br(print_r($filter, TRUE), TRUE);?>
								<pre><?php echo var_dump($filter_query)?></pre>
							</div>
						</li>
					</ul>
				</div>
*/ ?>
<style type="text/css">
	
</style>
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
			</div>
			<div class="row">
				<div class="col-md-offset-1 col-md-10">
					<ul class="nav nav-pills">
						<li class="title-filter text-16">Filter</li>
						<li id="cat_list" class="dropdown<?php $active = (int)$this->input->get('category', TRUE);echo !empty($active)?' active':''; ?>">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								Hari <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li>Senin</li>
								<li>Selasa</li>
								<li>Rabu</li>
								<li>Kamis</li>
								<li>Jumat</li>
								<li>Sabtu</li>
								<li>Minggu</li>
							</ul>
						</li>
						<li id="lev_list" class="dropdown<?php $active = (int)$this->input->get('level', TRUE);echo !empty($active)?' active':''; ?>">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								Level <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
<?php foreach($level as $lev):
	$act = empty($filter['level'])?FALSE:$lev->id == $filter['level']?TRUE:FALSE;
	$get = $_GET;
	$get['level'] = $lev->id;
	unset($get['_']);
	$par = '?_='.time();
	foreach($get as $getk => $getv){
		$par .= "&{$getk}={$getv}";
	}
/*
								<li><a class="lev_id" data-id="<?php echo $lev->id;?>" href="<?php echo $par; ?>"><?php echo $act?'<i class="glyphicon glyphicon-check"></i> ':''; ?><?php echo ucwords($lev->name);?></a></li>
 */
?>
								<li>
									<div class="row">
										<div class="col-xs-2 level_check level_<?php echo $lev->id;?>" id=""><?php echo $act?'<i class="fa fa-check"></i> ':''; ?></div>
										<div class="col-xs-10"><a href="#" class="filter_level" data-id="<?php echo $lev->id;?>"><?php echo ucwords($lev->name);?></a></div>
									</div>
								</li>
<?php endforeach;?>
							</ul>
						</li>
						<li id="prov_list" class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								Provinsi <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
							<?php foreach($province as $prov){?>
								<li><a href="#"><?php echo $prov->provinsi_title; ?></a></li>
							<?php } ?>
							</ul>
						</li>
						<li id="tipe_list" class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								Tipe kelas <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
							</ul>
						</li>
						<li id="harga_list" class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								Rentang Harga <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
							</ul>
						</li>
						<li id="sort_by_list" class="dropdown pull-right">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								Pilihan <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li>Harga Termurah</li>
								<li>On Going Class</li>
								<li>Upcoming Class</li>
								<li>Past Class</li>
							</ul>
						</li>
						<li class="title-filter text-16 pull-right">Urutan</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-offset-1 col-md-2">
					<h4 class="title-filter italic">Kelas Pilihan</h4>
					<h4 class="italic">Semua Pilihan</h4>
					
					<ul id="tbl-cat-filter">
					<li class="heading-tbl-class white-text bold">Kategori</li>
<?php foreach($category as $cat):
	$act = FALSE;
	if(!empty($filter['category']) )
		$act = in_array($cat->id, $filter['category']) ?TRUE:FALSE;
	$get = $_GET;
	$get['category'] = $cat->id;
	unset($get['_']);
	$par = '?_='.time();
	foreach($get as $getk => $getv){
		$par .= "&{$getk}={$getv}";
	}
?>
						<li>
							<div class="row">
								<div class="col-xs-10"><a href="#" class="filter_category bold" data-id="<?php echo $cat->id;?>"><?php echo ucwords($cat->category_name);?></a>&nbsp;<span class="cat_<?php echo $cat->id;?>" ><?php echo $act?'<i class="fa fa-check"></i> ':''; ?></span></div>
							</div>
						</li>
<?php endforeach;?>
					</ul>
					<div class="blue-rect bold">
						<i>Jadi penyelenggara kelas? <a href="<?php echo base_url();?>vendor/auth/logreg" class="white-text">Klik di sini!</a></i>
					</div>
				</div>
				<div class="col-md-8">
					<div class="row">
<?php
	$i = 0;
	$j = 0;
	if(!empty($class)):
	foreach($class as $kelas):
		if($i % 4 == 0 && $i > 0):
?>
					</div>
					<div class="row">
<?php 
		endif;
		$img = empty($kelas->class_image)?'images/default_profile_image.png':('images/class/'.$kelas->id.'/'.$kelas->class_image);
		$price = (int)$kelas->price_per_session;
		if(empty($price)){
			
		} else {
			$_price = number_format($price, 0, ',', '.').',-';
		}
?>
						<div class="col-md-4 bottom-20">
							<div class="thumbnail">
								<img data-src="<?php echo base_url().$img;?>" src="<?php echo base_url().$img;?>" alt="..." <?php echo !empty($price)?"dee-picture data-price='{$_price}'":''?> <?php echo !empty($kelas->discount)?'dee-discount':''?> />
								<span class="price-class bold title-filter">Rp 1,2 jt/ sesi</span>
								<div class="class-info">
									<div class="line-title"><span class="bold text-left text-16 title-filter"><?php echo $kelas->class_nama?></span></div>
									<div class="class-schedule">
										<p class="text-13"><?php echo date('d F Y', strtotime($kelas->class_tanggal));?> | 17.00 - 19.00 WIB<br/>
											dan <a href="#"><span class="title-filter link-sesi"><?php echo 5;?> sesi lainnya</span></a> | <?php echo $kelas->class_lokasi?><br/>
										</p>
										<img src="<?php echo base_url().'images/vendor/'.$vendor['profile'][$j][0]->id.'/'.$vendor['info'][$j][0]->vendor_logo;?>"/>&nbsp;<a href="#" class="link-vendor">Toko Kue Primadona</a><a class="btn btn-info pos-btn" href="<?php echo base_url('kelas/'.$kelas->class_uri)?>">More</a>
									</div>
								</div>
							</div>
						</div>
<?php 
	$j++;
	endforeach;
	else:
?>
					<div class="col-md-12">
						<div class="jumbotron">
							<h3>No Data Found!
								<small>Please refine your filter..</small>
							</h3>
						</div>
					</div>
<?php
	endif;
?>

					</div>
<?php /* ?>
					<div class="row">
						<div class="col-md-3">
							<div class="thumbnail">
								<img data-src="<?php echo base_url();?>images/privat.jpg" src="<?php echo base_url();?>images/privat.jpg" alt="..." />
								<h3>Nama Kelas</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ex dolor, molestie id sapien vel, ornare eleifend tellus. Etiam at nulla imperdiet ex commodo aliquam. Sed cursus sollicitudin ex, in ultricies quam fermentum non. Nam mattis, tellus sed rutrum blandit, purus sem cursus nulla, eget gravida orci ex in libero. Phasellus maximus iaculis risus lacinia mollis. Quisque id maximus leo, ac imperdiet massa. Integer at interdum nibh.</p>
								<p>Nulla at molestie massa. Interdum et malesuada fames ac ante ipsum primis in faucibus. In enim mauris, rutrum sit amet suscipit id, aliquet vitae velit. Vestibulum fermentum justo non ante facilisis, non dapibus lorem finibus. Vivamus facilisis a lectus in dictum. Vivamus rhoncus commodo justo, ac mollis eros. Quisque congue ullamcorper ante vitae hendrerit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam rutrum augue congue mi tincidunt, gravida convallis justo vulputate.</p>
								<p>Suspendisse potenti. Curabitur congue aliquet libero, et tempus ante hendrerit quis. Suspendisse lobortis, mauris in venenatis varius, ante dui suscipit nunc, id molestie sem sem sit amet diam. Pellentesque auctor sapien id aliquam iaculis. Suspendisse vel mi interdum, tempor risus ut, feugiat elit. Proin non rutrum leo. Nulla in iaculis risus. Suspendisse est lorem, congue nec dolor ut, interdum congue dui. Donec ac dictum neque. Duis congue hendrerit metus, et euismod mauris malesuada nec. Sed iaculis ex vel convallis rutrum. Cras vel ligula eu lacus pharetra ultrices ut eget odio. Etiam porta augue leo, non posuere neque ullamcorper vestibulum. Quisque nec velit non nisi tincidunt vestibulum sed et magna. Etiam aliquet, libero convallis rutrum consectetur, arcu ligula lobortis magna, ut mollis dui elit sed tortor. Integer sit amet lacus nec augue congue auctor.</p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="thumbnail">
								<img data-src="<?php echo base_url();?>images/unggulan/678.jpg" src="<?php echo base_url();?>images/unggulan/678.png" alt="..." />
								<h3>Nama Kelas</h3>
								<p>Deskripsi Kelas</p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="thumbnail">
								<img data-src="<?php echo base_url();?>images/unggulan/684.png" src="<?php echo base_url();?>images/unggulan/684.png" alt="..." />
								<h3>Nama Kelas</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ex dolor, molestie id sapien vel, ornare eleifend tellus. Etiam at nulla imperdiet ex commodo aliquam. Sed cursus sollicitudin ex, in ultricies quam fermentum non. Nam mattis, tellus sed rutrum blandit, purus sem cursus nulla, eget gravida orci ex in libero. Phasellus maximus iaculis risus lacinia mollis. Quisque id maximus leo, ac imperdiet massa. Integer at interdum nibh.</p>
								<p>Nulla at molestie massa. Interdum et malesuada fames ac ante ipsum primis in faucibus. In enim mauris, rutrum sit amet suscipit id, aliquet vitae velit. Vestibulum fermentum justo non ante facilisis, non dapibus lorem finibus. Vivamus facilisis a lectus in dictum. Vivamus rhoncus commodo justo, ac mollis eros. Quisque congue ullamcorper ante vitae hendrerit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam rutrum augue congue mi tincidunt, gravida convallis justo vulputate.</p>
								<p>Suspendisse potenti. Curabitur congue aliquet libero, et tempus ante hendrerit quis. Suspendisse lobortis, mauris in venenatis varius, ante dui suscipit nunc, id molestie sem sem sit amet diam. Pellentesque auctor sapien id aliquam iaculis. Suspendisse vel mi interdum, tempor risus ut, feugiat elit. Proin non rutrum leo. Nulla in iaculis risus. Suspendisse est lorem, congue nec dolor ut, interdum congue dui. Donec ac dictum neque. Duis congue hendrerit metus, et euismod mauris malesuada nec. Sed iaculis ex vel convallis rutrum. Cras vel ligula eu lacus pharetra ultrices ut eget odio. Etiam porta augue leo, non posuere neque ullamcorper vestibulum. Quisque nec velit non nisi tincidunt vestibulum sed et magna. Etiam aliquet, libero convallis rutrum consectetur, arcu ligula lobortis magna, ut mollis dui elit sed tortor. Integer sit amet lacus nec augue congue auctor.</p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="thumbnail">
								<img data-src="<?php echo base_url();?>images/tentangkami/tim/rain.png" src="<?php echo base_url();?>images/tentangkami/tim/rain.png" alt="..." />
								<h3>Nama Kelas</h3>
								<p>Deskripsi Kelas</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="thumbnail">
								<img data-src="<?php echo base_url();?>images/privat.jpg" src="<?php echo base_url();?>images/privat.jpg" alt="..." />
								<h3>Nama Kelas</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ex dolor, molestie id sapien vel, ornare eleifend tellus. Etiam at nulla imperdiet ex commodo aliquam. Sed cursus sollicitudin ex, in ultricies quam fermentum non. Nam mattis, tellus sed rutrum blandit, purus sem cursus nulla, eget gravida orci ex in libero. Phasellus maximus iaculis risus lacinia mollis. Quisque id maximus leo, ac imperdiet massa. Integer at interdum nibh.</p>
								<p>Nulla at molestie massa. Interdum et malesuada fames ac ante ipsum primis in faucibus. In enim mauris, rutrum sit amet suscipit id, aliquet vitae velit. Vestibulum fermentum justo non ante facilisis, non dapibus lorem finibus. Vivamus facilisis a lectus in dictum. Vivamus rhoncus commodo justo, ac mollis eros. Quisque congue ullamcorper ante vitae hendrerit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam rutrum augue congue mi tincidunt, gravida convallis justo vulputate.</p>
								<p>Suspendisse potenti. Curabitur congue aliquet libero, et tempus ante hendrerit quis. Suspendisse lobortis, mauris in venenatis varius, ante dui suscipit nunc, id molestie sem sem sit amet diam. Pellentesque auctor sapien id aliquam iaculis. Suspendisse vel mi interdum, tempor risus ut, feugiat elit. Proin non rutrum leo. Nulla in iaculis risus. Suspendisse est lorem, congue nec dolor ut, interdum congue dui. Donec ac dictum neque. Duis congue hendrerit metus, et euismod mauris malesuada nec. Sed iaculis ex vel convallis rutrum. Cras vel ligula eu lacus pharetra ultrices ut eget odio. Etiam porta augue leo, non posuere neque ullamcorper vestibulum. Quisque nec velit non nisi tincidunt vestibulum sed et magna. Etiam aliquet, libero convallis rutrum consectetur, arcu ligula lobortis magna, ut mollis dui elit sed tortor. Integer sit amet lacus nec augue congue auctor.</p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="thumbnail">
								<img data-src="<?php echo base_url();?>images/unggulan/678.jpg" src="<?php echo base_url();?>images/unggulan/678.png" alt="..." />
								<h3>Nama Kelas</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ex dolor, molestie id sapien vel, ornare eleifend tellus. Etiam at nulla imperdiet ex commodo aliquam. Sed cursus sollicitudin ex, in ultricies quam fermentum non. Nam mattis, tellus sed rutrum blandit, purus sem cursus nulla, eget gravida orci ex in libero. Phasellus maximus iaculis risus lacinia mollis. Quisque id maximus leo, ac imperdiet massa. Integer at interdum nibh.</p>
								<p>Nulla at molestie massa. Interdum et malesuada fames ac ante ipsum primis in faucibus. In enim mauris, rutrum sit amet suscipit id, aliquet vitae velit. Vestibulum fermentum justo non ante facilisis, non dapibus lorem finibus. Vivamus facilisis a lectus in dictum. Vivamus rhoncus commodo justo, ac mollis eros. Quisque congue ullamcorper ante vitae hendrerit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam rutrum augue congue mi tincidunt, gravida convallis justo vulputate.</p>
								<p>Suspendisse potenti. Curabitur congue aliquet libero, et tempus ante hendrerit quis. Suspendisse lobortis, mauris in venenatis varius, ante dui suscipit nunc, id molestie sem sem sit amet diam. Pellentesque auctor sapien id aliquam iaculis. Suspendisse vel mi interdum, tempor risus ut, feugiat elit. Proin non rutrum leo. Nulla in iaculis risus. Suspendisse est lorem, congue nec dolor ut, interdum congue dui. Donec ac dictum neque. Duis congue hendrerit metus, et euismod mauris malesuada nec. Sed iaculis ex vel convallis rutrum. Cras vel ligula eu lacus pharetra ultrices ut eget odio. Etiam porta augue leo, non posuere neque ullamcorper vestibulum. Quisque nec velit non nisi tincidunt vestibulum sed et magna. Etiam aliquet, libero convallis rutrum consectetur, arcu ligula lobortis magna, ut mollis dui elit sed tortor. Integer sit amet lacus nec augue congue auctor.</p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="thumbnail">
								<img data-src="<?php echo base_url();?>images/unggulan/684.png" src="<?php echo base_url();?>images/unggulan/684.png" alt="..." />
								<h3>Nama Kelas</h3>
								<p>Deskripsi Kelas</p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="thumbnail">
								<img data-src="<?php echo base_url();?>images/tentangkami/tim/rain.png" src="<?php echo base_url();?>images/tentangkami/tim/rain.png" alt="..." />
								<h3>Nama Kelas</h3>
								<p>Deskripsi Kelas</p>
							</div>
						</div>
					</div>
<?php // */ ?>
				</div>
			</div>
		</div>
	</div>
<script type="application/javascript">
	$(document).ready(function(){
		$('.filter_level').click(function(e){
			e.preventDefault();
			var lvl_id = $(this).data('id');
			$('.level_check').empty();
			$('.level_'+lvl_id).append($('<i class="glyphicon fa fa-check"></i>'));
			set_filter('level', lvl_id);
			return false;
		});
		$('.filter_category').click(function(e){
			e.preventDefault();
			var cat_id = $(this).data('id');
			var filter_category = get_filter('category');
			if(!filter_category) filter_category = [];
			var key_position = $.inArray(cat_id, filter_category);
			// toggling
			if( key_position >= 0 ) {
				delete(filter_category[key_position]);
				filter_category = filter_category.filter(function(){return true;});
				$('.cat_'+cat_id).empty();
			} else {
				filter_category.push(cat_id);
				$('.cat_'+cat_id).append($('<i class="fa fa-check"></i>'));
			}
			set_filter('category', filter_category);
			return false;
		});
		
		$('#price_slider').slider({});
		$('#price_slider').on('slide', function(e){
			var filter_price_range = get_filter('price_range');
			if(!filter_price_range) filter_price_range = {'hi':2000000, 'lo':100000};
			filter_price_range.lo = e.value[0];
			filter_price_range.hi = e.value[1];
			
				set_filter('price_range', filter_price_range);

			$('#minrange').val(e.value[0]);
			$('#maxrange').val(e.value[1]);
		});
		$('#reset_filter').click(function(){
			window.location.href = window.location.origin+window.location.pathname;
		});
		$('#search_range').click(function(e){
			e.preventDefault();
			var qs = location.search;
			if(qs.length > 0){
				qs = qs.substr(1);
				var qse = qs.split('&');
				var qsb = '?';
				if(qse.length > 0){
					for(var i=0; i<qse.length; i++){
						if(qsb.length > 0) qsb += '&';
						var par = qse[i].split('=');
						if(par[0] == 'minrange' || par[0] == 'maxrange') {
						} else {
							qsb += qse[i];
						}
					}
					$('#price_slider').data('slider-value');
					qsb += '&minrange='+($('#minrange').val());
					qsb += '&maxrange='+($('#maxrange').val());
				} else {
					qsb += 'minrange='+($('#minrange').val());
					qsb += '&maxrange='+($('#maxrange').val());
				}
			} else {
				var qsb = '?minrange='+($('#minrange').val());
				qsb += '&maxrange='+($('#maxrange').val());
			}
			var path = window.location.origin+window.location.pathname+qsb;
			window.location.href=path;
			return false;
		});
		$.each($('img[dee-picture]'), function(i, elm){
			var t = $('<div class="price-tag bold"><div>');
			var price = $(elm).data('price');
			price = price.replace('#', '<br />');
			t.html("<span class='white-text text-16'>DISKON</span><br/>"+price);
			$(elm).before(t);
			console.log(elm);
		});
		$.each($('img[dee-discount]'), function(i, elm){
			$(elm).before(
			$('<div class="discount-tag"></div>')
					.append($("<img src='<?php echo base_url();?>images/discount.png' />"))
			);
		});

		$('#reset_filter').click(function(e){
			e.preventDefault();
			reset_filter();
			return false;
		});
	});
</script>
<?php
$this->load->view('vendor/general/footer');
?>
