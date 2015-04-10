<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 10/14/14
 * Time: 7:52 AM
 * Proj: private-development
 */
$this->load->view('vendor/general/header2');
$logo = base_url().(empty($vendor_info->vendor_logo)
				?'assets/images/user.png'
				:('images/vendor/'.$vendor_data->id.'/'.$vendor_info->vendor_logo));
?>
	<div class="container content vendor-detail">
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading heading-label"><?php echo $vendor_data->name; ?></div>
					<div class="panel-body">
						<div class="col-md-4 img-profile">
							<img src="<?php echo $logo?>" alt="Vendor Logo" class="img-responsive">
						</div>
						<div class="col-md-8 profile-desc">
							<?php echo nl2br($vendor_info->vendor_description); ?>
						</div>
					</div>
				</div><!-- hero-detail -->
				<div class="review-wrap">
					<div class="rating-wrap review-item">
						<h4 class="review-title">Rating</h4>
<?php if(FALSE): ?>
						<div class="rating pull-left">
							<span class="rating-info"> <i class="fa fa-star"></i><b>4.5</b> dari <b>10</b> review</span>
						</div>
<?php
	else:
?>
						<div class="testimonial-item">
							Belum ada rating
						</div>
<?php
	endif;
?>
					</div><!-- rating-wrap -->
					<div class="testimonial-wrap review-item">
						<h4 class="review-title">Testimonial</h4>
<?php if(FALSE): ?>
						<div class="testimonial-item">
							<div class="icon-wrap">
								<img src="assets/images/user.png" alt="" class="img-responsive">
							</div>
							<h5 class="username"><strong>Badrudin Al Fakher</strong> | Mengikuti kelas Parkour</h5>
							<p>Kelasnya bagus banget! Saya belajar banyak mengenai tips dan trik bikin toko online. Sekarang toko saya jadi ramai dikunjungi pelanggan. Terima kasih!</p>
						</div>
						<div class="testimonial-item">
							<div class="icon-wrap">
								<img src="assets/images/user.png" alt="" class="img-responsive">
							</div>
							<h5 class="username"><strong>Badrudin Al Fakher</strong> | Mengikuti kelas Parkour</h5>
							<p>Kelasnya bagus banget! Saya belajar banyak mengenai tips dan trik bikin toko online. Sekarang toko saya jadi ramai dikunjungi pelanggan. Terima kasih!</p>
						</div>
						<ul class="pagination pull-right">
							<li>
								<a href="#" aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
								</a>
							</li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li>
								<a href="#" aria-label="Next">
									<span aria-hidden="true">&raquo;</span>
								</a>
							</li>
						</ul>
<?php
	else:
?>
						<div class="testimonial-item">
							Belum ada testimonial
						</div>
<?php
	endif;
?>
					</div><!-- testimonial-wrap -->
				</div><!-- review-wrap -->    
			</div><!-- col-md-8 -->
			<div class="col-md-4">
<?php if(FALSE): ?>
				<div class="panel panel-default">
					<div class="panel-heading heading-label text-center"><i class="fa fa-camera"></i> Foto</div>
					<div class="panel-body">
						<div class="thumb-wrap">
							<ul>
								<li><img src="assets/images/obama.jpg" class="img-responsive"></li>
								<li><img src="assets/images/obama.jpg" class="img-responsive"></li>
								<li><img src="assets/images/obama.jpg" class="img-responsive"></li>
								<li><img src="assets/images/obama.jpg" class="img-responsive"></li>
							</ul>
						</div>
						<div class="preview">
							<img src="assets/images/obama.jpg" class="img-responsive">
						</div>
					</div>
				</div><!-- panel -->
<?php
	endif;
?>
				<div class="panel panel-default">
					<div class="panel-heading heading-label text-center"><i class="fa fa-map-marker"></i> Kontak</div>
					<div class="panel-body">
<?php if($vendor_data->show_address==1 && !empty($vendor_data->address)): ?>
						<p>
							<i class="fa fa-map-marker"></i>&nbsp;<?php echo nl2br($vendor_data->address);?>
						</p> 
<?php
	endif;
	if($vendor_data->show_phone==1 && !empty($vendor_data->main_phone)):
		$phone = preg_replace('/[^0-9]/','',$vendor_data->main_phone);
