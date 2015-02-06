<?php
$this->load->view('general/header-bootstrap');
$got_topic = FALSE;
foreach($schedule->result() as $jdwl):
	if(!empty($jdwl->class_jadwal_topik)){
		$got_topic = TRUE;
		break;
	}
endforeach;
$sched = $schedule->result();
$arr = array();
foreach($sched as $s) {
	$arr[] = $s->jadwal_id;
}
?>
<script>
		// Wait until the DOM has loaded before querying the document
		$(document).ready(function(){
			$('ul.tabs').each(function(){
				// For each set of tabs, we want to keep track of
				// which tab is active and it's associated content
				var $active, $content, $links = $(this).find('a');

				// If the location.hash matches one of the links, use that as the active tab.
				// If no match is found, use the first link as the initial active tab.
				$active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
				$active.addClass('active');

				$content = $($active[0].hash);

				// Hide the remaining content
				$links.not($active).each(function () {
					$(this.hash).hide();
				});

				// Bind the click event handler
				$(this).on('click', 'a', function(e){
					// Make the old tab inactive.
					$active.removeClass('active');
					$content.hide();

					// Update the variables with the new link and content
					$active = $(this);
					$content = $(this.hash);

					// Make the tab active.
					$active.addClass('active');
					$content.show();

					// Prevent the anchor's default click action
					e.preventDefault();
				});
			});
		});
</script>
<script type="application/javascript">
	var class_id = <?php echo $class->id;?>;
	var cart = $.cookie('cart');
	var dtCart = {
		'id': class_id,
		'jadwal': [<?php echo implode(',',$arr);?>]
	};
	if(!cart) cart = [];
</script>
<script>
	$(document).ready(function()
		{
			$("#slider4").tinycarousel({
				bullets  : true
		});
	});
	
	$(document).ready(function() {
		$(".fancybox").fancybox({
			openEffect	: 'none',
			closeEffect	: 'none'
		});
	});
</script>
<link href="<?php echo base_url();?>assets/css/payment-transfer.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.tinycarousel.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>css/tinycarousel.css" type="text/css" media="screen"/>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/jquery.fancybox.css" media="screen" />
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.fancybox-media.js?v=1.0.6"></script>
	<div class="row bg-all padbottom-30">
		<div class="col-md-8 col-md-offset-2">
			<div class="row">
				<div class="col-md-8">
					<div class="top-head">
						<h2 class="bold text-21"><?php echo $class->class_nama;?></h2>
					</div>
					<div id="main-photo" class="top-30 bg-section shadow"><img class="img-responsive2" src="<?php echo base_url();?>/images/class/<?php echo $class->id?>/<?php echo $class->class_image;?>" /></div>
					<ul class="nav nav-tabs" role="tablist">
						<li id="about_selector" class="active"><a href="#about" role="tab" data-toggle="tab">Tentang Kelas</a></li>
						<li id="biaya_selector"><a href="#price" role="tab" data-toggle="tab">Harga</a></li>
						<li id="jadwal_selector"><a href="#schedule" role="tab" data-toggle="tab">Jadwal</a></li>
					</ul>
					<div class="tab-content bg-section padtop-30 shadow">
						<div class="tab-pane active" id="about">
							<p class="text-14 bold title-class">Penyelenggara</p>
							<a href=""><?php echo $vendor['profile']->name;?></a>
							<p>
								<?php echo nl2br($class->class_deskripsi);?>
							</p>
							<p class="text-14 bold bottom-10 title-class">Target Peserta</p>
							<p>
								<?php echo !empty($class->class_perserta_target)?nl2br($class->class_perserta_target):'';?>
							</p>
							<p class="text-14 bold bottom-10 title-class">Kapasitas</p>
							<p>
								<?php echo $class->class_peserta_max?> orang (kelas terlaksana jika ada minimal <?php echo $class->class_peserta_min;?> murid)
							</p>
							<p class="text-14 bold bottom-10 title-class">Galeri Foto</p>
							<div id="slider4">
								<a class="buttons prev" href="#">&#60;</a>
										<div class="viewport">
											<ul class="overview">
											<?php 
												$i = 0;
												foreach($gallery->result() as $galeri_foto):
												$i++;
											?>
												<li>
													<a href="<?php echo base_url(); ?>images/class/<?php echo $galeri_foto->class_id.'/'.$galeri_foto->galeri_foto; ?>" class="fancybox" rel="gallery1">
														<img src="<?php echo base_url('images/class/'.$galeri_foto->class_id.'/'.$galeri_foto->galeri_foto)?>" width="142px"/>
													</a>
												</li>
											<?php endforeach;?>
											</ul>
										</div>
									<a class="buttons next" href="#">&#62;</a>
							</div>
						</div>
						<div class="tab-pane" id="price">
							<div>
								<p class="bluefont text-14 bold">Harga per sesi</p>
								<p>Rp <?php echo number_format($class->price_per_session, 0, ',', ',')?>,-</p>
								<p class="bluefont text-14 bold bottom-10">Harga per paket</p>
								<?php if(empty($class->discount)):?>
								<p>Rp <?php echo number_format($class->price_per_session*$schedule->num_rows(), 0, ',', ',')?>,-</p>
								<?php else:?>
								<p>Rp <?php echo number_format($class->price_per_session*$schedule->num_rows(), 0, ',', ',')?>,-</p>
								<p class="bluefont text-14 bold bottom-10">Harga setelah discount</p>
								<p>Rp <?php echo number_format($class->price_per_session*$schedule->num_rows()-($class->discount), 0, ',', ',')?>,-</p>
								<?php endif;?>
