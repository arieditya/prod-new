<?php
$this->config->load('catalogue');
$seo = $this->config->item('catalogue_pages');
?>
<!-- FB share -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=636048143136369";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- Tweet share -->
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<div id="footer">
    <div id="footer-wrap">
        <div class="blank" style="height:25px;"></div>
        <div id="footer-content-wrap">
			<ul id="seo-footer">
<?php 
	foreach($seo as $seo_1):
		$seo_title = $seo_1['title'];
?>
				<li>
					<ul>
						<li class="underline"><?php echo $seo_title;?></li>
<?php 
		foreach($seo_1 as $seo_2):
			if(!is_array($seo_2)) continue;
?>
							<li>
<?php 
			$li_title = $seo_2['title'];
			$link = base_url().'cari/';
			foreach($seo_2 as $seo_k => $seo_v):
				if($seo_k === 'title') continue;
				$link .= "{$seo_v}/";
			endforeach;
?>
								<a href="<?php echo $link;?>" class="normal-link"><?php echo $li_title;?></a>
							</li>
<?php
		endforeach;
?>
					</ul>
				</li>
<?php
	endforeach;
	/* * /
?>

					<li>
						<ul>
							<li class="underline">Semua Guru Privat</li>
							<li><a href="<?php echo base_url().'cari/dki-jakarta/jakarta-selatan'?>" class="normal-link">Guru Privat di Jakarta Selatan</a></li>
							<li><a href="<?php echo base_url().'cari/dki-jakarta/jakarta-timur'?>" class="normal-link">Guru Privat di Jakarta Timur</a></li>
							<li><a href="<?php echo base_url().'cari/dki-jakarta/jakarta-pusat'?>" class="normal-link">Guru Privat di Jakarta Pusat</a></li>
							<li><a href="<?php echo base_url().'cari/dki-jakarta/jakarta-barat'?>" class="normal-link">Guru Privat di Jakarta Barat</a></li>
							<li><a href="<?php echo base_url().'cari/dki-jakarta/jakarta-utara'?>" class="normal-link">Guru Privat di Jakarta Utara</a></li>
							<li><a href="<?php echo base_url().'cari/banten/tangerang-selatan'?>" class="normal-link">Guru Privat di Tangerang Selatan</a></li>
							<li><a href="<?php echo base_url().'cari/banten/tangerang'?>" class="normal-link">Guru Privat di Tangerang</a></li>
							<li><a href="<?php echo base_url().'cari/jawa-barat/bekasi'?>" class="normal-link">Guru Privat di Bekasi</a></li>
							<li><a href="<?php echo base_url().'cari/jawa-barat/depok'?>" class="normal-link">Guru Privat di Depok</a></li>
							<li><a href="<?php echo base_url().'cari/jawa-barat/bandung'?>" class="normal-link">Guru Privat di Bandung</a></li>
						</ul>
					</li>
					<li>
						<ul>
							<li class="underline">Bahasa</li>
							<li><a href="<?php echo base_url().'cari/jakarta-selatan/bahasa-inggris'?>" class="normal-link">Guru B. Inggris Jakarta Selatan</a></li>
							<li><a href="<?php echo base_url().'cari/jakarta-timur/bahasa-inggris'?>" class="normal-link">Guru B. Inggris Jakarta Timur</a></li>
							<li><a href="<?php echo base_url().'cari/jakarta-pusat/bahasa-inggris'?>" class="normal-link">Guru B. Inggris Jakarta Pusat</a></li>
							<li><a href="<?php echo base_url().'cari/tangerang-selatan/bahasa-inggris'?>" class="normal-link">Guru B. Inggris Tangerang Selatan</a></li>
							<li><a href="<?php echo base_url().'cari/tangerang/bahasa-inggris'?>" class="normal-link">Guru B. Inggris Tangerang</a></li>
							<li><a href="<?php echo base_url().'cari/dki-jakarta/bahasa-mandarin'?>" class="normal-link">Guru B. Mandarin di Jakarta</a></li>
							<li><a href="<?php echo base_url().'cari/dki-jakarta/bahasa-jerman'?>" class="normal-link">Guru B. Jerman di Jakarta</a></li>
							<li><a href="<?php echo base_url().'cari/dki-jakarta/bahasa-jepang'?>" class="normal-link">Guru B. Jepang di Jakarta</a></li>
							<li><a href="<?php echo base_url().'cari/dki-jakarta/bahasa-spanyol'?>" class="normal-link">Guru B. Spanyol di Jakarta</a></li>
							<li><a href="<?php echo base_url().'cari/dki-jakarta/bahasa-perancis'?>" class="normal-link">Guru B. Perancis di Jakarta</a></li>
							<li><a href="<?php echo base_url().'cari/dki-jakarta/bahasa-arab'?>" class="normal-link">Guru B. Arab di Jakarta</a></li>
						</ul>
					</li>
					<li>
						<ul>
							<li class="underline">Matematika</li>
							<li><a href="<?php echo base_url().'cari/jakarta-selatan/matematika'?>" class="normal-link">Guru Matematika di Jakarta Selatan</a></li>
							<li><a href="<?php echo base_url().'cari/jakarta-timur/matematika'?>" class="normal-link">Guru Matematika di Jakarta Timur</a></li>
							<li><a href="<?php echo base_url().'cari/jakarta-pusat/matematika'?>" class="normal-link">Guru Matematika di Jakarta Pusat</a></li>
							<li><a href="<?php echo base_url().'cari/jakarta-barat/matematika'?>" class="normal-link">Guru Matematika di Jakarta Barat</a></li>
							<li><a href="<?php echo base_url().'cari/jakarta-utara/matematika'?>" class="normal-link">Guru Matematika di Jakarta Utara</a></li>
							<li><a href="<?php echo base_url().'cari/tangerang-selatan/matematika'?>" class="normal-link">Guru Matematika di Tangerang Selatan</a></li>
							<li><a href="<?php echo base_url().'cari/tangerang-matematika'?>" class="normal-link">Guru Matematika di Tangerang</a></li>
							<li><a href="<?php echo base_url().'cari/bekasi/matematika'?>" class="normal-link">Guru Matematika di Bekasi</a></li>
							<li><a href="<?php echo base_url().'cari/depok/matematika'?>" class="normal-link">Guru Matematika di Depok</a></li>
							<li><a href="<?php echo base_url().'cari/bandung/matematika'?>" class="normal-link">Guru Matematika di Bandung</a></li>
						</ul>
					</li>
					<li>
						<ul>
							<li class="underline">Keterampilan</li>
							<li><a href="<?php echo base_url().'cari/dki-jakarta/piano'?>" class="normal-link">Guru Piano di Jakarta</a></li>
							<li><a href="<?php echo base_url().'cari/dki-jakarta/biola'?>" class="normal-link">Guru Biola di Jakarta</a></li>
							<li><a href="<?php echo base_url().'cari/dki-jakarta/gitar'?>" class="normal-link">Guru Gitar di Jakarta</a></li>
							<li><a href="<?php echo base_url().'cari/dki-jakarta/programming'?>" class="normal-link">Guru Pogramming di Jakarta</a></li>
							<li><a href="<?php echo base_url().'cari/dki-jakarta/web-design'?>" class="normal-link">Guru Web Design di Jakarta</a></li>
							<li><a href="<?php echo base_url().'cari/dki-jakarta/photoshop'?>" class="normal-link">Guru Photoshop di Jakarta</a></li>
							<li><a href="<?php echo base_url().'cari/dki-jakarta/renang'?>" class="normal-link">Guru Renang di Jakarta</a></li>
							<li><a href="<?php echo base_url().'cari/dki-jakarta/basket'?>" class="normal-link">Guru Basket di Jakarta</a></li>
							<li><a href="<?php echo base_url().'cari/dki-jakarta/yoga'?>" class="normal-link">Guru Yoga di Jakarta</a></li>
							<li><a href="<?php echo base_url().'cari/dki-jakarta/mengaji'?>" class="normal-link">Guru Mengaji di Jakarta</a></li>
						</ul>
					</li>
					<li>
						<ul>
							<li class="underline">Lainnya</li>
							<li><a href="<?php echo base_url().'cari/toefl'?>" class="normal-link">TOEFL</a></li>
							<li><a href="<?php echo base_url().'cari/ielts'?>" class="normal-link">IELTS</a></li>
							<li><a href="<?php echo base_url().'cari/un-sd'?>" class="normal-link">UN SD</a></li>
							<li><a href="<?php echo base_url().'cari/un-smp'?>" class="normal-link">UN SMP</a></li>
							<li><a href="<?php echo base_url().'cari/un-sma'?>" class="normal-link">UN SMA</a></li>
							<li><a href="<?php echo base_url().'cari/snmptn'?>" class="normal-link">SNMPTN</a></li>
							<li><a href="<?php echo base_url().'cari/simak-ui'?>" class="normal-link">SIMAK UI</a></li>
							<li><a href="<?php echo base_url().'cari/a-level'?>" class="normal-link">A-Level</a></li>
							<li><a href="<?php echo base_url().'cari/bahasa-indonesia-pengantar-asing'?>" class="normal-link">Indonesian for Foreingers</a></li>
						</ul>
					</li>
<?php 
	// */
