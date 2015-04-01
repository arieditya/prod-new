<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 2/27/15
 * Time: 4:39 PM
 * Proj: prod-new
 */
$this->load->view('vendor/general/header2');
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
//var_dump($class);exit;
?>
	<div class="container content">
		<div class="row">
			<div class="col-md-8">
				<h2 class="entry-title"><?php echo $class->class_nama;?></h2>
				<div class="add-info">
<?php
	if(!empty($class->tag)):
?>
					<span class="info-label text-uppercase">Tag :
<?php
		$tags = explode(',', $class->tag);
		foreach($tags as $tag):
?>
						<a href="#<?php echo $tag;?>"><?php echo $tag;?></a>&nbsp;
<?php
		endforeach;
	endif;
?>
					</span>
				</div><!-- add-info -->
			</div>
			<div class="col-md-8">
				<div class="hero-detail">
					<div class="img-wrap">
<?php 
	$img = 'images/class/'.$class->id.'/'.$class->class_image;
if(!empty($class->class_image) && file_exists(FCPATH.$img)): 
?>
						<img src="<?php echo base_url().$img; ?>"
							 alt="Class Logo" 
							 class="img-responsive" />
<?php else : echo "No Photos"; 
endif; ?>
					</div><!-- img-wrap -->
				</div><!-- hero-detail -->
				<div role="tabpanel">

					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#kelas" aria-controls="kelas" role="tab" data-toggle="tab">Tentang Kelas</a></li>
						<li role="presentation"><a href="#harga" aria-controls="harga" role="tab" data-toggle="tab">Harga</a></li>
						<li role="presentation"><a href="#jadwal" aria-controls="jadwal" role="tab" data-toggle="tab">Jadwal</a></li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="kelas">
							<h3 class="text-20">
								Penyelenggara: <a href="<?php echo base_url()."vendor/detail/{$vendor['profile']->uri}"?>">
									<?php echo $vendor['profile']->name;?>
								</a>
							</h3>
								<p><?php echo $class->class_deskripsi;?></p>
<?php if(!empty($class->class_perserta_target)):?>
							<h5 class="title-class"> 
								<span class="title-label">Target Peserta :</span><br /><br />
								<span class="content"><?php echo $class->class_perserta_target?></span>
							</h5>
<?php endif;?>
							<?php if($class->available == 1): ?>
								<h5 class="title-class">
									<span class="title-label">Kapasitas :</span><br /><br />
									<span class="content">
										<?php echo $class->class_peserta_max?> orang
									</span>
								</h5>
							<?php endif; ?>
						</div><!-- #kelas -->
						<div role="tabpanel" class="tab-pane" id="harga">
<?php
if($class->class_paket<2):
?>
							<h5 class="title-label">Harga per sesi</h5>
							<p> <?php echo rupiah_format($class->price_per_session)?></p>
<?php 
endif;
if ($class->class_paket > 0):?>
							<h5 class="title-label">Harga paket</h5>
<?php 
	if(!empty($class->discount)):?>
							<p> <?php echo rupiah_format($class->price_per_session*$schedule->num_rows())?></p>
<?php 
	else: 
?>
							<p>
<?php
		$ori_price = $class->price_per_session*$schedule->num_rows();
		$disc_price = $ori_price - $class->discount;
		if($disc_price == $ori_price):
?>
								<?php echo rupiah_format($disc_price);?>
<?php
		else:
?>
								<span class="strike"><?php echo rupiah_format($ori_price);?></span>
								<?php echo rupiah_format($disc_price);?>
<?php
		endif;
?>
							</p>
<?php 
	endif;
endif;
?>
										
							<h5 class="title-label">Harga sudah termasuk</h5>
							<p><?php echo nl2br($class->class_include);?></p>
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
			$discount_time = " sebelum {$deal['main']->expire_date}";
		} elseif(strpos($deal['main']->start_date, '1971') !== FALSE && strpos($deal['main']->expire_date, '2200') === FALSE ) {
			$discount_time = " mulai dari {$deal['main']->start_date}";
		}
		$max = (int)$deal['main']->max_amount;
		if($max > 0 || $max != 9999) {
			$discount_amount = "untuk <strong>{$max}</strong> pendaftar pertama ";
		} else {
			$discount_amount = "untuk pendaftar ";
		}
		if($deal['value']->type == 'idr') {
			$discount_value = rupiah_format($deal['value']->value);
		} else {
			$discount_value = "{$deal['value']->value}%";
		}
		$discount_text = "Khusus {$discount_amount} yang menggunakan kode discount "
				."<strong>{$deal['main']->code}</strong>{$discount_time}, "
				."akan mendapat potongan sebesar <strong>{$discount_value}</strong>!";
