<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 3/24/15
 * Time: 1:23 PM
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
		<strong>Halo <?php echo $vendor['name'];?>,</strong>
	</p>

	<p>
		Kami telah mengkonfirmasi pendaftaran dari:
	</p>
	
	<ul>
		<li>Nama Murid: <?php echo $murid['name']?></li>
		<li>Kelas: <?php echo $class['class_nama']?></li>
	</ul>
	
	<p>
		Detil kontak murid dapat Anda akses melalui link di bawah ini:<br />
		http://{LINK DETIL MURID}
	</p>

	<p>
		Jumlah murid yang terdaftar melalui <?php krg(); ?> untuk kelas Anda saat ini adalah sebanyak: 
		<strong><?php echo $daftar_murid;?> orang.</strong>
	</p>

	<p>Jika Anda memiliki pertanyaan, silakan hubungi Tim Ruangguru melalui email ke 
		<a href="mailto:kelas@ruangguru.com">kelas@ruangguru.com</a> 
		atau menelepon ke <a href="tel:+622192003040">021-9200-3040</a> pada saat jam kerja. Terima kasih.
	</p>

	<p>Salam,<br />
		Tim Ruangguru<br />
		<a href="http://fb.me/ruanggurucom">Ruangguru di Facebook</a> | <a href="http://twitter.com/ruangguru">@ruangguru</a>
	</p>
<!-- Insert JS here -->
</html>