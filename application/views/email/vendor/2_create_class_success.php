<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 3/13/15
 * Time: 2:28 PM
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
		Terima kasih atas pengajuan kelas yang baru saja Anda lakukan di <?php krg();?>. 
		Berikut ini adalah detail kelas Anda:
	</p>
	<ul>
		<li>Nama kelas		: <?php echo $class_name?></li>
		<li>Penyelenggara	: <?php echo $penyelenggara?></li>
	</ul>

	<p>
		Kami telah menerima pengajuan kelas Anda dan akan melakukan review (maksimal 1 hari kerja) sebelum disetujui 
		untuk ditampilkan di situs <a href="http://kelas.ruangguru.com">kelas.ruangguru.com</a>. 
		Kami akan mengirimkan pemberitahuan mengenai status kelas Anda segera setelah proses verifikasi dilakukan.
	</p>

	<p>
		Jika terdapat hal-hal yang belum jelas atau perlu diklarifikasi saat proses verifikasi, 
		Tim Ruangguru akan menghubungi penyelenggara dan/atau penanggungjawab kelas untuk menanyakan hal-hal terkait. 
		Hal ini kami lakukan untuk menjamin kualitas kelas yang tersedia bagi para calon murid.
	</p>

	<p>Jika Anda memiliki pertanyaan, silakan hubungi Tim Ruangguru melalui email ke 
		<a href="mailto:kelas@ruangguru.com">kelas@ruangguru.com</a> 
		atau menelepon ke <a href="tel:+622192003040">021-9200-3040</a> pada saat jam kerja. Terima kasih.
	</p>

	<p>Salam,<br />
		Tim Ruangguru<br />
		<a href="http://fb.me/ruanggurucom">Ruangguru di Facebook</a> | <a href="http://twitter.com/ruangguru">@ruangguru</a>
	</p>
</body>
<!-- Insert JS here -->
</html>