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
							<div class="footer-link"><a href="<?php echo base_url();?>tentang">Tentang Kami</a> | <a href="<?php echo base_url();?>lowongan" class="blue-text bold">Lowongan</a> | <a href="http://ruangguru.tumblr.com" target="_blank" rel=nofollow>Blog</a> | <a href="<?php echo base_url();?>kebijakan_privasi" target="_blank">Kebijakan Privasi</a> | <a href="http://indonesianfutureleaders.org/" target="_blank" rel=nofollow>Mitra</a> | <a href="<?php echo base_url();?>kontak_kami" target="_blank" rel=nofollow>Kontak</a></div>
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
	</div>
<?php endif; ?>
</body>
</html>