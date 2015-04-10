<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 3/15/15
 * Time: 9:35 PM
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
		Terima kasih atas kepercayaan Anda untuk mengikuti kelas berikut ini bersama <?php krg();?>:
	</p>
	
	<ul>
		<li>Nama kelas		: <?php echo $class_name;?></li>
		<li>Penyelenggara	: <?php echo $vendor_name;?></li>
	</ul>

	<p>
		Tim Ruangguru berharap Anda mendapatkan pengalaman yang menyenangkan bersama dengan murid-murid yang lain
		dan Anda dapat terus menggunakan <?php krg()?> untuk mencari kelas-kelas favorit Anda berikutnya.
	</p>

	<p>
		Untuk meningkatkan kualitas dan mutu kami, kami meminta bantuan Anda untuk meninggalkan pesan dari 
		pengalaman Anda mengikuti kelas bersama <?php krg()?> melalui link di bawah ini:
	</p>
	
	<p><a href="<?php echo $link?>">Feedback link</a></p>
	
	<p>
		Atau Anda juga dapat membalas langsung email ini dengan menuliskan hal-hal yang Anda sukai dari mengikuti kelas 
		lewat <?php krg();?> serta hal-hal yang masih perlu ditingkatkan dari pelayanan kami.
	</p>

	<p>
		Kesan Anda akan sangat membantu kami untuk terus meningkatkan kualitas pelayanan Kelas.Ruangguru.<br />
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