<?php 
if(!empty($deals)):
?>
								<h3>Special Deals!</h3>
<?php 
	foreach($deals as $deal):
		$discount_time = '';
		if(strpos($deal['main']->start_date, '1971') === FALSE && strpos($deal['main']->expire_date, '2200') === FALSE ) {
			$discount_time = " mulai dari {$deal['main']->start_date} sampai dengan {$deal['main']->expire_date}";
		} elseif(strpos($deal['main']->start_date, '1971') === FALSE && strpos($deal['main']->expire_date, '2200') !== FALSE ) {
			$discount_time = " mulai dari {$deal['main']->start_date}";
		} elseif(strpos($deal['main']->start_date, '1971') !== FALSE && strpos($deal['main']->expire_date, '2200') === FALSE ) {
			$discount_time = " sebelum {$deal['main']->expire_date}";
		}
		$max = (int)$deal['main']->max_amount;
		if($max > 0 || $max != 9999) {
			$discount_amount = "untuk <strong>{$max}</strong> pendaftar pertama ";
		} else {
			$discount_amount = "untuk pendaftar ";
		}
		if($deal['value']->type == 'idr') {
			$discount_value = 'Rp '.number_format($deal['value']->value,0,',','.');
		} else {
			$discount_value = "{$deal['value']->value}%";
		}
		$discount_text = "Khusus {$discount_amount} yang menggunakan kode discount <strong>{$deal['main']->code}</strong>{$discount_time}, akan mendapat potongan sebesar <strong>{$discount_value}</strong>!"
?>
								<?php echo $discount_text; ?><br />
<?php 
	endforeach;
?>
								<p>Segera gunakan kesempatan ini sebelum kehabisan!</p>
