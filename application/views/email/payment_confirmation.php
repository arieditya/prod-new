<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 12/10/14
 * Time: 4:13 PM
 * Proj: private-development
 */
switch($bank_to) {
	case		'1': 
		$to = 'BANK CENTRAL ASIA Tbk';
		break;
	case		'2': 
		$to = 'BANK MANDIRI Tbk';
		break;
	case		'3': 
		$to = 'BANK NEGARA INDONESIA Tbk';
		break;
	case		'4': 
		$to = 'BANK RAKYAT INDONESIA Tbk';
		break;
	case		'18':
		$to = 'BANK PERMATA Tbk';
		break;
}
?><!DOCTYPE html>
<html>
<head>
<style type="text/css" media="screen">
	table thead th, table tbody td {
		padding: 10px;
		width: auto;
		white-space: nowrap;
	}
	table tbody td:nth-child(1),table tbody td:nth-child(3) {
		text-align: center;
	}
	table thead th, table tbody td {
		border: 1px solid #777;
	}
	table {
		border-collapse: collapse;
		width: 100%;
	}
</style>
</head>
<!-- Insert Initial/Loader JS here -->
<body>
	<div class="header">
		<h1>INVOICE ID: <?php echo $code;?></h1>
	</div>
	<div class="body">
		<p>Konfirmasi pembayaran untuk:</p>
		<p>PEMESAN: <?php echo $pemesan->name?> (<?php echo $pemesan->email;?>) - <?php echo $pemesan->phone?></p>
		<p>PESERTA: <?php echo $peserta->name?> (<?php echo $peserta->email;?>) - <?php echo $peserta->phone?></p>
		<p>Bank Pengirim: <?php echo $bank_from ?> - <?php echo $bank_from_other ?></p>
		<p>Bank Ruangguru: <?php echo $bank_to ?> - <?php echo $to ?></p>
		<h3>Rincian transaksi:</h3>
		<table style="">
			<tr>
				<td>SUB TOTAL TRANSAKSI</td>
				<td>:</td>
				<td>Rp. <?php echo number_format($trx->subtotal,0,',','.');?>,-</td>
			</tr>
			<tr>
				<td>DISKON</td>
				<td>:</td>
				<td>Rp. <?php echo number_format($trx->discount,0,',','.');?>,-</td>
			</tr>
			<tr>
				<td colspan="3">================================================</td>
			</tr>
			<tr>
				<td>TOTAL TRANSAKSI</td>
				<td>:</td>
				<td>Rp. <?php echo number_format($trx->total,0,',','.');?>,-</td>
			</tr>
		</table>
		<h3>Bukti Transfer:</h3>
<?php
	if(!empty($img_src) && !empty($img_path)):
?>
			<a href="<?php echo $img_path?>">
				<img src="<?php echo $img_path;?>" />
			</a>
<?php
	else:
?>
			<strong>No file uploaded!</strong>
<?php
	endif;
?>
		<h3>Booking History:</h3>
<pre>
STATUS 1 (USER CHECKOUT) 	: <?php echo $trx->status_1?> 
STATUS 2 (INVOICE SENT)  	: <?php echo $trx->status_2?> 
STATUS 3 (USER CONFIRM)  	: <?php echo $trx->status_3?> 
</pre>
		<h3>Detil Transaksi</h3>
		<table >
			<thead>
			<tr>
				<th colspan="2">Kelas</th>
				<th colspan="4">Jadwal</th>
			</tr>
			<tr>
				<th>ID</th>
				<th>Nama</th>
				<th>ID</th>
				<th>Topik</th>
				<th>Waktu</th>
				<th>Harga per sesi</th>
			</tr>
			</thead>
			<tbody>
<?php 
	foreach($detail as $detil):
?>
			<tr>
				<td><?php echo $detil['kelas']->id;?></td>
				<td><?php echo $detil['kelas']->class_nama;?></td>
				<td><?php echo $detil['sched']->jadwal_id;?></td>
				<td><?php echo $detil['sched']->class_jadwal_topik;?></td>
				<td><?php echo $detil['waktu'];?></td>
				<td>Rp. <?php echo number_format($detil['kelas']->price_per_session,0,',','.');?>,-</td>
			</tr>
<?php 
	endforeach;
?>

			</tbody>
			<tfoot>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			</tfoot>
		</table>
		
	</div>
</body>
<!-- Insert JS here -->
</html>