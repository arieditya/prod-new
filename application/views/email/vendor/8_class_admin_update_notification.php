<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 3/14/15
 * Time: 1:05 PM
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
		<strong>Halo <?php echo $penanggungjawab;?>,</strong>
	</p>

	<p>
		Admin Ruangguru telah melakukan pengaturan ulang pada detail kelas yang Anda ajukan di bawah ini:
	</p>
	
	<ul>
		<li>Nama kelas		: <?php echo $class_name?></li>
		<li>Penyelenggara	: <?php echo $penyelenggara?></li>
	</ul>

	<p>
		Berikut adalah alasan dan bentuk pengaturan ulang yang kami lakukan terhadap kelas Anda:
	</p>

	<p>
		<?php echo $reason;?>
	</p>

	<p>
		<?php echo $detail;?>
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