<?php 
endif;
?>
							</div>
						</div>
						<div class="tab-pane" id="schedule">
								<table class="white-table">
									<thead>
										<tr>
											<th class="center-top">Sesi</th>
											<th class="center-top">Tanggal</th>
											<th class="center-top">Jam</th>
												<?php if($got_topic): ?>
												<th class="center-top">Topik</th>
												<?php 
												endif;
												if($class->class_paket==0):?>
												<th class="center-top">Daftar <input type="checkbox" id="kurikulum_select_all" data-toggle="tooltip" data-placement="top" title="Pilih semua" /></th>
												<?php endif; ?>
											</tr>
									</thead>
									<tbody>
											<?php
												$i = 0;
												if($schedule->num_rows() > 0):
												//var_dump($jadwal->result());
												foreach($schedule->result() as $kelas_jadwal):
													$i++;
													if($i > 5 && $class->class_paket != 1) break;
													$mulai_jam = $kelas_jadwal->class_jam_mulai<10?('0'.$kelas_jadwal->class_jam_mulai):$kelas_jadwal->class_jam_mulai;
													$mulai_menit = $kelas_jadwal->class_menit_mulai<10?('0'.$kelas_jadwal->class_menit_mulai):$kelas_jadwal->class_menit_mulai;
													$mulai = $mulai_jam.':'.$mulai_menit;
			
													$selesai_jam = $kelas_jadwal->class_jam_selesai<10?('0'.$kelas_jadwal->class_jam_selesai):$kelas_jadwal->class_jam_selesai;
													$selesai_menit = $kelas_jadwal->class_menit_selesai<10?('0'.$kelas_jadwal->class_menit_selesai):$kelas_jadwal->class_menit_selesai;
													$selesai = $selesai_jam.':'.$selesai_menit;
			
											?>
											<tr>
												<td><?php echo $i?></td>
												<td><?php echo date('j M Y', strtotime($kelas_jadwal->class_tanggal)); ?></td>
												<td><?php echo "{$mulai} - {$selesai}"; ?></td>
												<?php if($got_topic): ?>
												<td><?php echo $kelas_jadwal->class_jadwal_topik; ?></td>
												<?php 
												endif;
												if($class->class_paket==0):?>
												<td><input type="checkbox" class="kurikulum_daftar" value="join" name="daftar[<?php echo $kelas_jadwal->jadwal_id;?>]" /></td>
												<?php endif; ?>
											</tr>
											<?php
												endforeach;
												else:
												$cols = 3+($got_topic?1:0)+($class->class_paket==0?1:0);
											?>
											<tr>
												<td colspan="<?php echo $cols;?>">
													<span>Belum ada jadwal tersedia</span>
												</td>
											</tr>
											<?php
												endif;
											?>

									</tbody>
								</table>
						</div>
						&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'payment/transfer/step1'?>" class="btn-reg-class register_class text-18"><img src="<?php echo base_url().'images/daftar.png';?>"/>&nbsp;&nbsp;&nbsp;DAFTAR</a>
					</div>
							<?php 
								$rating = $class->rating->row();
								$rate = $rating->rate;
								$rate = 4;
								$counter = $rating->counter;
							?>
							<div class="jumbotron shadow">
								<div class="rating">
									<span class="bold">Rating
									<?php if($counter > 0){ ?>
									<?php 
									for($i=0;$i<5;$i++):
									?>
										<?php if($i>=$rate){ ?>
											<img src="<?php echo base_url().'images/star.png';?>"/>
										<?php } else { ?>
											<img src="<?php echo base_url().'images/count-star.png';?>"/>
										<?php } ?>
									<?php 
									endfor;
									?>
									dari <span class="pinkfont"><?php echo $counter?></span> pemilih
									</span>
									<?php } else { ?>
										<p class="bottom-10">Mohon maaf rating untuk kelas ini belum ada</p>
									<?php } ?>
								</div>
								<div class="review">
									<span class="bold">Testimonial</span>
									<ul id="review-wrapper">
									<?php if($class->review->num_rows() > 0){ ?>
										<?php foreach($class->review->num_rows() as $student_review):?>
										<li>
											<div class="left-review"><img src="<?php echo base_url().'images/murid/pp/dummy-murid.png';?>" class="frame-murid"/></div>
											<div class="right-review"><span class="title-filter bold"><?php echo $student_review->murid_nama?></span><br/><?php echo nl2br($student_review->review);?></div>
										</li>
										<?php endforeach; ?>
										<?php } else { ?>
											<p>Mohon maaf testimonial untuk kelas ini belum ada</p>
										<?php } ?>
									</ul>
								</div>
							</div>
						<div class="related_class">
							<p class="pinkfont text-14">Kelas lainnya yang sejenis atau terkait</p>
						</div>
				</div>
				<div class="col-md-4">
					<div class="btn-orange2 text-center shadow">
						<span class="btn-orange2 text-18 bold"><img src="<?php echo base_url().'images/pricetag.png'?>"/>&nbsp;&nbsp;&nbsp;Rp <?php echo number_format($class->price_per_session*$schedule->num_rows()-($class->discount), 0, ',', ',')?>,-</span>
					</div>
					<a class="register_class" href="<?php echo base_url().'payment/transfer/step1';?>">
						<div class="btn-orange2 text-center shadow">
							<span class="btn-orange2 text-18 bold"><img src="<?php echo base_url().'images/daftar.png'?>"/>&nbsp;&nbsp;&nbsp;DAFTAR SEKARANG</span>
						</div>
					</a>
					<button class="btn-orange shadow"><img src="<?php echo base_url().'images/wish.png'?>"/>&nbsp;&nbsp;&nbsp;Jadikan <strong class="pinkfont">wishlist</strong></button>
					<div class="pinkpanel">
							<div class="title bold"><img src="<?php echo base_url().'images/session.png'?>"/>&nbsp;&nbsp;&nbsp;Sesi selanjutnya</div>
							<div class="content bg-section shadow">
								lorem ipsum dolor sit amet<br/>
								lorem ipsum dolor sit amet<br/>
								lorem ipsum dolor sit amet<br/>
								lorem ipsum dolor sit amet<br/>
								lorem ipsum dolor sit amet<br/>
								lorem ipsum dolor sit amet<br/>
								lorem ipsum dolor sit amet<br/>
								lorem ipsum dolor sit amet<br/>
							</div>
					</div>
					<div class="pinkpanel">
							<div class="title bold"><img src="<?php echo base_url().'images/location.png'?>"/>&nbsp;&nbsp;&nbsp;Lokasi</div>
							<div class="content bg-section shadow">
