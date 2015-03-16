<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 3/14/15
 * Time: 6:53 PM
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
		<strong>Halo <?php echo $murid_name;?>,</strong>
	</p>

	<p>
		Selamat! Anda telah resmi terdaftar sebagai murid pada kelas berikut:
	</p>

	<ul>
		<li>Nama kelas		: <?php echo $class_name;?></li>
		<li>Penyelenggara	: <?php echo $vendor_name;?></li>
	</ul>

	<p>
		Anda dapat membawa/ menunjukkan tiket terlampir pada saat mengikuti kelas. 
		Anda juga dapat mencatat nomor konfirmasi tiket berikut:
	</p>

	<p><strong>Nomor konfirmasi Anda: <?php echo $ticket_code?></strong></p>

	<p>Selamat belajar dan kami berharap kelas Anda menyenangkan!</p>

	<p>
		Jika Anda memiliki pertanyaan, silakan hubungi Tim Ruangguru melalui email ke <a href="mailto:kelas@ruangguru.com">kelas@ruangguru.com</a> atau
		menelepon ke <a href="tel:+622192003040">021-9200-3040</a> pada saat jam kerja. Terima kasih.
	</p>

	<p>Salam,<br />
		Tim Ruangguru<br />
		<a href="http://fb.me/ruanggurucom">Ruangguru di Facebook</a> | <a href="http://twitter.com/ruangguru">@ruangguru</a>
	</p>

</body>
<!-- Insert JS here -->
</html>