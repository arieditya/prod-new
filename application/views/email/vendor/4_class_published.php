<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 3/14/15
 * Time: 11:11 AM
 * Proj: prod-new
 */?><!DOCTYPE html>
<html>
<head>
	
</head>
<!-- Insert Initial/Loader JS here -->
<body>

	<p>
		<img src="http://kelas.ruangguru.com/images/kelas-logo-beta.png" height="30" alt="logo-kelas-ruangguru-beta" />
	</p>

	<p>
		<strong>Halo <?php echo $penanggung_jawab;?>,</strong>
	</p>

	<p>
		Selamat! Kelas yang Anda ajukan telah sukses melewati proses verifikasi dan approval oleh Tim Ruangguru!
	</p>
	
	<ul>
		<li>Nama kelas		: <?php echo $class_name?></li>
		<li>Penyelenggara	: <?php echo $penyelenggara?></li>
	</ul>

	<p>
		Kelas anda kini dapat diakses di:
		<a href="http://kelas.ruangguru.com/vendor/kelas/detil/<?php echo $class_id;?>">
			http://kelas.ruangguru.com/vendor/kelas/detil/<?php echo $class_id;?>
		</a>
	</p>
	
	<p>
		Anda kini dapat mengelola kelas, memonitor data murid, memantau pembayaran, hingga berkomunikasi dengan murid 
		lewat akun vendor di <a href="<?php echo base_url();?>vendor/login"><?php echo base_url();?>vendor/login</a>
	</p>
	
	<p>
		Anda juga dapat mulai menyebarkan link kelas Anda kepada teman-teman, kerabat, dan calon murid. 
		Kami juga akan membantu untuk mempromosikan kelas Anda melalui emal dan akun social media kami kepada member Ruangguru.
	</p>

	<p>
		Selamat mempersiapkan kelas Anda dan semoga sukses!
	</p>

	<p>
		Jika Anda memiliki pertanyaan, silakan hubungi Tim Ruangguru melalui email ke <a href="mailto:kelas@ruangguru.com">kelas@ruangguru.com</a> 
		atau menelepon ke <a href="tel:+622192003040">021-9200-3040</a> pada saat jam kerja. Terima kasih.
	</p>

	<p>Salam,<br />
		Tim Ruangguru<br />
		<a href="http://fb.me/ruanggurucom">Ruangguru di Facebook</a> | <a href="http://twitter.com/ruangguru">@ruangguru</a>
	</p>

</body>
<!-- Insert JS here -->
</html>