?>
							<p><?php echo $discount_text; ?></p>
<?php 
	endforeach;
?>
							<h4>Segera gunakan kesempatan ini sebelum kehabisan!</h4>
<?php 
endif;
?>
						</div><!-- #harga -->
						<div role="tabpanel" class="tab-pane" id="jadwal">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<td>Sesi</td>
											<td>Tanggal</td>
											<td>Jam</td>
<?php
	if($got_topic):
?>
											<td>Topik</td>
<?php 
	endif;
	if($class->class_paket==1):
?>
											<td>Daftar</td>
<?php 
			endif; 
?>
										</tr>
									</thead>
									<tbody>
<?php
	if($schedule->num_rows() > 0):
	//var_dump($jadwal->result());
		$i=0;
		foreach($schedule->result() as $kelas_jadwal):
			$i++;
//			if($i > 5 && $class->class_paket != 1) break;
			$mulai_jam = double_digit($kelas_jadwal->class_jam_mulai);
			$mulai_menit = double_digit($kelas_jadwal->class_menit_mulai);
			$mulai = $mulai_jam.':'.$mulai_menit;
	
			$selesai_jam = double_digit($kelas_jadwal->class_jam_selesai);
			$selesai_menit = double_digit($kelas_jadwal->class_menit_selesai);
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
			if($class->class_paket==1):?>
												<td><input type="checkbox" class="kurikulum_daftar" value="join" name="daftar[<?php echo $kelas_jadwal->jadwal_id;?>]" /></td>
<?php 
			endif; 
?>
											</tr>
<?php
		endforeach;
	else:
		$cols = 3+($got_topic?1:0)+($class->class_paket==1?1:0);
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
							</div><!-- table-responsive -->
						</div><!-- #jadwal -->
						<?php if($class->available == 1): ?>
							<a href="#"
							   class="main-button register text-center register_class"
									><i class="fa fa-user"></i> Daftar Sekarang</a>
						<?php else: ?>
							<div
							   class="main-button register text-center register_class"
								><i class="fa fa-lock"></i> SOLD OUT</div>
						<?php endif; ?>
					</div><!-- tab-content -->
				</div><!-- tabpanel -->
				<div class="review-wrap">
					<div class="rating-wrap review-item">
						<h4 class="review-title">Rating</h4>
<?php 
	$rating = $class->rating->row();
	$rate = $rating->rate;
//	$rate = 4;
	$counter = $rating->counter;
	if(!empty($counter)):
?>
						<span class="rate"><?php echo "{$rate} dari {$counter} ";?></span>
						<div class="rating pull-left">
<?php 
//	$rate = 4;
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
						</div><!-- rating -->
<?php
	else:
?>
							<p>Belum memiliki rating</p>
<?php
	endif;
?>
					</div><!-- rating-wrap -->
					<div class="testimonial-wrap review-item">
						<h4 class="review-title">Testimonial</h4>
<?php
	if($class->review->num_rows() > 0):
		foreach($class->review->result() as $review):
?>
						<div class="testimonial-item">
							<div class="icon-wrap">
								<img src="/assets/images/user.png" alt="" class="img-responsive">
							</div>
							<p><?php echo $review->review;?></p>
							<h5 class="username"><?php echo $review->murid_nama; ?></h5>
						</div>
<?php
		endforeach;
	else:
?>
						<div class="testimonial-item">
							<p>Belum memiliki testimonial</p>
						</div>
<?php
	endif;