?>
						<h5 class="support">
							<a href="tel:<?php echo $phone;?>">
								<i class="fa fa-phone-square"></i><?php echo $vendor_data->main_phone;?></a>
						</h5>
<?php
	endif;
	if($vendor_data->show_email==1 && !empty($vendor_data->email)):
?>
						<h5 class="support">
							<a href="mailto:<?php echo $vendor_data->email;?>">
								<i class="fa fa-envelope"></i>&nbsp<?php echo $vendor_data->email;?>
							</a>
						</h5>
<?php
	endif;
?>
<?php if(!empty($vendor_socmed->facebook)): ?>
						<h5 class="support">
							<a target="_blank"
							   rel="nofollow"
							   href="http://fb.me/<?php echo $vendor_socmed->facebook;?>">
								<i class="fa fa-facebook"></i>&nbsp<?php echo $vendor_socmed->facebook;?>
							</a>
						</h5>
<?php endif; 
if(!empty($vendor_socmed->twitter)):
?>
						<h5 class="support">
							<a target="_blank"
							   rel="nofollow"
							   href="http://twitter.com/<?php echo $vendor_socmed->twitter;?>">
								<i class="fa fa-twitter"></i>&nbsp<?php echo $vendor_socmed->twitter;?>
							</a>
						</h5>
<?php endif; 
if(!empty($vendor_socmed->instagram)):
?>
						<h5 class="support">
							<a target="_blank"
							   rel="nofollow"
							   href="https://instagram/<?php echo $vendor_socmed->instagram;?>">
								<i class="fa fa-instagram"></i>&nbsp@<?php echo $vendor_socmed->instagram;?>
							</a>
						</h5>
<?php endif; 
if(!empty($vendor_socmed->pinterest)):
?>
						<h5 class="support">
							<a target="_blank"
							   rel="nofollow"
							   href="https://www.pinterest.com/<?php echo $vendor_socmed->pinterest;?>">
								<i class="fa fa-pinterest"></i>&nbsp<?php echo $vendor_socmed->pinterest;?>
							</a>
						</h5>
<?php endif; 
?>
					</div>
				</div><!-- panel -->
				<div class="panel panel-default">
					<div class="panel-heading heading-label text-center"><i class="fa fa-question-circle"></i> Pertanyaan</div>
					<div class="panel-body">
						<p>Peroleh informasi dan bantuan terkait kelas dari tim layanan konsumen kami! </p>
						<h5 class="support">
							<a href="tel:+622192003040"><i class="fa fa-phone-square"></i>021-9200-3040</a>
						</h5>
						<h5 class="support">
							<a href="mailto:kelas@ruangguru.com?Subject=Vendor%20Landing%20<?php echo 
							rawurlencode($vendor_data->name)?>">
								<i class="fa fa-envelope"></i>
								kelas@ruangguru.com
							</a>
						</h5>
					</div>
				</div><!-- panel -->
				<div class="panel-kelas">
<?php
	if(!empty($list_classes)):
	foreach($list_classes as $kelas):
		$imgparts = explode('.',$kelas->class_image);
		$ext = array_pop($imgparts);
		array_push($imgparts, $ext);
		$img = empty($kelas->class_image)?'images/default_profile_image.png':('images/class/'.$kelas->id.'/'
			.implode('.', $imgparts));
		$price = (int)$kelas->price_per_session;
		$disc = (int)$kelas->discount;
		if($kelas->class_paket == 2) {
			$_price = rupiah_format($price * $kelas->count_session).' /paket';
		} else {
			$_price = rupiah_format($price).' /sesi';
		}
		if($price==0) {
			$_price = "GRATIS";
		}
?>
					<div class="content-grid <?php if($disc>0){ echo 'diskon';} ?>">
						<a href="<?php echo base_url().'kelas/'.$kelas->class_uri?>">
							<div class="grid-top" style="background-image: url('<?php echo base_url().$img;?>');">
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
<?php
	endforeach;
?>
					<a href="<?php echo base_url().'vendor/detail/'.$vendor_data->uri.'/kelas'?>" class="btn btn-orange btn-right">
						Kelas lain &nbsp;
						<i class="fa fa-forward"></i>
					</a>
<?php
	endif;
?>
				</div><!-- panel-kelas -->
			</div><!-- col-md-4 -->