?>
			</ul>
			<div class="clear"></div>
            <div class="footer-content">
                <div class="footer-contact-header bold orange">
                    <h3><span class="text-16 orange bold">Ruangguru.com</span></h3>
                </div>
                <div class="footer-contact-detail">
                    <p class="text-12">Ruangguru adalah sebuah website yang menghubungkan calon murid untuk menemukan calon guru yang berkualitas</p>
                </div>
            </div>
            <div class="footer-content-right">
                <div class="footer-about-header">
				<div class="footer-link"><a href="<?php echo base_url();?>tentang">Tentang Kami</a> | <a href="<?php echo base_url();?>lowongan" class="blue-text bold">Lowongan</a> | <a href="http://ruangguru.tumblr.com" target="_blank" rel=nofollow>Blog</a> | <a href="<?php echo base_url();?>kebijakan_privasi" target="_blank">Kebijakan Privasi</a> | <a href="<?php echo base_url();?>kontak_kami" target="_blank" rel=nofollow>Kontak</a></div>
                </div>
			 	<form id="subscribe" action="<?php echo base_url().'main/subscribe'?>" name="subscribe" method="post">
					<input type="text" class="text" id="nama" name="nama" placeholder="Nama">
					<input type="text" class="text" id="email" name="email" placeholder="Email">&nbsp;
					<a class="btn-liteblue-mini-o text-12" style="cursor:pointer;" onclick="document.forms['subscribe'].submit(); return false;">Berlangganan</a>
				</form>
            </div>
            <div class="footer-content-bottom">
		      <div class="footer-about-detail">
				<span id="socmed-icon">                    
					<a href="http://www.facebook.com/ruanggurucom" target="_blank" rel=nofollow><img src="<?php echo base_url().'images/socmed/fb-icon.png';?>"/></a>&nbsp;<a href="http://www.twitter.com/ruangguru" target="_blank" rel=nofollow><img src="<?php echo base_url().'images/socmed/twitter-icon.png';?>"/></a>&nbsp;<a href="http://ruangguru.tumblr.com" target="_blank" rel=nofollow><img src="<?php echo base_url().'images/socmed/tumblr-icon.png';?>"/></a>&nbsp;<a href="http://www.instagram.com/ruangguru" target="_blank" rel=nofollow><img src="<?php echo base_url().'images/socmed/insta-icon.png';?>"/></a>
				</span>
			 </div>
                <div class="footer-copyright">
                    <p class="text-12 white-text">&copy; 2014 <a href="<?php echo base_url();?>" class="normal-link">Ruangguru.com</a>. All rights reserved.</p>
                </div>
				<div id="status" style="font-size: 10px;">
					Page load: {elapsed_time}s<br />
					Memory: {memory_usage}
				</div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="blank" style="height:30px;"></div>
    </div>