?>
					</div><!-- testimonial-wrap -->
				</div><!-- review-wrap -->    

			</div><!-- col-md-8 -->
			<div class="col-md-4">
				<div class="price-big-wrap detail-label label-yellow text-center">
					<i class="fa fa-tag"></i>
					<h3 class="entry-detail-label text-center text-20">
						<?php
                        $price=$class->price_per_session*$schedule->num_rows();
                        if($price==0) {
                            echo "GRATIS";
                        }
                        else {
                            echo rupiah_format($class->price_per_session*$schedule->num_rows());
                        }
                        ?>
					</h3>
				</div><!-- detail-label -->
				<?php if($class->available == 1): ?>
					<a href="#" class="register_class">
						<div class="detail-label label-yellow text-center">
							<i class="fa fa-user"></i>
							<h3 class="entry-detail-label text-20">Daftar Sekarang</h3>
						</div><!-- detail-label -->
					</a>
				<?php else: ?>
					<div class="register_class">
						<div class="detail-label label-yellow text-center">
							<i class="fa fa-lock"></i>
							<h3 class="entry-detail-label text-20">SOLD OUT</h3>
						</div><!-- detail-label -->
					</div>
				<?php endif; ?>

<?php 
	if(!empty($next_session)):
?>
				<div class="panel panel-default">
					<div class="panel-heading heading-label text-center"><i class="fa fa-calendar-o"></i> Sesi Selanjutnya</div>
					<div class="panel-body">
						Sesi Selanjutnya <br>
						Sesi Selanjutnya <br>
						Sesi Selanjutnya <br>
						Sesi Selanjutnya <br>
					</div>
				</div><!-- panel -->
<?php 
	endif;
?>
				<div class="panel panel-default">
<?php
	if(empty($class->class_peta)) {
		if(!empty($class->class_lokasi)) {
			$str_lokasi = preg_replace('/[\s\r\n]/','+',$class->class_lokasi);
			$str_lokasi = str_replace('++','+', $str_lokasi);
		} else {
			$str_lokasi = 'monumen+nasional';
		}
		$ll = $str_lokasi;
		$link = 'https://www.google.com/maps/place/'.$str_lokasi;
	} else {
		$peta = explode('||', $class->class_peta);
		$ll = $peta[0];
		if(count($peta) == 2) {
			$link = $peta[1];
		} else {
			$link = 'https://www.google.com/maps/place/'.$peta[0];
		}
	}
?>
					<div class="panel-heading heading-label text-center ">
						<i class="fa fa-map-marker"></i> 
						<span class="entry-detail-label text-20">Lokasi</span>
					</div>
					<div class="panel-body">
						<p><i class="fa fa-map-marker"></i>  <?php echo nl2br($class->class_lokasi)?></p> 
						<a href="<?php echo $link;?>" target="_blank">
							<img class="img-responsive" 
								 src="https://maps.googleapis.com/maps/api/staticmap?size=400x400&maptype=roadmap&markers=color:red%7C<?php echo $ll;?>"/>
						</a>
						<a href="<?php echo $link;?>" 
						   target="_blank" 
						   class="text-right">View on <span style="text-decoration: underline">Google Maps</span>
						</a>

					</div>
				</div><!-- panel -->
				<div class="panel panel-default">
					<div class="panel-heading heading-label text-center"><i class="fa fa-question-circle"></i> Butuh Bantuan ?</div>
					<div class="panel-body">
						<p>Peroleh informasi dan bantuan terkait kelas dari tim layanan konsumen kami! </p>
						<h5 class="support">
							<a href="tel:+622192003040">
								<i class="fa fa-phone-square"></i>021-9200-3040
							</a>
						</h5>
						<h5 class="support">
							<a href="mailto:kelas@ruangguru.com">
								<i class="fa fa-envelope"></i>kelas@ruangguru.com
							</a>
						</h5>
					</div>
				</div><!-- panel -->
				<div class="panel panel-default">
					<div class="panel-heading heading-label text-center"><i class="fa fa-male"></i> Penyelenggara</div>
					<div class="panel-body">
						<img src="<?php echo base_url("images/vendor/{$vendor['profile']->id}/{$vendor['info']->vendor_logo}")?>" class="img-responsive logo-vendor" alt="">
						<p><?php echo substr($vendor['info']->vendor_description,0, 200).'... ';?> </p>
						<a href="<?php echo base_url()."vendor/detail/{$vendor['profile']->uri}"?>" class="more text-right">More..</a>
					</div>
				</div><!-- panel -->
			</div><!-- col-md-4 -->
		</div><!-- row -->
	</div> <!-- /container -->
<script type="application/javascript">
	var class_id = <?php echo $class->id;?>;
	var cart = $.cookie('cart');
	var dtCart = {
		'id': class_id,
		'jadwal': [<?php echo implode(',',$arr);?>]
	};
	if(!cart) cart = [];
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
$this->load->view('vendor/general/footer2');
