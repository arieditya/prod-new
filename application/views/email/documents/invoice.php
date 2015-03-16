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
		body {
			font-size: 11pt;
			font-family: Trebuchet MS, Tahoma, Verdana, Arial, sans-serif;
		}
		b, strong {
			font-weight: bold;
		}
		table tr td {
			vertical-align: top;
		}
		table {
			min-width: 100%;
		}
		.text24 {
			font-size: 24pt;
		}
		.text17 {
			font-size: 17pt;
			color: #7fffd4;
		}
		.text12, p {
			font-size: 12pt;
		}
		.redbar {
			background-color: rgb(192,80,77);
			font-size: 17pt;
		}
		.bluebar {
			background-color: #7fffd4;
		}
		.small-font {
			font-size: 9pt;
			color: #7fffd4;
		}
		.blue-font {
			font-size: 12pt;
			color: #7fffd4;
		}
		.red-font, a {
			color: rgb(192,80,77);
		}
		.red-font {
			font-size: 10pt;
		}
		table#content > tr > td {
			width: 80%;
		}
		table#content > tr:first-child ,
		table#content > tr:last-child {
			width: 10%;
			content: '&nbsp;';
		}
	</style>
				<table style="width:100%;">
					<tr>
						<td style="width:50%">&nbsp;
							<img alt="logo-invoice"
								 style="width: 100%;"
								 src="<?php echo base_url()?>assets/images/logo-invoice.gif" />
						</td>
						<td style="width:50%">
							<p style="font-size: 24pt;">INVOICE</p>
							<p style="font-size: 12pt;">Kode Pemesanan: <?php echo $code?></p>
						</td>
					</tr>
				</table>
				<table style="width:100%;">
					<tr>
						<td style="width:50%">
							<p style="font-size: 17pt;">DATA PEMESAN</p>
							<table>
								<tr>
									<td>Nama</td>
									<td><?php echo $pemohon['name']?></td>
								</tr>
								<tr>
									<td>Alamat</td>
									<td><?php echo $pemohon['address']?></td>
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
							<p style="font-size: 17pt;">DATA MURID</p>
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
				<p style="font-size: 17pt;">RINCIAN PEMESAN</p>
				<table style="width:100%;">
					<tr class="bluebar">
						<td style="width: 10%">No</td>
						<td style="width: 60%">Sesi</td>
						<td style="width: 30%">Harga</td>
					</tr>
<?php
	$i=0;
	foreach($class as $sesi):
?>
					<tr style="border-bottom: solid 1px #000000">
						<td><?php echo ++$i;?></td>
						<td>
							<?php echo empty($sesi['topik'])?'':($sesi['topik'].'<br />');?> 
							<span class="small-font"><?php echo $sesi['jadwal']?></span>
						</td>
						<td><?php echo rupiah_format($sesi['harga']);?></td>
					</tr>
<?php
	endforeach;
?>
					<tr>
						<td></td>
						<td><span class="blue-font">SUBTOTAL HARGA</span></td>
						<td><span class="blue-font"><?php echo rupiah_format($subtotal)?></span></td>
					</tr>
					<tr style="border-bottom: solid 1px #000000">
						<td></td>
						<td>POTONGAN HARGA</td>
						<td><?php echo rupiah_format($discount)?></td>
					</tr>
					<tr style="border-bottom: solid 1px #000000" class="redbar">
						<td colspan="2">TOTAL YANG HARUS DIBAYAR</td>
						<td><?php echo rupiah_format($total)?></td>
					</tr>
				</table>
				<p>
					<span style="font-weight: bold;">Anda memiliki waktu 24 jam, hingga tanggal xx jam xx untuk melakukan pembayaran.</span>
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
					<a href="<?php echo base_url()?>konfirmasi"><?php echo base_url()?>konfirmasi</a>
				</p>
				<hr />
				<table style="width:100%;">
					<tr>
						<td class="red-font">Jalan Tebet Raya 32A Jakarta Selatan</td>
						<td class="red-font"><a href="tel:+622192003040">021-9200-3040</a></td>
						<td class="red-font"><a href="mailto:info@ruangguru.com">info@ruangguru.com</a></td>
					</tr>
				</table>
</body>
<!-- Insert JS here -->
</html>