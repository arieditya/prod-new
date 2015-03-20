<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 3/16/15
 * Time: 1:48 AM
 * Proj: prod-new
 */?><!DOCTYPE html>
<html>
<head>
</head>
<!-- Insert Initial/Loader JS here -->
<body>
	<style>
		@page bodyContent {
			size: A4 potrait;
			margin: 70px;
		}
		.page {
			page : bodyContent;
			page-break-inside: avoid;
			page-break-after: always;
		}
		.page:last-child {
			page-break-after: avoid;
		}
		.dontBreak {
/*			page-break-after: always; */
			page-break-inside: avoid;
		}
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
		.redbar {
			background-color: #FFC1BA;
			font-size: 12pt;
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
	<div class="header">
							<img alt="logo-invoice"
								 style="width: 2cm;"
								 src="data:image/png;base64,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"/>
	</div>
	<div class="footer">
		<hr />
		<div class="red-font">
			PT. Ruang Raya Indonesia - Jl. Tebet Raya no. 32A, Tebet Timur, Jakarta Selatan - 021 9200 3040 - 
			info@ruangguru.com
		</div>
	</div>
	<div class="page">
		<div style="text-align: center;left: auto; right: auto;">
			<div class="text16" style="text-decoration: underline;"><strong>INVOICE</strong></div>
			<div><span style="font-size: 10pt;">Kode&nbsp;Pemesanan:&nbsp;<?php echo $code?></span></div>
		</div>

<?php
	if(!empty($method)):
		switch($method){
			case	'vt-mandiri':
				$m = 'Mandiri Clickpay';
				break;
			case	'vt-cimb':
				$m = 'CIMB Clicks';
				break;
			case	'vt-cc':
				$m = 'Credit Card';
				break;
			default:
				$m = NULL;
		}
		if(!empty($m)):
?>
				<h3>Metode Pembayaran : <?php echo $m;?></h3>
<?php
		endif;
	endif;
?>
				<table style="width:100%;">
					<tr>
						<td style="width:50%">
							<p class="text14">DATA PEMESAN</p>
							<table>
								<tr>
									<td>Nama</td>
									<td><?php echo $pemohon['name']?></td>
								</tr>
								<tr>
									<td>Telepon</td>
									<td><?php echo $pemohon['phone']?></td>
								</tr>
								<tr>
									<td>Email</td>
									<td><?php echo $pemohon['email']?></td>
								</tr>
							</table>
						</td>
						<td style="width:50%">
							<p class="text14">DATA MURID</p>
							<table>
								<tr>
									<td>Nama</td>
									<td><?php echo $murid['name']?></td>
								</tr>
								<tr>
									<td>Telepon</td>
									<td><?php echo $murid['phone']?></td>
								</tr>
								<tr>
									<td>Email</td>
									<td><?php echo $murid['email']?></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<p class="text14" style="padding-top: 1cm;">RINCIAN PEMESANAN</p>
				<table style="width:100%;" class="dontBreak listPrice">
					<tr class="bluebar">
						<td style="width: 10%;text-align: center;">No</td>
						<td style="width: 70%">Sesi</td>
						<td style="width: 20%" style="text-align: center;" colspan="2">Harga</td>
					</tr>
<?php
	$i=0;
	foreach($class as $sesi):
?>
					<tr style="" class="line">
						<td style="text-align: center;"><?php echo ++$i;?></td>
						<td>
							<?php echo empty($sesi['topik'])?'':($sesi['topik'].'<br />');?> 
							<span class="small-font"><?php echo $sesi['jadwal']?></span>
						</td>
						<td>Rp.</td>
						<td style="text-align: right">
							<?php echo number_format($sesi['harga'],'0',',','.');?>,-</td>
					</tr>
<?php
	endforeach;
?>
					<tr>
						<td></td>
						<td><span class="blue-font">Subtotal Harga</span></td>
						<td>Rp.</td>
						<td><span class="blue-font">
								<?php echo number_format($subtotal,'0',',','.')?>,-</span></td>
					</tr>
					<tr class="line" style="border-bottom: solid 1px #000000">
						<td></td>
						<td>Potongan Harga</td>
						<td>Rp.</td>
						<td><?php echo number_format($discount,'0',',','.')?>,-</td>
					</tr>
					<tr style="border-bottom: solid 1px #000000" class="redbar line">
						<td colspan="2">Total</td>
						<td>Rp.</td>
						<td><?php echo number_format($total,'0',',','.')?>,-</td>
					</tr>
				</table>
		</div>
	<div class="page">
				<p>&nbsp;</p>
				<p>
					<span style="font-weight: bold;margin-top: 50px;">Anda memiliki waktu 24 jam untuk melakukan 
						pembayaran.</span>
				</p>
				<p>
					Jika dalam batas waktu tersebut Anda belum melakukan pembayaran maka pesanan Anda akan dianggap dibatalkan, 
					dan Anda harus mengulang proses pemesanan dari awal.
				</p>
				<p>
					Anda dapat melakukan pembayaran ke salah satu rekening <span style="font-weight: bold;">a/n PT. Ruang Raya Indonesia</span> di bawah ini:
				</p>
				<table style="width:100%;">
					<tr>
						<td>
							<span style="font-weight: bold;">BANK BCA</span><br />
							No. Rekening: 2611-3655-11
						</td>
						<td>
							<span style="font-weight: bold;">BANK BRI</span><br />
							No. Rekening: 2080-01-000124-30-3
						</td>
					</tr>
					<tr>
						<td>
							<span style="font-weight: bold;">BANK MANDIRI</span><br />
							No. Rekening: 157-00-0398209-8
						</td>
						<td>
							<span style="font-weight: bold;">BANK PERMATA</span><br />
							No. Rekening: 411-0463893
						</td>
					</tr>
					<tr>
						<td>
							<span style="font-weight: bold;">BANK BNI</span><br />
							No. Rekening: 033-1469330
						</td>
						<td>
						</td>
					</tr>
				</table>
				<p>
					Setelah melakukan transfer, Anda dapat melakukan konfirmasi di <br />
					<a href="<?php echo base_url()?>konfirmasi/<?php echo $code?>"><?php echo base_url();?>konfirmasi/<?php echo $code?></a>
				</p>
	</div>
	<div class="page">
		<p>&nbsp;</p>
		<p class="text14"><strong>Kebijakan Pembayaran</strong></p>
		<p class="text14"><strong>Kelas.Ruangguru</strong></p>
		<ol style="list-style-type: upper-alpha; font-weight: bold;" class="text12">
			<li>
				Mekanisme Pembayaran<br />
				<br />
				<span class="text10">Mekanisme Pembayaran Murid</span><br />
				<br />
				<ol style="list-style-type: decimal; font-weight: normal" class="text10">
					<li>
						Pembayaran biaya pemesanan kelas yang terdaftar di Kelas.Ruangguru dilakukan melalui Ruangguru.com. 
						Calon murid diberi waktu hingga <strong>1x24 jam</strong> dari waktu pemesanan. 
						Jika pembayaran tiket tidak dilakukan dalam jangka waktu yang diberikan maka pemesanan 
						dianggap batal.<br />
						<br />
					</li>
					<li>
						Pembayaran untuk semua produk/ jasa yang ditawarkan oleh Ruangguru.com dapat dilakukan 
						melalui:<br />
						<br />
						<ul style="list-style-type: circle;">
							<li>
								<strong>Transfer melalui Bank</strong><br />
								Semua akun Bank yang dimiliki oleh Ruangguru menggunakan nama<br />
								<strong>PT. Ruang Raya Indonesia.</strong><br />
								Anda dapat melakukan transfer pembayaran ke salah satu rekening berikut:<br />
								<br />
								<ul style="list-style-type: square">
									<li>
										Bank BCA No. Rekening: 2611-3655-11
									</li>
									<li>
										Bank Mandiri No. Rekening: 157-00-0398209-8
									</li>
									<li>
										Bank BNI No. Rekening: 033-1469330
									</li>
									<li>
										Bank BRI No. Rekening: 2080-01-000124-30-3
									</li>
									<li>
										Bank Permata No. Rekening: 411-0463893
									</li>
								</ul>
							</li>
							<li>
								<strong>Kartu Kredit (Visa dan Master Card) dan Internet Banking (Mandiri Click Pay 
								dan CIMB Click)</strong><br /><br />
								Akses untuk pembayaran akan diberikan setelah Anda memilih metode pembayaran dengan 
								menggunakan kartu kredit/internet banking saat mendaftar.<br />
								<br />
							</li>
							<li>
								<strong>Pembayaran Tunai</strong><br />
								Pembayaran tunai dapat dibayarkan langsung ke kantor Ruangguru.com, d/a di 
								Jalan Tebet Raya 32 A Jakarta Selatan (hanya buka pada Senin-Jumat, 
								pukul 09.00 - 18.00 WIB)<br />
								<br />
							</li>
						</ul>
					</li>
					<li>
						Murid tidak diperkenankan untuk melakukan pembayaran secara langsung (dalam bentuk apapun) 
						kepada penyelenggara kelas. Jika kemudian diketahui adanya pelanggaran ini, maka baik murid dan 
						penyelenggara kelas akan di-<em>blacklist</em> dari penggunaan jasa Ruangguru.com untuk seluruh 
						produk.<br />
						<br />
					</li>
				</ol>
			</li>
			<div class="page"></div><p>&nbsp;</p>
			<li>
				Kebijakan Penggantian Biaya <em>(Refund Policy)</em><br />
				<br />
				<span class="text10">Mekanisme Penggantian Biaya bagi Murid</span><br />
				<br />
				<ol style="list-style-type: decimal; font-weight: normal" class="text10">
					<li>
						Ruangguru.com memiliki kebijakan <strong>100% money back-guarantee</strong> (garansi uang kembali 100%). Penggantian 
						100% dapat dilakukan jika kelas tidak terlaksana karena pembatalan dilakukan oleh 
						Penyelenggara Kelas.<br />
						<br />
					</li>
					<li>
							Dalam beberapa situasi tertentu (ditentukan oleh penyelenggara kelas), 
						Anda dapat memindahkan hak tiket tersebut kepada orang lain. 
						Dalam kondisi ini, Anda harus menginformasikan perubahan nama pengguna tiket kepada kami. 
						Penggantian nama hanya dapat dilakukan maksimal 1x24 jam sebelum kelas berlangsung dan 
						dilaporkan melalui email <a href="mailto:kelas@ruangguru.com">kelas@ruangguru.com</a><br />
						<br />
					</li>
					<li>
							<em>Refund Policy</em> hanya berlaku jika kelas batal terlaksana karena Penyelengara 
							Kelas. 
							Jika pembatalan kelas dilakukan oleh murid dalam jangka waktu 3x24 jam sebelum kelas berlangsung, 
							maka murid tidak akan mendapatkan penggantian biaya.<br />
						<br />
					</li>
					<li>
							Jika anda batal hadir 3x24 jam sebelum kelas diselengarakan, 
							kami akan mencoba membantu sebisa kami untuk menjual kembali tiket Anda. Namun, 
							tidak ada jaminan bahwa tiket tersebut akan laku terjual. 
							Jika terjual, Anda akan mendapatkan uang anda kembali secara penuh (dipotong dengan biaya transaksi - jika ada). 
							Terkait hal ini anda dapat menghubungi kami melalui refund@ruangguru.com atau telepon 021-9200-3040. 
							Dalam komunikasi, Anda wajib menyampaikan nomor tiket Anda.<br />
						<br />
					</li>
					<li>
						Jika pembatalan kelas diakibatkan oleh force majour, maka kelas akan ditunda pelaksanaannya. 
						Jika murid berhalangan untuk hadir pada waktu yang ditetapkan kemudian, 
						pihak Ruangguru.com akan melakukan penggantian biaya 100%.<br />
						<br />
					</li>
				</ol>
			</li>
		</ol>
	</div>
</body>
<!-- Insert JS here -->
</html>