<?php 
$maps = explode('||',$class->class_peta);
if(count($maps) == 1) {
	$maps[1] = 'https://www.google.com/maps/place/'.$maps[0];
}
?>
							<p class="text-13"><i class="fa fa-map-marker"></i> <?php echo $class->class_lokasi?></p>
							<a href="<?php echo $maps[1];?>" target="_blank"><img class="img-responsive" src="https://maps.googleapis.com/maps/api/staticmap?size=300x300&maptype=roadmap&markers=color:red%7C<?php echo $maps[0];?>" /></a>
							<a href="<?php echo $maps[1];?>" target="_blank" class="text-13">View on <span style="text-decoration: underline">Google Maps</span></a>
						</div>
					</div>
					<div class="pinkpanel">
						<div class="title bold"><img src="<?php echo base_url().'images/ask.png'?>"/>&nbsp;&nbsp;&nbsp;Butuh Bantuan?</div>
						<div class="content bg-section shadow">
							<p class="text-13">Peroleh informasi dan bantuan terkait kelas dari tim layanan konsumen kami!</p>
							<p class="text-13"><img src="<?php echo base_url().'images/telephone.png';?>"/>&nbsp;&nbsp;021-9200-3040</p>
							<p class="text-13"><img src="<?php echo base_url().'images/comments.png';?>"/>&nbsp;&nbsp;Ngobrol bersama kami!</p>
							<p class="text-13"><img src="<?php echo base_url().'images/email2.png';?>"/>&nbsp;&nbsp;kelas@ruangguru.com</p>
						</div>
					</div>
					<div class="pinkpanel">
						<div class="title bold"><img src="<?php echo base_url().'images/vendor.png'?>"/>&nbsp;&nbsp;&nbsp;Penyelenggara</div>
						<div class="content bg-section shadow">
							<div class="line-title text-center"><img src="<?php echo base_url("images/vendor/{$vendor['profile']->id}/{$vendor['info']->vendor_logo}")?>" class="img-responsive2 top-10" /></div>
							<p class="text-13 bottom-10"><?php echo substr($vendor['info']->vendor_description,0, 100).'... ';?><a href="#" class="pink pull-right bold">More</a></p>
						</div>
					</div>
					<div class="pinkpanel shadow">
						<div class="content bg-section">
							<span class="pinkfont text-16">Tag:</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
	$('.register_class').click(function(e){
		e.preventDefault();
		var avail = false;
		cart.forEach(function(c){
			if(c.id == class_id) avail = true;
		});
		if(!avail)
		cart.push(dtCart);
		$.cookie('cart', cart, {path:'/'});
		window.location.href = base_url+'payment/transfer/step1';
		return false;
	});
</script>
<?php
$this->load->view('vendor/general/footer');