</div>
</div>
<?php if($this->session->flashdata('enable_overlay')):?>
    <div id="default-overlay"></div>
    <div id="overlayed-content">
    <?php if($this->session->flashdata('request_guru_success')):?>
    <div id="success-notif-request-guru" class="request-notif">
        <div class="request-notif-con">
            <div class="request-notif-header">
                <span>Request Guru Telah Terkirim!</span>
            </div>
            <div class="request-notif-content">
                <div class="_blank" style="height: 20px;"></div>
                <div>
                    <p>Terima kasih atas request Anda!</p>
                    <p>Tim Ruangguru akan mengkonfirmasikan kembali mengenai pilihan preferensi guru yang terpilih dalam waktu maksimal 2x24 jam melalui email/ telepon Anda. Setelah guru yang diinginkan tersedia dan paket belajar disepakati.</p>
                </div>
                <div class="_blank" style="height: 10px;border-bottom: 1px solid #dddddd"></div>
			 <div class="_blank" style="height: 5px;"></div>
                <div class="center">
                    <img src="<?php echo base_url();?>images/tutup-button.png" alt="tutup" onclick="close_overlay()"/>
                </div>
                <div class="_blank" style="height: 5px;"></div>
            </div>
        </div>
    </div>
    <?php endif;?>
    <?php if($this->session->flashdata('request_guru_disc_success')):?>
    <div id="success-notif-request-guru" class="request-notif">
        <div class="request-notif-con">
            <div class="request-notif-header">
                <span>Request Guru Telah Terkirim!</span>
            </div>
            <div class="request-notif-content">
                <div class="_blank" style="height: 20px;"></div>
                <div>
                    <p><b>Selamat! Anda mendapatkan discount sebesar Rp 50.000,-</b></p>
                    <p>Terima kasih atas request Anda. Tim Ruangguru akan mengkonfirmasikan kembali mengenai ketersediaan preferensi guru yang terpilih dalam waktu maksimal 2x24 jam melalui email/ telepon Anda. Setelah guru yang diinginkan tersedia dan paket belajar disepakati</p>
                </div>
                <div class="_blank" style="height: 10px;border-bottom: 1px solid #dddddd"></div>
			 <div class="_blank" style="height: 5px;"></div>
                <div class="center">
                    <img src="<?php echo base_url();?>images/tutup-button.png" alt="tutup" onclick="close_overlay()"/>
                </div>
                <div class="_blank" style="height: 5px;"></div>
            </div>
        </div>
    </div>
    <?php endif;?>
    <?php if($this->session->flashdata('request_guru_by_success')):?>
    <div id="success-notif-request-guru" class="request-notif">
        <div class="request-notif-con">
            <div class="request-notif-header">
                <span>Request Guru Telah Terkirim!</span>
            </div>
            <div class="request-notif-content">
                <div class="_blank" style="height: 20px;"></div>
                <div>
                    <p>Terima kasih atas request Anda!</p>
                    <p>Tim Ruangguru akan mengkonfirmasikan kembali mengenai ketersediaan preferensi guru yang terpilih dalam waktu maksimal 2x24 jam melalui email/ telepon Anda. Setelah guru yang diinginkan tersedia dan paket belajar disepakati</p>
                </div>
                <div class="_blank" style="height: 10px;border-bottom: 1px solid #dddddd"></div>
			 <div class="_blank" style="height: 5px;"></div>
                <div class="center">
                    <img src="<?php echo base_url();?>images/tutup-button.png" alt="tutup" onclick="close_overlay()"/>
                </div>
                <div class="_blank" style="height: 5px;"></div>
            </div>
        </div>
    </div>
    <?php endif;?>
    <?php if($this->session->flashdata('contact_send')):?>
	<div id="success-notif-request-guru" class="request-notif">
        <div class="contact-notif-con">
            <div class="request-notif-header">
                <span>Pesan Anda Telah Terkirim!</span>
            </div>
            <div class="request-notif-content">
                <div class="_blank" style="height: 20px;"></div>
                <div>
                    <p>Terima kasih atas respon Anda!<br/>Tim Ruangguru akan segera merespon email Anda</p>
                </div>
                <div class="_blank" style="height: 20px;border-bottom: 1px solid #dddddd"></div>
                <div class="_blank" style="height: 20px;"></div>
                <div class="center">
                    <img src="<?php echo base_url();?>images/tutup-button.png" alt="tutup" onclick="close_overlay()"/>
                </div>
                <div class="_blank" style="height: 20px;"></div>
            </div>
        </div>
    </div>
    <?php endif;?>
    <?php if($this->session->flashdata('notif_logout')):?>
	<div id="success-notif-request-guru" class="request-notif">
        <div class="logout-notif-con">
            <div class="request-notif-header">
                <span>Perhatian!</span>
            </div>
            <div class="request-notif-content">
                <div class="_blank" style="height: 5px;"></div>
                <div class="center">
                    <p>Akun Anda sedang aktif<br/>Silakan logout terlebih dahulu</p>
                </div>
                <div class="_blank" style="height: 5px;border-bottom: 1px solid #dddddd"></div>
                <div class="_blank" style="height: 5px;"></div>
                <div class="center">
                    <img src="<?php echo base_url();?>images/tutup-button.png" alt="tutup" onclick="close_overlay()"/>
                </div>
			 <div class="_blank" style="height: 5px;"></div>
            </div>
        </div>
    </div>
    <?php endif;?>
    <?php if($this->session->flashdata('subscribe_success')):?>
	<div id="success-notif-request-guru" class="request-notif">
        <div class="logout-notif-con">
            <div class="request-notif-header">
                <span>Ruangguru</span>
            </div>
            <div class="request-notif-content">
                <div class="_blank" style="height: 5px;"></div>
                <div class="center">
                    <p style="width:360px;margin-left:-40px;">Terima kasih Anda telah berlangganan <i>newsletter</i> Ruangguru.</p>
                </div>
                <div class="_blank" style="height: 5px;border-bottom: 1px solid #dddddd"></div>
                <div class="_blank" style="height: 5px;"></div>
                <div class="center">
                    <img src="<?php echo base_url();?>images/tutup-button.png" alt="tutup" onclick="close_overlay()"/>
                </div>
			 <div class="_blank" style="height: 5px;"></div>
            </div>
        </div>
    </div>
    <?php endif;?>
    <?php if($this->session->flashdata('subscribe_fail')):?>
	<div id="success-notif-request-guru" class="request-notif">
        <div class="logout-notif-con">
            <div class="request-notif-header">
                <span>Perhatian</span>
            </div>
            <div class="request-notif-content">
                <div class="_blank" style="height: 5px;"></div>
                <div class="center">
                    <p style="width:360px;margin-left:-40px;">Email Anda sudah terdaftar di <i>database</i> Ruangguru</p>
                </div>
                <div class="_blank" style="height: 5px;border-bottom: 1px solid #dddddd"></div>
                <div class="_blank" style="height: 5px;"></div>
                <div class="center">
                    <img src="<?php echo base_url();?>images/tutup-button.png" alt="tutup" onclick="close_overlay()"/>
                </div>
			 <div class="_blank" style="height: 5px;"></div>
            </div>
        </div>
    </div>
    <?php endif;?>
    <?php if($this->session->flashdata('murid_regsuccess')):?>
	<!-- Facebook Conversion Code for Registrasi Murid -->
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
		})();
	window._fbq = window._fbq || [];
	window._fbq.push(['track', '6016627134696', {'value':'0.00','currency':'USD'}]);
	</script>
	<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6016627134696&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1" /></noscript>
	
	<!-- Google Code for Murid Conversion Page -->
	<script type="text/javascript">
	/* <![CDATA[ */
	var google_conversion_id = 970967279;
	var google_conversion_language = "en";
	var google_conversion_format = "2";
	var google_conversion_color = "ffffff";
	var google_conversion_label = "f12cCOq1ulYQ75H_zgM";
	var google_remarketing_only = false;
	/* ]]> */
	</script>
	<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
	</script>
	<noscript>
		<div style="display:inline;">
			<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/970967279/?label=f12cCOq1ulYQ75H_zgM&amp;guid=ON&amp;script=0"/>
		</div>
	</noscript>
	
	<div id="success-notif-request-guru" class="request-notif">
        <div class="logout-notif-con">
            <div class="request-notif-header">
                <span>Terima Kasih</span>
            </div>
            <div class="request-notif-content">
                <div class="_blank" style="height: 5px;"></div>
                <div class="center">
                    <p style="width:360px;margin-left:-40px;">Terima kasih sudah mendaftar menjadi Murid di Ruangguru. Silahkan logout terlebih dahulu dan login kembali menggunakan email dan password Anda</p>
                    <p style="width:360px;margin-left:-40px;"><i>Share</i>&nbsp;<div class="fb-share-button" data-href="http://www.ruangguru.com/" data-type="button" style="position:relative; top:-3px;"></div>&nbsp;<a href="https://twitter.com/share" class="twitter-share-button" data-text="Saya siap belajar bersama Ruangguru.com!" data-url="http://bit.ly/1nnb1X9" data-related="jasoncosta" data-lang="en" data-size="medium" data-count="none"></a></p>
                </div>
                <div class="_blank" style="height: 5px;border-bottom: 1px solid #dddddd"></div>
                <div class="_blank" style="height: 5px;"></div>
                <div class="center">
                    <img src="<?php echo base_url();?>images/tutup-button.png" alt="tutup" onclick="close_overlay()"/>
                </div>
			 <div class="_blank" style="height: 5px;"></div>
            </div>
        </div>
    </div>
    <?php endif;?>
    <?php if($this->session->flashdata('guru_regsuccess')):?>
	
	<!-- Facebook Conversion Code for Registrasi Guru -->
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
	})();
	window._fbq = window._fbq || [];
	window._fbq.push(['track', '6016627110696', {'value':'0.00','currency':'USD'}]);
	</script>
	<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6016627110696&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1" /></noscript>

	<div id="success-notif-request-guru" class="request-notif">
        <div class="logout-notif-con">
            <div class="request-notif-header">
                <span>Terima Kasih</span>
            </div>
            <div class="request-notif-content">
                <div class="_blank" style="height: 5px;"></div>
                <div class="center">
                    <p style="width:360px;margin-left:-40px;">Terima kasih sudah mendaftar menjadi Guru di Ruangguru. Silahkan logout terlebih dahulu dan login kembali menggunakan email dan password Anda untuk mengubah profil Anda</p>
                    <p style="width:360px;margin-left:-40px;"><i>Share</i>&nbsp;<div class="fb-share-button" data-href="http://www.ruangguru.com/" data-type="button" style="position:relative; top:-3px;"></div>&nbsp;<a href="https://twitter.com/share" class="twitter-share-button" data-text="Jangan lupa pilih saya sebagai guru privat kamu di Ruangguru.com ya. Catat ID Guru saya: <?php echo $this->session->userdata('guru_id'); ?>" data-url="http://bit.ly/1nnb1X9" data-related="jasoncosta" data-lang="en" data-size="medium" data-count="none"></a></p>
                </div>
                <div class="_blank" style="height: 5px;border-bottom: 1px solid #dddddd"></div>
                <div class="_blank" style="height: 5px;"></div>
                <div class="center">
                    <img src="<?php echo base_url();?>images/tutup-button.png" alt="tutup" onclick="close_overlay()"/>
                </div>
			 <div class="_blank" style="height: 5px;"></div>
            </div>
        </div>
    </div>
    <?php endif;?>
    <?php if($this->session->flashdata('duta_regsuccess')):?>
	<div id="success-notif-request-guru" class="request-notif">
        <div class="logout-notif-con">
            <div class="request-notif-header">
                <span>Terima Kasih</span>
            </div>
            <div class="request-notif-content">
                <div class="_blank" style="height: 5px;"></div>
                <div class="center">
                    <p style="width:360px;margin-left:-40px;">Terima kasih sudah mendaftar menjadi Duta di Ruangguru. Silahkan logout terlebih dahulu dan login kembali menggunakan email dan password Anda</p>
                    <p style="width:360px;margin-left:-40px;"><i>Share</i>&nbsp;<div class="fb-share-button" data-href="http://www.ruangguru.com/" data-type="button" style="position:relative; top:-3px;"></div>&nbsp;<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://bit.ly/1nnb1X9" data-text="Bagi yang mau belajar/mengajar di Ruangguru jangan lupa gunakan kode referral saya ya (<?php echo $this->session->userdata('duta_guru_id'); ?>)" data-related="jasoncosta" data-lang="en" data-size="medium" data-count="none"></a></p>
                </div>
                <div class="_blank" style="height: 5px;border-bottom: 1px solid #dddddd"></div>
                <div class="_blank" style="height: 5px;"></div>
                <div class="center">
                    <img src="<?php echo base_url();?>images/tutup-button.png" alt="tutup" onclick="close_overlay()"/>
                </div>
			 <div class="_blank" style="height: 5px;"></div>
            </div>
        </div>
    </div>
    <?php endif;?>
    <?php if($this->session->flashdata('request_regsuccess')):?>
	<div id="success-notif-request-guru" class="request-notif">
        <div class="logout-notif-con">
            <div class="request-notif-header">
                <span>Ruangguru.com</span>
            </div>
            <div class="request-notif-content">
                <div class="_blank" style="height: 5px;"></div>
                <div class="center">
                    <p style="width:360px;margin-left:-40px;">Terima kasih sudah melakukan <i>request</i> di Ruangguru. <i>Request</i> Anda akan segera kami proses.</p>
                </div>
                <div class="_blank" style="height: 5px;border-bottom: 1px solid #dddddd"></div>
                <div class="_blank" style="height: 5px;"></div>
                <div class="center">
                    <img src="<?php echo base_url();?>images/tutup-button.png" alt="tutup" onclick="close_overlay()"/>
                </div>
			 <div class="_blank" style="height: 5px;"></div>
            </div>
        </div>
    </div>
    <?php endif;?>
    <?php if($this->session->flashdata('kelas_success')):?>
	<div id="success-notif-request-guru" class="request-notif">
        <div class="logout-notif-con">
            <div class="request-notif-header">
                <span>Ruangguru.com</span>
            </div>
            <div class="request-notif-content">
                <div class="_blank" style="height: 5px;"></div>
                <div class="center">
                    <p style="width:360px;margin-left:-40px;">Selamat Anda sudah melakukan pemesanan untuk mengikuti kelas di Ruangguru. Data Anda akan segera kami proses untuk dihubungi lagi selanjutnya. Terima kasih.</p>
                </div>
                <div class="_blank" style="height: 5px;border-bottom: 1px solid #dddddd"></div>
                <div class="_blank" style="height: 5px;"></div>
                <div class="center">
                    <img src="<?php echo base_url();?>images/tutup-button.png" alt="tutup" onclick="close_overlay()"/>
                </div>
			 <div class="_blank" style="height: 5px;"></div>
            </div>
        </div>
    </div>
    <?php endif;?>
    <?php if($this->session->flashdata('registrasi_event')):?>
	<div id="success-notif-request-guru" class="request-notif">
        <div class="logout-notif-con">
            <div class="request-notif-header">
                <span>Ruangguru.com</span>
            </div>
            <div class="request-notif-content">
                <div class="_blank" style="height: 5px;"></div>
                <div class="center">
                    <p style="width:360px;margin-left:-40px;">Selamat Anda sudah berhasil mendaftar untuk acara <b>Essential Skills Series Vol. 03</b>. Silahkan cek email Anda.</p>
                </div>
                <div class="_blank" style="height: 5px;border-bottom: 1px solid #dddddd"></div>
                <div class="_blank" style="height: 5px;"></div>
                <div class="center">
                    <img src="<?php echo base_url();?>images/tutup-button.png" alt="tutup" onclick="close_overlay()"/>
                </div>
			 <div class="_blank" style="height: 5px;"></div>
            </div>
        </div>
    </div>
    <?php endif;?>
    </div>
<?php endif; ?>
</body>
</html>