<?php /* ?>
			<div class="col-sm-12">
				<div class="related-wrap">
					<h2 class="block-title text-uppercase">Kelas yang diadakan <?php echo $vendor_data->name;?></h2>
					<div class="row">
						<div class="col-md-4 col-sm-6">
							<div class="content-grid diskon">
								<a href="#">
									<div class="grid-top" style="background-image: url('assets/images/main_picture.jpg');">
										<div class="grid-title-wrap">
											<h3 class="grid-title">Training CodeIgniter: Breaking The Frame[works]</h3>
										</div><!-- grid-title-wrap -->
										<div class="diskon-label">
											<h3>ADA</h3>
											<h5>DISKON</h5>
										</div>
									</div><!-- grid-top -->  
								</a>
								<div class="grid-bottom">
									<span class="price">Rp 75,000,- /sesi</span>
									<a href="#"><span class="details">Daftar</span></a>
									<div class="description">
										<div class="icon"><i class="fa fa-calendar-o"></i></div>
										<span class="date"> 08 Mar 2015 | 17.00 - 19.00 WIB <br> dan <a href="#">5 sesi lainnya</a> | Jakarta Selatan</span>
									</div><!-- description -->
									<div class="review">
										<div class="icon"><i class="fa fa-shopping-cart"></i></div>
										<span class="tag">kelas ruangguru</span>
										<div class="rating">
											<span class="rating-info"> <i class="fa fa-star"></i><b>4.5</b> dari <b>10</b> review</span>
										</div>
									</div>
								</div><!-- grid-bottom -->
							</div> <!-- content-grid -->
						</div><!-- col-md-4 col-sm-6 -->
						<div class="col-md-4 col-sm-6">
							<div class="content-grid">
								<a href="#">
									<div class="grid-top" style="background-image: url('assets/images/main_picture.jpg');">
										<div class="grid-title-wrap">
											<h3 class="grid-title">Training CodeIgniter: Breaking The Frame[works]</h3>
										</div><!-- grid-title-wrap -->
									</div><!-- grid-top -->  
								</a>
								<div class="grid-bottom">
									<span class="price">Rp 75,000,- /sesi</span>
									<a href="#"><span class="details">Daftar</span></a>
									<div class="description">
										<div class="icon"><i class="fa fa-calendar-o"></i></div>
										<span class="date"> 08 Mar 2015 | 17.00 - 19.00 WIB <br> dan <a href="#">5 sesi lainnya</a> | Jakarta Selatan</span>
									</div><!-- description -->
									<div class="review">
										<div class="icon"><i class="fa fa-shopping-cart"></i></div>
										<span class="tag">kelas ruangguru</span>
										<div class="rating">
											<span class="rating-info"> <i class="fa fa-star"></i><b>4.5</b> dari <b>10</b> review</span>
										</div>
									</div>
								</div><!-- grid-bottom -->
							</div> <!-- content-grid -->
						</div><!-- col-md-4 col-sm-6 -->
						<div class="col-md-4 col-sm-6">
							<div class="content-grid">
								<a href="#">
									<div class="grid-top" style="background-image: url('assets/images/main_picture.jpg');">
										<div class="grid-title-wrap">
											<h3 class="grid-title">Training CodeIgniter: Breaking The Frame[works]</h3>
										</div><!-- grid-title-wrap -->
									</div><!-- grid-top -->  
								</a>
								<div class="grid-bottom">
									<span class="price">Rp 75,000,- /sesi</span>
									<a href="#"><span class="details">Daftar</span></a>
									<div class="description">
										<div class="icon"><i class="fa fa-calendar-o"></i></div>
										<span class="date"> 08 Mar 2015 | 17.00 - 19.00 WIB <br> dan <a href="#">5 sesi lainnya</a> | Jakarta Selatan</span>
									</div><!-- description -->
									<div class="review">
										<div class="icon"><i class="fa fa-shopping-cart"></i></div>
										<span class="tag">kelas ruangguru</span>
										<div class="rating">
											<span class="rating-info"> <i class="fa fa-star"></i><b>4.5</b> dari <b>10</b> review</span>
										</div>
									</div>
								</div><!-- grid-bottom -->
							</div> <!-- content-grid -->
						</div><!-- col-md-4 col-sm-6 -->
						<div class="col-md-4 col-sm-6">
							<div class="content-grid diskon">
								<a href="#">
									<div class="grid-top" style="background-image: url('assets/images/main_picture.jpg');">
										<div class="grid-title-wrap">
											<h3 class="grid-title">Training CodeIgniter: Breaking The Frame[works]</h3>
										</div><!-- grid-title-wrap -->
										<div class="diskon-label">
											<h3>ADA</h3>
											<h5>DISKON</h5>
										</div>
									</div><!-- grid-top -->  
								</a>
								<div class="grid-bottom">
									<span class="price">Rp 75,000,- /sesi</span>
									<a href="#"><span class="details">Daftar</span></a>
									<div class="description">
										<div class="icon"><i class="fa fa-calendar-o"></i></div>
										<span class="date"> 08 Mar 2015 | 17.00 - 19.00 WIB <br> dan <a href="#">5 sesi lainnya</a> | Jakarta Selatan</span>
									</div><!-- description -->
									<div class="review">
										<div class="icon"><i class="fa fa-shopping-cart"></i></div>
										<span class="tag">kelas ruangguru</span>
										<div class="rating">
											<span class="rating-info"> <i class="fa fa-star"></i><b>4.5</b> dari <b>10</b> review</span>
										</div>
									</div>
								</div><!-- grid-bottom -->
							</div> <!-- content-grid -->
						</div><!-- col-md-4 col-sm-6 -->
						<div class="col-md-4 col-sm-6">
							<div class="content-grid">
								<a href="#">
									<div class="grid-top" style="background-image: url('assets/images/main_picture.jpg');">
										<div class="grid-title-wrap">
											<h3 class="grid-title">Training CodeIgniter: Breaking The Frame[works]</h3>
										</div><!-- grid-title-wrap -->
									</div><!-- grid-top -->  
								</a>
								<div class="grid-bottom">
									<span class="price">Rp 75,000,- /sesi</span>
									<a href="#"><span class="details">Daftar</span></a>
									<div class="description">
										<div class="icon"><i class="fa fa-calendar-o"></i></div>
										<span class="date"> 08 Mar 2015 | 17.00 - 19.00 WIB <br> dan <a href="#">5 sesi lainnya</a> | Jakarta Selatan</span>
									</div><!-- description -->
									<div class="review">
										<div class="icon"><i class="fa fa-shopping-cart"></i></div>
										<span class="tag">kelas ruangguru</span>
										<div class="rating">
											<span class="rating-info"> <i class="fa fa-star"></i><b>4.5</b> dari <b>10</b> review</span>
										</div>
									</div>
								</div><!-- grid-bottom -->
							</div> <!-- content-grid -->
						</div><!-- col-md-4 col-sm-6 -->
						<div class="col-md-4 col-sm-6">
							<div class="content-grid">
								<a href="#">
									<div class="grid-top" style="background-image: url('assets/images/main_picture.jpg');">
										<div class="grid-title-wrap">
											<h3 class="grid-title">Training CodeIgniter: Breaking The Frame[works]</h3>
										</div><!-- grid-title-wrap -->
									</div><!-- grid-top -->  
								</a>
								<div class="grid-bottom">
									<span class="price">Rp 75,000,- /sesi</span>
									<a href="#"><span class="details">Daftar</span></a>
									<div class="description">
										<div class="icon"><i class="fa fa-calendar-o"></i></div>
										<span class="date"> 08 Mar 2015 | 17.00 - 19.00 WIB <br> dan <a href="#">5 sesi lainnya</a> | Jakarta Selatan</span>
									</div><!-- description -->
									<div class="review">
										<div class="icon"><i class="fa fa-shopping-cart"></i></div>
										<span class="tag">kelas ruangguru</span>
										<div class="rating">
											<span class="rating-info"> <i class="fa fa-star"></i><b>4.5</b> dari <b>10</b> review</span>
										</div>
									</div>
								</div><!-- grid-bottom -->
							</div> <!-- content-grid -->
						</div><!-- col-md-4 col-sm-6 -->
						<div class="col-sm-4 col-sm-offset-4">
							<a href="#" class="main-button text-center">Lihat Kelas Lainnya</a>
						</div>
					</div>
				</div>
			</div>
<?php // */ ?>
		</div><!-- row -->
	</div> <!-- /container -->
<?php
$this->load->view('vendor/general/footer2');