<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 3/14/15
 * Time: 11:16 AM
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
		Kami ingin mengingatkan bahwa kelas Anda akan berlangsung 3 hari lagi! Kelas anda dapat diakses di:
		<a href="<?php echo base_url()."vendor/kelas/detil/{$class->id}"?>">
			<?php echo base_url()."vendor/kelas/detil/{$class->id}"?>
		</a>
	</p>
	
	<p>
		Jika masih ada slot tiket yang tersedia, ini saatnya bagi Anda untuk meningkatkan promosi 
		dan menjangkau lebih banyak lagi calon murid yang relevan untuk berpartisipasi. 
		Kami juga akan mengingatkan calon murid yang belum membayar, agar segera melakukan transaksi pembayaran.
	</p>
	
	<p>
		Kami berharap Anda sudah siap dan bersemangat untuk bertemu dengan murid-murid Anda! 
		Apabila Anda memiliki pesan atau pengumuman penting yang harus diketahui murid ataupun pemesan, 
		Anda dapat langsung menggunakan fitur ‘Komunikasi’ yang dapat Anda temukan di dalam pilihan menu pada akun vendor Anda. 
	</p>

	<p>
		Untuk login profil vendor di: 
		<a href="<?php echo base_url();?>vendor/login">
			<?php echo base_url();?>vendor/login
		</a>
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