<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 3/13/15
 * Time: 2:20 PM
 * Proj: prod-new
 */
?><!DOCTYPE html>
<html>
<head>
</head>
<!-- Insert Initial/Loader JS here -->
<body>

	<p>
		<img src="http://kelas.ruangguru.com/images/kelas-logo-beta.png" height="30" alt="logo-kelas-ruangguru-beta" />
	</p>

	<p>
		<strong>Halo <?php echo $penyelenggara;?>,</strong>
	</p>

	<p>
		Selamat Datang di <?php krg();?>! Terima kasih karena telah mendaftarkan diri Anda sebagai vendor di situs 
		kami. 
	</p>

	<p>
		<?php krg();?> akan menghubungkan penyelenggara kelas berkelompok (vendor) dengan calon murid. 
		Kelas dapat berupa seminar, kursus, workshop, pelatihan, coaching, aktivitas luar ruangan, dan bentuk kegiatan lainnya - selama bernuansa <em>educational</em>. 
		Calon murid hanya perlu mendaftar dan kemudian melakukan pembayaran, untuk mendapatkan tiket ke kelas yang diinginkan. 
	</p>

	<p>
		Anda terdaftar dengan menggunakan email: <?php echo $email;?>
	</p>

	<p>
		Untuk login profil vendor di: <a href="http://www.ruangguru.com/vendor/login">www.ruangguru.com/vendor/login</a>  <br />
		Untuk merubah password Anda di: <a href="http://www.ruangguru.com/vendor/reset_password">www.ruangguru.com/vendor/reset_password</a>
	</p>

	<p>
		Tips: Saat Anda membuat pengajuan kelas, lengkapi data yang ada selengkap mungkin untuk mempermudah dan mempercepat proses verifikasi oleh tim.
	</p>

	<p>
		Saat ini kami masih mengembangkan <?php krg();?> dalam tahap beta. Sehingga mungkin Anda akan menemui beberapa 
		hal yang masih belum sesuai/ memuaskan. Kami berupaya untuk memberikan pengalaman terbaik bagi Anda. 
		Untuk itu, jika Anda memiliki saran/ masukan untuk pengembangan produk ini, jangan sungkan untuk menyampaikannya kepada kami. 
	</p>

	<p>
		Silakan hubungi Tim Ruangguru melalui email ke <a href="mailto:kelas@ruangguru.com">kelas@ruangguru.com</a> atau
		menelepon ke <a href="tel:+622192003040">021-9200-3040</a> pada saat jam kerja. Terima kasih.
	</p>

	<p>Salam,<br />
		Tim Ruangguru<br />
		<a href="http://fb.me/ruanggurucom">Ruangguru di Facebook</a> | <a href="http://twitter.com/ruangguru">@ruangguru</a>
	</p>
</body>
<!-- Insert JS here -->
</html>