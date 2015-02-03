<html>
<head>
<title>Ruangguru : Cara Mudah Cari Guru Privat, Les, dan Kursus</title>
<meta name="description" content="Tempat paling mudah dan murah cari guru les, kursus, dan privat matematika, fisika, bahasa inggris, toefl, ielts di jakarta dan sekitarnya. Siap datang ke rumah lho." />
<link rel="canonical" href="http://www.ruangguru.com" />	   
<script type="text/javascript" src="<?php echo base_url();?>js/home.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/jquery.fancybox.css" media="screen" />
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.tinycarousel.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>css/tinycarousel.css" type="text/css" media="screen"/>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.fancybox-media.js?v=1.0.6"></script>


<script>
	$(document).ready(function()
		{
			$("#slider1").tinycarousel({
				bullets  : true
		});
	});
	
	$(document).ready(function()
		{
			$("#slider2").tinycarousel({
				bullets  : true
		});
	});
    
    	$(document).ready(function()
		{
			$("#slider3").tinycarousel({
				bullets  : true,
				interval : true,
				intervalTime : 8000
		});
	});
	
     $(document).ready(function(){
		/*
		 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
		*/
		$('.fancybox-media')
			.attr('rel', 'media-gallery')
			.fancybox({
			openEffect : 'none',
			closeEffect : 'none',
			prevEffect : 'none',
			nextEffect : 'none',

			arrows : false,
			helpers : {
			media : {},
			buttons : {}
			}
		});
		
        update_matpel_instan();
	   update_provinsi_instan();
	   update_matpel();
        update_provinsi();
    }); 
</script>

