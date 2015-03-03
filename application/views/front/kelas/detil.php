<?php
$this->load->view('vendor/general/header');
$got_topic = FALSE;
foreach($schedule->result() as $jdwl):
	if(!empty($jdwl->class_jadwal_topik)){
		$got_topic = TRUE;
		break;
	}
endforeach;
?>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.tinycarousel.js"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>css/tinycarousel.css" type="text/css" media="screen"/>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/jquery.fancybox.css" media="screen" />
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.fancybox-media.js?v=1.0.6"></script>
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

	<div class="main_content">
		<div class="row">
			<div class="col-md-offset-1 col-md-7">
				<div class="row">
					<div class="col-md-12 bottom-20">
						<div class="bg-title-class text-center white-text"><h2><?php echo $class->class_nama;?></h2></div>
						<div id="main-photo">
							<?php if(!empty($class->class_image)){ ?><img src="<?php echo base_url().'images/class/'.$class->id.'/'.$class->class_image; ?>"/><?php } else { echo "No Photos"; } ?>
						</div>
						<ul class="nav nav-tabs" role="tablist">
							<li id="about_selector" class="active"><a href="#about" role="tab" data-toggle="tab">Tentang Kelas</a></li>
							<li id="biaya_selector"><a href="#price" role="tab" data-toggle="tab">Biaya</a></li>
							<li id="jadwal_selector"><a href="#schedule" role="tab" data-toggle="tab">Jadwal</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="about">
								<p><?php echo nl2br($class->class_deskripsi);?></p>
<?php if($class->class_paket == 1): ?>
								<p>Ini adalah kelas paket! Dengan jumlah pertemuan: <?php echo $schedule->num_rows();?> kali</p>
<?php endif; ?>
								
								<p class="title-filter text-16 bold">Galeri</p>
								<div id="slider4">
									<a class="buttons prev" href="#">&#60;</a>
<?php 
	if($gallery->num_rows() > 0): 
?>
										<div class="viewport">
											<ul class="overview">
<?php
		$igal = 0;
		foreach($gallery->result() as $gal):
			$foto = explode('.', $gal->galeri_foto);
			$ext = array_pop($foto);
			$foto[] = '142x113';
			$foto[] = $ext;
			$photo = implode('.', $foto);
?>
												<li>
													<a href="<?php echo base_url(); ?>images/class/<?php echo $class->id.'/'.$photo; ?>" class="fancybox" rel="gallery1">
														<img src="<?php echo base_url(); ?>images/class/<?php echo $class->id.'/'.$photo; ?>"/>
													</a>
												</li>
<?php 
			$igal++; 
?>
<?php 
		endforeach;
?>
											</ul>
										</div>
<?php 
	endif; 
?>
									<a class="buttons next" href="#">&#62;</a>
								</div>
							</div>
							<div class="tab-pane" id="price">
								<div class="blue-bar">
									Harga
								</div>
								<div>
									<h4>Harga sudah termasuk:</h4>
									<p><?php echo nl2br($class->class_include);?></p>
								</div>
								<div class="blue-bar">
									Kurikulum
								</div>
							</div>
							<div class="tab-pane" id="schedule">
								<div class="" id="kurikulum_div">
									<table class="table table-bordered table-hover table-condensed table-striped">
										<thead>
											<tr>
												<th class="center-top">Sesi</th>
												<th class="center-top">Tanggal</th>
												<th class="center-top">Jam</th>
<?php 
	if($got_topic): 
?>
												<th class="center-top">Topik</th>
<?php 
	endif;
	if($class->class_paket==0):
?>
												<th class="center-top">
													Daftar<br />
													<input type="checkbox" 
														   id="kurikulum_select_all" 
														   data-toggle="tooltip" 
														   data-placement="top" 
														   title="Pilih semua" />
												</th>
<?php 
	endif; 
?>
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
												<td><?php echo date('j F Y', strtotime($kelas_jadwal->class_tanggal)); ?></td>
												<td><?php echo "{$mulai} - {$selesai}"; ?></td>
<?php 
			if($got_topic): 
?>
												<td><?php echo $kelas_jadwal->class_jadwal_topik; ?></td>
<?php 
			endif;
			if($class->class_paket==0):?>
												<td><input type="checkbox" class="kurikulum_daftar" value="join" name="daftar[<?php echo $kelas_jadwal->jadwal_id;?>]" /></td>
<?php 
			endif; 
?>
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
							</div>
							<a href="#" class="btn-reg-class text-18">
								<span class="bold">DAFTAR </span>KELAS SEKARANG!
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<hr />
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div id="rating-wrap">
								<div class="rating-kelas">
									<span class="title-filter bold">Rating</span>
									<span>
										<img src="<?php echo base_url().'images/star.png';?>"/>
										<img src="<?php echo base_url().'images/star.png';?>"/>
										<img src="<?php echo base_url().'images/star.png';?>"/>
										<img src="<?php echo base_url().'images/star.png';?>"/>
										<img src="<?php echo base_url().'images/empty-star.png';?>"/>
									</span>
									<span>dari </span><span class="title-filter">10</span><span> pemilih</span>
<?php 
	$rate = 4;
	for($i=0;$i<5;$i++):
		if($i < $rate):
?>
										<i class="fa fa-star"></i>
<?php 
		else: 
?>
										<i class="fa fa-star-o"></i>
<?php 
		endif;
	endfor;
