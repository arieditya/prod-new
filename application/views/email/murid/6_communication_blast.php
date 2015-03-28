<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 3/28/15
 * Time: 10:45 AM
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
		Anda telah menerima <strong><?php echo strtoupper($type);?></strong> terkait kelas yang akan Anda ikuti. 
		Berikut detail pengirim:
	</p>

	<ul>
		<li>Nama kelas		: <?php echo $class_nama;?></li>
		<li>Penyelenggara	: <?php echo $vendor_name;?></li>
	</ul>
	
	<p>
		Isi Pesan:
	</p>
	<div style="border: 1px solid black;padding: 5px;">
<p><strong>Subject: <?php echo $subject;?></strong></p>
<?php echo $message; ?>
	</div>

	<p>
		Apabila Anda merasa isi pesan di atas tidak relevan dan/atau mengganggu privasi Anda, 
		laporkan kepada Tim Ruangguru melalui email ke <a href="mailto:kelas@ruangguru.com">kelas@ruangguru.com</a>
		atau menelepon ke <a href="tel:+622192003040">021-9200-3040</a> pada saat jam kerja. Terima kasih.
	</p>

	<p>Salam,<br />
		Tim Ruangguru<br />
		<a href="http://fb.me/ruanggurucom">Ruangguru di Facebook</a> | <a href="http://twitter.com/ruangguru">@ruangguru</a>
	</p>
</body>
<!-- Insert JS here -->
</html>