<!--  FBX -->
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
  _fbq.push(['addPixelId', '583152025127396']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=583152025127396&amp;ev=NoScript" /></noscript>

<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//v2.zopim.com/?2Rj08dTp3CXV4fff2CoA9ZnZZB916bwh';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>
<!--End of Zopim Live Chat Script-->


</head>
<body>
<div id="content">
<div id="section-slide">
    <div class="blank" style="height:10px;"></div>
    <div id="home-slider">
        <div id="home-slider-wrap">
			<div>
				<img  src="<?php echo base_url(); ?>images/banner-new-homepage.png" alt=""/>
				<div id="definisi-rg" class="text-16"><p>Ruangguru adalah sebuah website yang menghubungkan murid untuk menemukan guru privat yang tepat untuk pelajaran sekolah, kuliah, hobi, ataupun keahlian lainnya.</p></div>
				<!--<img  src="<?php //echo base_url(); ?>images/3.jpg" alt="" class="home-banner"/>-->
			</div>
			<!-- CARI GURU
			<div id="cari-instan-bg"></div>
			<div id="cari-instan">
				<p class="text-cari text-24 white-text">Cari Guru Privat Berkualitas di Kotamu!</p>
				<form action="<?php //echo base_url(); ?>cari_guru/result" method="post">
					<ul id="cari-instan-wrap">
						<li>
						 <div class="cari-field">
                                    <p class="left">Pilih Provinsi</p><?php //$sesi = $this->session->userdata('cari_guru');?>
                                    <select id="provinsi" class="select  text-13" name="provinsi" onchange="update_provinsi_instan()">
								<option value="1" <?php //if($sesi['provinsi'] == 1){ echo 'selected';} else { echo '';}; ?>>DKI Jakarta</option>
                                            <?php //foreach ($this->guru_model->get_provinsi('provinsi')->result() as $row): ?>
								    <?php //if($row->provinsi_id != 1){?>
                                             <option value="<?php //echo $row->provinsi_id; ?>" <?php //if($sesi['provinsi'] == $row->provinsi_id){ echo 'selected';} else { echo '';}; ?>><?php //echo $row->provinsi_title; ?></option>
									<?php //} ?>
                                            <?php //endforeach; ?>
                                    </select>
                               </div>
						 <div class="cari-field">
                                        <p class="left">Pilih Kota</p>
								<input type="hidden" name="sesi_kota" id="kota" value="<?php //echo $sesi['lokasi'];?>"/>
                                        <select id="lokasi" class="select  text-13" name="location">
                                        </select>
                               </div>
						</li>
						<li>
						<div class="cari-field">
                                       <p class="left">Jenjang Pendidikan</p>
									<select id="select-kategori" class="select" name="education" onchange="update_matpel_instan()">
										<?php //foreach ($this->guru_model->get_jenjang()->result() as $row): ?>
										<option class="<?php //echo $row->jenjang_pendidikan_id;?>" value="<?php //echo $row->jenjang_pendidikan_id; ?>" <?php //if ($sesi['jenjang']==$row->jenjang_pendidikan_id){ echo 'selected';} else { echo '';};?>/><?php //echo $row->jenjang_pendidikan_title; ?>
										<?php //endforeach; ?>
									</select>
                                    </div>
							 <div class="cari-field">
                                        <p class="left">Mata Pelajaran</p>
									<input type="hidden" name="sesi_matpel" id="mp" value="<?php //echo $sesi['matpel'];?>"/>
									<select id="select-mp" class="select" name="matpel">
									</select>
                                    </div>
						</li>
					</ul>
					<div id="cari-button"><input type="image" src="<?php //echo base_url(); ?>images/btn-cari-new-o.png"/></div>
				</form>
			</div>
			<div id="play-video">
				<div>
					<span class="white-text" id="text-video">Putar Video</span>
					<a class="fancybox-media" href="http://www.youtube.com/watch?v=CNoD5xEMYfU" rel=nofollow><img src="<?php //echo base_url();?>images/playvideo.png" id="btn-play"/></a>
				</div>
			</div>-->
			<div id="btn-reg-wrap">
				<ul id="group-reg">
					<li><a href="https://ruangguru.com/murid" class="btn-navy-o">Daftar Murid</a></li>
					<li><a href="https://ruangguru.com/guru" class="btn-green-o">Daftar Guru&nbsp;</a></li>
					<li><a href="https://ruangguru.com/duta" class="btn-orange-o">Daftar  Duta&nbsp;</a></li>
				</ul>
			</div>
        </div>
    </div>
</div>
<!--<div id="section-daftar">
	<div id="daftar-wrap">
		<p><span class="text-20 orange">Gabung Bersama Ruangguru Sekarang!</span> &nbsp; <a href="<?php echo base_url()."murid"; ?>" class="btn-navy-o text-14">Daftar Murid</a> &nbsp; <a href="<?php echo base_url();?>guru" class="btn-green-o text-14">Daftar Guru</a> &nbsp; <a href="<?php echo base_url();?>duta" class="btn-orange-o text-14">Daftar Duta</a></p>
	</div>
</div>-->
<div id="section-rgfeature">
		<div id="features-wrap">
			<h1><p class="text-20 bold">Mengapa Memilih Ruangguru?</p></h1>
			<ul id="rg-features">
				<li>
					<img src="<?php echo base_url().'images/matpel.png';?>" />
					<p class="bold">Pilihan guru beragam dan sistem fleksibel</p>
				</li>
				<li>
					<img src="<?php echo base_url().'images/verified.png';?>" />
					<p class="bold">Latar belakang guru bisa diverifikasi</p>
				</li>
				<li>
					<img src="<?php echo base_url().'images/garansi.png';?>" />
					<p class="bold">Garansi uang kembali 100% bila tidak cocok</p>
				</li>
				<li>
					<img src="<?php echo base_url().'images/payment.png';?>" />
					<p class="bold">Bisa bayar dengan kartu kredit, transfer, atau internet</p>
				</li>
			</ul>
		</div>
</div>
<div id="section-daftar-murid">
	<div id="daftar-murid-wrap">
		<div class="title-daftar fleft">
			<p class="bold navy-text"><span class="blue-text text-24"><?php echo $jml_guru;?></span><span> guru berkualitas sudah bergabung bersama Ruangguru</span></p>
			<p>Mulai cari guru pilihanmu sekarang</p>
			<p><a href="<?php echo base_url().'murid'; ?>" class="btn-liteorange">Daftar</a></p>
		</div>
		<div class="cara-daftar">
			<p class="bold">Belajar bersama <a href="<?php echo base_url(); ?>" class="navy-text">Ruangguru.com</a> mudah. Beginilah caranya:</p>
			<div class="feats">
				<p class="numbering white-text">1</p>
				<p class="text-feat"><span class="bold">Cari</span><br/>Cari guru atau kelas sesuai dengan kebutuhanmu. Jika butuh bantuan dalam mencari, gunakan Pesan Guru Instan dan kami akan menghubungimu.</p>
			</div>
			<div class="feats">
				<p class="numbering white-text">3</p>
				<p class="text-feat"><span class="bold">Pesan</span><br/>Pilih dan urutkan guru pilihanmu, serta tentukan durasi dan jadwal belajar. Lalu kirimkan pesananmu ke Ruangguru.</p>
			</div>
			<div class="feats">
				<p class="numbering white-text">2</p>
				<p class="text-feat"><span class="bold">Review</span><br/>Baca dan bandingkan guru-guru pilihanmu. Perhatikan latar belakang, pengalaman, dan ketersediaan jadwal guru.</p>
			</div>
			<div class="feats">
				<p class="numbering white-text">4</p>
				<p class="text-feat"><span class="bold">Belajar</span><br/>Biarkan Ruangguru.com mengurusi masalah pembayaran dan hal administratif lainnya. Kamu tinggal fokus dengan aktivitas belajar!</p>
			</div>
		</div>
	</div>
</div>
<div id="section-cariguru">
	<div id="cariguru-wrap">
	<!-- put the old design here -->
	<div id="cari-guru">
         <div id="cari-guru-header">
                <div id="cari-guru-header-wrap">CARI GURU </div>
           </div>
           <div id="cari-guru-content">
                <form action="<?php echo base_url(); ?>cari_guru/result" method="post">
                     <div class="blank" style="height: 20px;"></div>
                          <div class="cari-guru-left cgl-home">
						 <div class="cari-field">
                                    <p>Pilih Provinsi</p><?php $sesi = $this->session->userdata('cari_guru');?>
                                    <select id="ddProvinsi" class="select  text-13" name="provinsi" onchange="update_provinsi()">
								<option value="0" <?php if($sesi['provinsi'] == 0){ echo 'selected';} else { echo '';}; ?>>Pilih Semua</option>
								<option value="1" <?php if($sesi['provinsi'] == 1){ echo 'selected';} else { echo '';}; ?>>DKI Jakarta</option>
                                            <?php foreach ($this->guru_model->get_provinsi('provinsi')->result() as $row): ?>
								    <?php if($row->provinsi_id != 1){?>
                                             <option value="<?php echo $row->provinsi_id; ?>" <?php if($sesi['provinsi'] == $row->provinsi_id){ echo 'selected';} else { echo '';}; ?>><?php echo $row->provinsi_title; ?></option>
									<?php } ?>
                                            <?php endforeach; ?>
                                    </select>
                               </div>
						 <div class="cari-field">
                                        <p>Pilih Kota</p>
								<input type="hidden" name="sesi_kota" id="sesi_kota" value="<?php echo $sesi['lokasi'];?>"/>
                                        <select id="ddLokasi" class="select  text-13" name="location">
									<option value="0">Pilih Semua</option>
                                        </select>
                               </div>
						 <div class="cari-field">
								<p>Urutkan pencarian berdasarkan</p>
								<select class="select" name="sort">
									<option value="1" <?php if (!empty($input['urutan'])) {echo($input['urutan'] == 1) ? 'selected' : '';} ?>><span class="text-13">Rating</span></option>
									<option value="2" <?php if (!empty($input['urutan'])) {echo($input['urutan'] == 2) ? 'selected' : '';} ?>><span class="text-13">Nama Guru</span></option>
									<option value="3" <?php if (!empty($input['urutan'])) {echo($input['urutan'] == 3) ? 'selected' : '';} ?>><span class="text-13">Harga - rendah ke tinggi</span></option>
									<option value="4" <?php if (!empty($input['urutan'])) {echo($input['urutan'] == 4) ? 'selected' : '';} ?>><span class="text-13">Harga - tinggi ke rendah</span></option>
								</select>
						 </div>
						 <div class="cari-field">
							<p>Tarif per Jam</p>
							<select id="tarifP" class="select  text-13" name="tarif">
								<option value="0" <?php if($sesi['tarif'] == 0){ echo "selected";} else {echo "";}?>>Tarif berapapun</option>
								<option value="1" <?php if($sesi['tarif'] == 1){ echo "selected";} else {echo "";}?>>&lt; Rp 100,000,-</option>
								<option value="2" <?php if($sesi['tarif'] == 2){ echo "selected";} else {echo "";}?>>Rp 101,000,- s/d Rp 250,000,-</option>
								<option value="3" <?php if($sesi['tarif'] == 3){ echo "selected";} else {echo "";}?>>Rp 251,000,- s/d Rp 500,000,-</option>
								<option value="4" <?php if($sesi['tarif'] == 4){ echo "selected";} else {echo "";}?>>&gt; Rp 500,000,-</option>
							</select>
						</div>
                          </div>
                          <div class="cari-guru-right">
						 <div class="cari-field">
							 <p>Pilih Kategori Guru</p>
								 <div class="guru-cat-left">
									<input class="checkbox" name="edu[]" type="checkbox" value="7" <?php if(!empty($sesi['kategori'])){ if(in_array("7",$sesi['kategori'])){ echo "checked";} } ?>/> <span class="text-13">Pelajar SMA</span><br/>
									<input class="checkbox" name="edu[]" type="checkbox" value="1" <?php if(!empty($sesi['kategori'])){ if(in_array("1",$sesi['kategori'])){ echo "checked";} }?>/> <span class="text-13">Mahasiswa S1</span><br/>
									<input class="checkbox" name="edu[]" type="checkbox" value="2" <?php if(!empty($sesi['kategori'])){ if(in_array("2",$sesi['kategori'])){ echo "checked";} }?>/> <span class="text-13">Mahasiswa S2/S3</span><br/>
									<input class="checkbox" name="edu[]" type="checkbox" value="3" <?php if(!empty($sesi['kategori'])){ if(in_array("3",$sesi['kategori'])){ echo "checked";} }?>/> <span class="text-13">Guru Sekolah</span><br/>
								 </div>
								 <div class="guru-cat-right">
									<input class="checkbox" name="edu[]" type="checkbox" value="5" <?php if(!empty($sesi['kategori'])){ if(in_array("5",$sesi['kategori'])){ echo "checked";} }?>/> <span class="text-13">Guru Privat Full Time (> 1 Tahun)</span><br/>
									<input class="checkbox" name="edu[]" type="checkbox" value="6" <?php if(!empty($sesi['kategori'])){ if(in_array("6",$sesi['kategori'])){ echo "checked";} }?>/> <span class="text-13">Guru Privat Part Time</span><br/>
									<input class="checkbox" name="edu[]" type="checkbox" value="4" <?php if(!empty($sesi['kategori'])){ if(in_array("4",$sesi['kategori'])){ echo "checked";} }?>/> <span class="text-13">Dosen</span><br/>
									<input class="checkbox" name="edu[]" type="checkbox" value="8" <?php if(!empty($sesi['kategori'])){ if(in_array("8",$sesi['kategori'])){ echo "checked";} }?>/> <span class="text-13">Profesional</span><br/>
									<input class="checkbox" name="edu[]" type="checkbox" value="9" <?php if(!empty($sesi['kategori'])){ if(in_array("9",$sesi['kategori'])){ echo "checked";} }?>/> <span class="text-13">Lainnya</span><br/>
								 </div>
								 <div class="clear"></div>
						 </div>
						 <div class="cari-field">
								<p>Preferensi Guru</p>
								<div class="blank" style="height: 10px;"></div>
								<table width="260">
								<tr>
									<td class="text-13">1.</td>
									<td><input class="radio" name="gender" type="radio" value="1" <?php if (!empty($input['gender'])) {echo($input['gender'] == 1) ? 'checked' : '';}; ?>/> <span class="text-13">Laki-laki</span></td>
									<td><input class="radio" name="gender" type="radio" value="2" <?php if (!empty($input['gender'])) {echo($input['gender'] == 2) ? 'checked' : '';}; ?>/> <span class="text-13">Perempuan</span></td>
									<td><input class="radio" name="gender" type="radio" value="3" <?php if (!empty($input['gender'])) {echo($input['gender'] == 3) ? 'checked' : '';} else {echo'checked';}; ?>/> <span class="text-13">Bebas</span></td>
								</tr>
								</table>
								<div class="blank" style="height: 10px;"></div>
								<table>
									<tr>
										<td class="text-13">
											2.<input class="radio" name="age" type="radio" value="1" <?php if (!empty($input['umur'])) {echo($input['umur'] == 1) ? 'checked' : '';}; ?>/> <span class="text-13">Di bawah 20 tahun</span><br/>
										</td>
									</tr>
									<tr>
										<td>
											&nbsp;&nbsp;&nbsp;<input class="radio" name="age" type="radio" value="2" <?php if (!empty($input['umur'])) {echo($input['umur'] == 2) ? 'checked' : '';}; ?>/> <span class="text-13">20-30 tahun</span><br/>
										</td>
									</tr>
									<tr>
										<td>
											&nbsp;&nbsp;&nbsp;<input class="radio" name="age" type="radio" value="3" <?php if (!empty($input['umur'])) {echo($input['umur'] == 3) ? 'checked' : '';}; ?>/> <span class="text-13">Di atas 30 tahun</span><br/>
										</td>
									</tr>
									<tr>
										<td>
											&nbsp;&nbsp;&nbsp;<input class="radio" name="age" type="radio" value="4" <?php if (!empty($input['umur'])) {echo($input['umur'] == 4) ? 'checked' : '';} else {echo'checked';}; ?>/> <span class="text-13">Usia Bebas</span>
										</td>
									</tr>
								</table>
					 </div><!-- End of div cari-guru-right -->
					 </div>
					 <div id="cariguru-cat">
							<div class="cari-field">
                                        <p>Jenjang Pendidikan</p>
									<select id="select-jenjang" class="select" name="education" onchange="update_matpel()">
										<option value="0">Pilih Semua</option>
										<?php foreach ($this->guru_model->get_jenjang()->result() as $row): ?>
										<option class="<?php echo $row->jenjang_pendidikan_id;?>" value="<?php echo $row->jenjang_pendidikan_id; ?>" <?php if ($sesi['jenjang']==$row->jenjang_pendidikan_id){ echo 'selected';} else { echo '';};?>/><?php echo $row->jenjang_pendidikan_title; ?>
										<?php endforeach; ?>
									</select>
                                    </div>
							 <div class="cari-field">
                                        <p>Mata Pelajaran</p>
									<input type="hidden" name="sesi_matpel" id="sesi_matpel" value="<?php echo $sesi['matpel'];?>"/>
									<select id="select-matpel" class="select" name="matpel">
									</select>
                                    </div>
							 <div class="cari-field">
								<p>Tampilkan hanya guru bersertifikat?</p>
									<div class="r-guru-detail">
										<input class="radio" name="cert" type="radio" value="1" <?php if (!empty($input['sertifikat'])) {echo($input['sertifikat'] == 1) ? 'checked' : '';}; ?>/> <span class="text-13">Ya</span>
									</div>
									<div class="r-guru-detail">
										<input class="radio" name="cert" type="radio" value="2" <?php if (!empty($input['sertifikat'])) {echo($input['sertifikat'] == 2) ? 'checked' : '';} else {echo'checked';}; ?>/> <span class="text-13">Tidak Perlu Sertifikasi</span>
									</div>
							 </div>
							 <div class="cari-field">
								<p>Metode Belajar</p>
									<div class="r-guru-detail">
										<input class="checkbox" name="met[]" type="checkbox" value="1" checked/> <span class="text-13">Online</span>
									</div>
									<div class="r-guru-detail">
										<input class="checkbox" name="met[]" type="checkbox" value="2" checked/> <span class="text-13">Tatap Muka</span>
									</div>
							 </div>
					 </div>
					 <div class="cari-submit">
							<div id="submit-right"><input type="image" src="<?php echo base_url(); ?>images/btn-cari-new.png"/></div>
					</div>
                     </form>
		</div><!-- end of  cari-guru-content -->
	 </div><!-- end of  cari-guru -->
	</div><!-- end of cariguru-wrap -->
</div><!-- end of section-cariguru -->
<div class="clear"></div>
<div id="section-testi">
	<div id="testi-wrap">
		<h1><p class="text-20 bold orange">Testimoni Murid Ruangguru</p></h1>
		<div id="slider3">
		<a class="buttons prev" href="#">&#60;</a>
		<div class="viewport">		
		<ul class="overview">
			<li><span class="bold">Sesuai dengan budget kita!</span><br/><span class="text-14">Saya bukan hanya dapat guru privat yang berkualitas tapi juga terjangkau dengan budget saya. Akromudin, Murid Bahasa Inggris (Bogor)</span></li>
			<li><span class="bold">Sistemnya simple dan praktis!</span><br/><span class="text-14">Pemesanan secara online memudahkan saya untuk mencari guru yang saya mau. Sistemnya simple dan praktis, hanya habis beberapa menit! Maghza R. R, Murid Matematika (Depok)</span></li>
			<li><span class="bold">Sesuai yang kita mau!</span><br/><span class="text-14">Kalau di tempat les, jadwal sudah ada dan susah sekali nego nya. Tapi di Ruangguru, tinggal cari yang waktunya dan lokasinya cocok. Fitri A., Murid Bahasa Inggris (Jakarta Utara)</span></li>
		</ul>
		</div>
		<a class="buttons next" href="#">&#62;</a>
		</div>
	</div>
</div>
<div class="clear"></div>
<div id="section-payment">
	<div id="payment-wrap">
		<h1><p class="text-20 bold orange">Partner Pembayaran Kami</p></h1>
			<ul class="bullet-payment">
				<li><img src="<?php echo base_url();?>images/logo-visa-round.png"/></li>
				<li><img src="<?php echo base_url();?>images/logo-mastercard-round.png"/></li>
				<li><img src="<?php echo base_url();?>images/logo-mandiri-round.png"/></li>
				<li><img src="<?php echo base_url();?>images/logo-bca-round.png"/></li>
				<li><img src="<?php echo base_url();?>images/logo-bni-round.png"/></li>
				<li><img src="<?php echo base_url();?>images/logo-permata-round.png"/></li>
			</ul>
	</div>
</div>
<!--
<div id="section-lowongan">
	<div id="lowongan-wrap">
		<h3><p class="text-20 center">Lowongan Guru</p></h3>
		<div id="slider2">
			<a class="buttons prev" href="#">&#60;</a>
			<div class="viewport">
			<ul class="overview">
				<?php //foreach($request_guru->result() as $guru):?>
					<li>
						<p class="text-14 bold"><a href="<?php //echo base_url().'main/view_request_guru/'.$guru->request_guru_home_id;?>" class="normal-link"><?php //echo $guru->request_guru_home_title;?></a></p>
						<p class="text-13" style="width:285px;position: relative; left: 10px;"><?php //echo substr($guru->request_guru_home_text, 0, 100)." ... ";?><a href="<?php //echo base_url().'main/view_request_guru/'.$guru->request_guru_home_id;?>" class="normal-link">selengkapnya</a></p>
					</li>
				<?php //endforeach;?>
			</ul>
			</div>
		<a class="buttons next" href="#">&#62;</a>
		</div>
	</div>
</div>
-->
<div id="section-adv">
	<div class="content-ads">
		<p class="text-20 orange">Gabung Menjadi Murid Sekarang! Harga Mulai <b>Rp 50.000</b> &nbsp; <a href="<?php echo base_url()."murid"; ?>" class="btn-liteblue">Daftar</a></p>
	</div>
</div>
<div id="section-req-instan">
<div id="req-instan-wrap">
	<h1><p class="text-20">Pesan Guru Instan</p></h1>
	<p class="text-16">Bingung memilih guru yang mana? Silakan pesan guru Anda <a href="<?php echo base_url();?>request_guru" class="normal-link">di sini</a>. <br/>(Khusus murid yang mencari guru)</p>
	<div id="req-instan">
		<form id="fast_req" name="fast_req" action="<?php echo base_url(); ?>request_guru/request" method="post">
			<div id="req-left">
				<p class="text-14 bold">Nama <input type="text" size="18" id="nama" name="nama" class="validate[required2]"></p>
				<p class="text-14 bold">Email <input type="text" size="18" id="email" name="email" class="validate[required2,custom[email]]"></p>
			</div>
			<div id="req-center">
				<p class="text-14 bold">HP <input type="text" size="18" id="telp" name="telp" class="validate[required2,custom[onlyNumberSp]]"></p>
				<p class="text-14 bold">Mata Pelajaran <input type="text" size="18" id="matpel" name="matpel" class="validate[required2]"></p>
			</div>
			<div id="req-right">
				<p class="text-14 bold">Lokasi <input type="text" size="18" id="lokasi" name="lokasi" class="validate[required2]"></p>
				<p class="text-14 bold">Catatan <input type="text" size="18" id="request" name="request" class="validate[required2]"></p>
				<p class="fright"><a class="btn-liteorange" style="cursor:pointer;" onclick="document.forms['fast_req'].submit(); return false;">Pesan</a></p>
			</div>
	</form>
	</div>
	<div class="clear"></div>
</div>
</div>
<div id="section-video">
      <div id="video-wrap">
		<h1><p class="text-20">Cerita Guru dan Murid</p></h1>
		<div>
			<a class="fancybox-media" href="http://www.youtube.com/watch?v=-nYoDX_tODs" rel=nofollow><img  src="<?php echo base_url(); ?>images/img-murid-dan-guru.png" alt=""/></a>
		</div>
	 </div>
</div>
<div id="section-unggulan">
	<div id="unggulan-wrap">
	<h1><p class="text-20">Guru Unggulan</p></h1>
	<div id="slider1">
	<a class="buttons prev" href="#">&#60;</a>
	<div class="viewport">
		<ul class="overview">
			<?php foreach($guru_unggulan->result() as $guru):?>
				<?php if(!empty($guru->guru_email)):?>
				<li>
					<a href="<?php echo base_url().'guru/view/'.$guru->guru_id;?>">
						<?php if (!file_exists("./images/unggulan/{$guru->guru_id}.png")): ?>
                                    <img src="<?php echo base_url(); ?>images/default_profile_image.png"/>
                               <?php else : ?>
                                    <img src="<?php echo base_url(); ?>images/unggulan/<?php echo $guru->guru_id; ?>.png"/>
                              <?php endif; ?>
					</a>
						<p class="text-13" style="width:285px;position: relative; left: 10px;"><?php echo $guru->prestasi_guru_unggulan;?></p>
				</li>
			     <?php endif;?>
               <?php endforeach;?>
		</ul>
	</div>
	<a class="buttons next" href="#">&#62;</a>
	</div>
	</div>
</div>
<div id="section-liputan">
	<div id="liputan-wrap">
		<p>Seperti diliput di</p>
		<ul id="liputan-list">
			<li><a href="http://www.metrotvnews.com" rel=nofollow><img src="<?php echo base_url();?>images/logo_metrotv_bw.png" width="120px"/></a></li>
			<li><a href="http://www.jawapos.com/" rel=nofollow><img src="<?php echo base_url();?>images/jpos-logo.png" width="120px"/></a></li>
			<li><a href="http://www.techinasia.com/indonesia-jakarta-ruangguru-belva-devara-iman-usman-east-ventures-seed-funding-investment/" rel=nofollow><img src="<?php echo base_url();?>images/techinasia-logo.png" width="150px"/></a></li>
			<li><a href="http://e27.co/indonesias-ruangguru-raises-seed-funding-to-scale-up-services-locally/" rel=nofollow><img src="<?php echo base_url();?>images/e27-logo.png" width="50px"/></a></li>
			<li><a href="http://startupbisnis.com/startup-indonesia-ruangguru-situs-yang-memudahkan-pencarian-guru-privat-bagi-murid-mendapatkan-pendanaan-dari-east-ventures/" rel=nofollow><img src="<?php echo base_url();?>images/logo-startupbisnis.png" width="120px"/></a></li>
			<li><a href="http://www.dailysocial.net/post/marketplace-les-privat-ruangguru-peroleh-investasi-dari-east-ventures" rel=nofollow><img src="<?php echo base_url();?>images/ds-logo.png" width="120px"/></a></li>
			<li><img src="<?php echo base_url();?>images/logo-bloomberg-bw.png"/></li>
			<li><a class="fancybox-media" href="https://www.youtube.com/watch?v=-LyB7PlFQhE" rel=nofollow><img src="<?php echo base_url();?>images/logo-berita-satu-bw.png"/></a></li>
			<li><a href="http://tekno.kompas.com/read/2014/08/21/09593947/Ruangguru.com.Memperoleh.Pendanaan.dari.East.Ventures?utm_source=WP&utm_medium=box&utm_campaign=Ktkwp" rel=nofollow><img src="<?php echo base_url();?>images/logo-kompas.png" width="125px"/></a></li>
		</ul>
	</div>
</div>
<div class="section-white"></div>
</div>
</body>
</html>