?>
								</div>
								<div class="rating-kelas">
									<span class="title-filter bold">Testimonial</span>
									<ul id="review-wrapper">
										<li>
											<div class="left-review"><img src="<?php echo base_url().'images/dummy-murid.png';?>" class="frame-murid"/></div>
											<div class="right-review"><span class="title-filter bold">Reza</span><br/>Kelasnya bagus banget! Saya belajar banyak mengenai tips dan trik bikin toko online. Sekarang toko saya ramai dikunjungi pelanggan. Terima kasih.</div>
										</li>
										<li>
											<div class="left-review"><img src="<?php echo base_url().'images/dummy-murid.png';?>" class="frame-murid"/></div>
											<div class="right-review"><span class="title-filter bold">Reza</span><br/>Kelasnya bagus banget! Saya belajar banyak mengenai tips dan trik bikin toko online. Sekarang toko saya ramai dikunjungi pelanggan. Terima kasih.</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 right-belly bottom-20">
				<div class="panel panel-default class-price">
					<div class="panel-title disc-title">Discount</div>
					<div class="panel-body price-title">
						<span class="white-text">Harga </span><?php echo empty($class->class_harga)?'GRATIS!':('Rp. '. number_format($class->class_paket==1?(((int)$class->class_harga)*$i):(((int)$class->class_harga)),2,',','.') . ($class->class_paket==1?' per paket':' per sesi')); ?>
					</div>
				</div>
				<div class="panel panel-default reg-class-2">
					<div class="panel-title"><a href="#"><span class="text-18 bold">DAFTAR</span><br/>KELAS SEKARANG</a></div>
				</div>
				<div class="panel panel-default pink-border">
					<div class="panel-title pink-box text-18 white-text">Ada pertanyaan?</div>
					<div class="panel-body">
						Peroleh informasi dan bantuan terkait kelas dari tim layanan konsumen kami!
						<ul id="class-support">
							<li><img src="<?php echo base_url().'images/telephone.png';?>"/>&nbsp;&nbsp;021-9200-3040</li>
							<li><img src="<?php echo base_url().'images/comments.png';?>"/>&nbsp;&nbsp;Ngobrol bersama kami!</li>
							<li><img src="<?php echo base_url().'images/email2.png';?>"/>&nbsp;&nbsp;kelas@ruangguru.com</li>
						</ul>
					</div>
				</div>
				<div class="panel panel-default reg-class-3">
					<div class="panel-title text-16 bold"><a href="#"><img src="<?php echo base_url().'images/heart.png'?>"/>&nbsp;&nbsp;Jadikan <span class="title-filter">wishlist</span></a></div>
				</div>
				<div class="panel panel-default pink-border">
					<div class="panel-title pink-box text-18 white-text">Lokasi</div>
					<div class="panel-body">
						<?php 
							$maps = explode('||',$class->class_peta);
							if(count($maps) == 1) {
								$maps[1] = 'https://www.google.com/maps/place/'.$maps[0];
							}
						?>
							<img src="https://maps.googleapis.com/maps/api/staticmap?size=230x250&maptype=roadmap&markers=color:red%7C<?php echo $maps[0];?>" />
							<a href="<?php echo $maps[1];?>" target="_blank">View on Google Maps</a>
					</div>
				</div>
<?php
	if($schedule->num_rows() > 5 && $class->class_paket != 1):
?>
					<div class="panel panel-default">
						<div class="panel-title">Sesi yang akan datang</div>
						<div class="panel-body">
							<ul>
<?php
		$i = 0;
		foreach($schedule->result() as $sched):
			$i++;
			if($i <= 5) continue;
			$waktu_jam = $sched->class_jam_mulai<10?('0'.$sched->class_jam_mulai):$sched->class_jam_mulai;
			$waktu_menit = $sched->class_menit_mulai<10?('0'.$sched->class_menit_mulai):$sched->class_menit_mulai;
			$waktu = $waktu_jam.':'.$waktu_menit;
?>
										<li>
											<?php echo date('j F, Y \J\a\m\: H:i', strtotime($sched->class_tanggal.' '.$waktu)); ?> 
										</li>
<?php
		endforeach;
?>
							</ul>
						</div>
					</div>
<?php
	endif;
?>
					<div class="panel panel-default pink-border">
						<div class="panel-title pink-box text-18 white-text">Sesi selanjutnya</div>
						<div class="panel-body">
							<ul id="class-session">
								<li class="text-13"><span class="title-filter">13</span> Nov | Sesi 2: Berjualan Praktis</li>
								<li class="text-13"><span class="title-filter">15</span> Nov | Sesi 3: Simple SEO</li>
								<li class="text-13"><span class="title-filter">17</span> Nov | Sesi 4: Digital Activation</li>
							</ul>
						</div>
					</div>
					<div class="panel panel-default pink-border">
						<div class="panel-title pink-box text-18 white-text">Penyelenggara</div>
						<div class="panel-body">
							<div class="line-title text-center"><img src="<?php echo base_url().'images/sirclo.png';?>" alt="no-image"/></div>
							<p>SIRCLO adalah sebuah perusahaan teknologi yang menyediakan platform untuk pembuatan e-commerce, SIRCLO memiliki visi untuk membantu para wirausahawan yang ...</p>
						</div>
					</div>
					<div class="panel panel-default pink-border">
						<div class="panel-body">
							<span class="title-filter bold">Tags:</span>
							<p>tag1, tag2, tag3</p>
						</div>
					</div>
			</div>
		</div>	
	</div>

<script>
	$(document).ready(function(){
		$('#sbmt_clss').click(function(e){
			e.preventDefault();
			console.log($('input[type=checkbox]'));
			return false;
		});
		$('#kurikulum_select_all').change(function(){
			var $selected = $(this).is(':checked');
			console.log($selected?'SELECTED':'NOT SELECTED');
			if($selected) {
				$('.kurikulum_daftar').attr('checked', 'checked');
			} else {
				$('.kurikulum_daftar').removeAttr('checked');
			}
		});
		$('.disabled').click(function(e){
			e.preventDefault();
			return false;
		});
	});
</script>
<?php
$this->load->view('vendor/general/footer');