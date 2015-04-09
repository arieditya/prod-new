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
	<style>
		body {
			font-size: 10pt;
			font-family: Trebuchet MS, Tahoma, Verdana, Arial, sans-serif;
		}
		.text16 {
			font-size: 16pt;
		}
		.text14 {
			font-size: 14pt;
		}
		.text12 {
			font-size: 12pt;
		}
		.text10 {
			font-size: 10pt;
		}
		.small-font {
			font-size: 8pt;
		}
		table tr td {
			vertical-align: top;
		}
		table {
			min-width: 100%;
			border-spacing: 0;
		}
		tr.line td {
			border: 0;
			border-bottom-color: #777;
			border-bottom-style: solid;
			border-bottom-width: 1px;
			border-spacing: 0;
			padding: 0;
		}
		.bluebar {
			background-color: #7fffd4;
		}
		.red-font, a {
			color: rgb(192,80,77);
		}
		.red-font {
			font-size: 8pt;
		}
		table#content > tr > td {
			width: 80%;
		}
		table#content > tr:first-child ,
		table#content > tr:last-child {
			width: 10%;
			content: '&nbsp;';
		}
		table.listPrice tr td:nth-child(4) {
			text-align: right;
		}
		.footer { 
			position: fixed; 
			left: 0px; 
			bottom: -20px; 
			right: 0px; 
			height: 2cm; 
			text-align: center;
		}
		.header { 
			position: fixed; 
			left: 0px; 
			top: -20px; 
			right: 0px; 
			height: 50cm; 
		}
	</style>
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
		<li>Nama kelas			: 
			<a href="http://kelas.ruangguru.com/<?php echo $cls['class_uri'];?>">
				<?php echo $cls['class_nama'];?>
			</a>
		</li>
		<li>Penyelenggara		: <?php echo $cls['vendor_name'];?></li>
		<li>Jadwal 				: <?echo $cls['jadwal'];?></li>
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