<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 12/22/14
 * Time: 2:53 PM
 * Proj: private-development
 */?><!DOCTYPE html>
<html>
<head>
	<link href="/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" >
	<link href="<?php echo base_url();?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" >
</head>
<!-- Insert Initial/Loader JS here -->
<body>
<?php
//	<img src="<?php echo base_url();? >images/header-logo.x70.png" /><br />
?>
	<h2>INVOICE: <?php echo $code ?></h2>
<?php 
	foreach($data as $class_id => $dt): 
?>
	<table style="padding: 5px;">
		<tr>
			<td style="padding: 5px;vertical-align: top;">
				<p><strong style="color: rgb(225, 0, 101);">Data Pemesan:</strong><br />
					<table>
					<tr>
						<td>Nama</td>
						<td><?php echo $dt['pemohon']['name'] ?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td><?php echo nl2br($dt['pemohon']['address']) ?></td>
					</tr>
					<tr>
						<td>Phone</td>
						<td><?php echo $dt['pemohon']['phone'] ?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><?php echo $dt['pemohon']['email'] ?></td>
					</tr>
					</table>
				</p>
			</td>
			<td style="padding: 10px;vertical-align: top;">
				<p><strong style="color: rgb(225, 0, 101);">Data Murid:</strong><br />
					<table>
					<tr>
						<td>Nama</td>
						<td><?php echo $dt['murid']['name'] ?></td>
					</tr>
					<tr>
						<td>Phone</td>
						<td><?php echo $dt['murid']['phone'] ?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><?php echo $dt['murid']['email'] ?></td>
					</tr>
					</table>
				</p>
			</td>
		</tr>
	</table>
<?php 
		// CLASS
		$peta = explode('||', $dt['kelas']['peta']);
		$ll = $peta[0];
		$img_peta = 'https://maps.googleapis.com/maps/api/staticmap?size=500x500&maptype=roadmap&markers=color:red%7C'.$ll;
		$img_profile = explode('.',$dt['kelas']['image']);
		$ext = 'x30.'.array_pop($img_profile);
		array_push($img_profile, $ext);
		$img_profile = implode('.', $img_profile);
		
?>
	<h3>Rincian Pemesanan</h3>
	<table border="1" style="border-collapse: collapse;">
		<thead>
		<tr>
			<th style="padding: 10px;vertical-align: top;">No</th>
			<th style="padding: 10px;vertical-align: top;">Sesi</th>
			<th style="padding: 10px;vertical-align: top;">Harga</th>
		</tr>
		</thead>
		<tbody>
<?php 
		foreach($dt['kelas']['transaksi'] as $trx):
?>
		<tr>
			<td style="padding: 10px;"><?php echo $trx['jadwal']['tanggal']; ?> ( <?php echo "{$trx['jadwal']['mulai']} s.d {$trx['jadwal']['selesai']}";?> )</td>
			<td style="padding: 10px;"><?php echo $trx['topik']?></td>
			<td style="padding: 10px;"><?php echo rupiah_format($trx['harga']);?>,-</td>
		</tr>
<?php 
		endforeach;
?>
		</tbody>
		<tfoot>
		<tr>
			<td colspan="2">Subtotal</td>
			<td><?php echo rupiah_format($dt['subtotal']);?></td>
		</tr>
		<tr>
			<td colspan="2">Discount</td>
			<td><?php echo rupiah_format($dt['discount']);?></td>
		</tr>
		<tr style="background-color: rgb(62, 196, 229);margin: 0;">
			<td colspan="2"><strong>Total yang harus dibayar</strong></td>
			<td><?php echo rupiah_format($dt['total']);?></td>
		</tr>
		</tfoot>
	</table>
	<p><strong>Anda memiliki waktu 24 jam, hingga tanggal xx jam yy untuk melakukan pembayaran</strong>	</p>
	<p>Jika dalam batas waktu tersebut, anda belum melakukan pembayaran, maka pesanan anda akan dianggap dibatalkan,
		dan anda harus mengulang proses pemesanan dari awal.</p>
	<p>Anda dapat melakukan pembayaran ke salah satu rekening <strong>a/n PT. Ruang Raya Indonesia</strong> dibawah:</p>
		<table>
		<tbody>
			<tr>
				<td>
					<strong>Bank BCA</strong><br />
					No. Rekening: <strong>2611-3655-11</strong>
				</td>
				<td>
					<strong>Bank BRI</strong><br />
					No. Rekening: <strong>2080-01-000124-30-3</strong>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Bank Mandiri</strong><br />
					No. Rekening: <strong>157-00-0398209-8</strong>
				</td>
				<td>
					<strong>Bank Permata</strong><br />
					No. Rekening: <strong>411-0463893</strong>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Bank BNI</strong><br />
					No. Rekening: <strong>033-1469330</strong>
				</td>
				<td></td>
			</tr>
		</tbody>
		</table>
		Setelah melakukan transfer anda dapat melakukan konfirmasi di: <?php echo anchor('payment/transfer/confirm', '','title="Confirm"'); ?> 
		<hr />
		<i class="fa fa-check"></i> Yuu
<?php 
	endforeach;
?>
</body>
<!-- Insert JS here -->
</html>