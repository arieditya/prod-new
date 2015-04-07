<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 3/14/15
 * Time: 6:41 PM
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
		Terima kasih telah mendaftarkan diri Anda untuk mengikuti:
	</p>

	<ul>
<?php foreach($class as $cls): ?>
		<li>Nama kelas		: <?php echo $cls['class_nama'];?></li>
		<li>Penyelenggara	: <?php echo $cls['vendor_name'];?></li>
<?php endforeach; ?>
		<li>Biaya pendaftaran	: <?php echo rupiah_format($total_pay);?></li>
	</ul>
	
	<p>
		Untuk dapat mengkonfirmasi partisipasi Anda pada kelas di atas, Anda diharapkan segera melakukan pembayaran 
		paling lambat 1x24 jam setelah email ini dikirim melalui salah satu metode pembayaran berikut:
	</p>

	<ul>
		<li>
			<strong>Kartu Kredit</strong><br />
			Kartu Kredit (Visa & MasterCard) atau Internet Banking (Mandiri ClickPay & CIMB Clicks)
		</li>
		<li>
			<strong>Pembayaran Tunai</strong><br />
			Pembayaran tunai dapat dibayarkan langsung ke kantor Ruangguru.com, <br />
			d/a di Jalan Tebet Raya 32 A Jakarta Selatan (hanya buka pada hari Senin-Jumat, pukul 09.00 - 18.00 WIB)
		</li>
		<li>
			<strong>Bank Transfer</strong><br />
			Semua akun Bank yang dimiliki oleh Ruangguru a/n PT. Ruang Raya Indonesia. <br />
			Anda dapat melakukan transfer pembayaran ke salah satu nomor rekening berikut:
			<ul>
				<li>
					Bank BCA			: 2611-3655-11 
				</li>
				<li>
					Bank Mandiri		: 157-00-0398209-8 
				</li>
				<li>
					Bank BNI			: 033-1469330 
				</li>
				<li>
					Bank BRI			: 2080-01-000124-30-3 
				</li>
				<li>
					Bank Permata		: 411-0463893 
				</li>
			</ul>
		</li>
	</ul>

	<p><strong>JIKA ANDA MELAKUKAN PEMBAYARAN LEWAT BANK TRANSFER,</strong><br />
		Anda dapat melakukan konfirmasi pembayaran dengan salah satu cara di bawah ini:<br />
	</p>

	<ul>
		<li>
			Link konfirmasi pembayaran:<br />
			<a href="http://kelas.ruangguru.com/konfirmasi/<?php echo $code?>">
				http://kelas.ruangguru.com/konfirmasi/<?php echo $code;?>
			</a>
		</li>
		<li>
			Reply email ini dengan melampirkan bukti transfer Anda berupa scan, foto, ataupun screenshot. <br />
			Anda dapat mencantumkan (id murid) yang merupakan nomor identifikasi Anda pada berita transfer untuk mempermudah proses verifikasi pembayaran Anda.
		</li>
		<li>
			Telepon ke <a href="tel:+622192003040">021-9200-3040</a> pada jam kerja
		</li>
	</ul>

	<p>
		Dengan melakukan pembayaran ini, Anda menyepakati <a href="http://ruangguru.com/kebijakan-pembayaran/">syarat 
			dan ketentuan</a> yang berlaku.
	</p>
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