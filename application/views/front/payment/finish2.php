<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 3/18/15
 * Time: 8:24 PM
 * Proj: prod-new
 */
$this->load->view('vendor/general/header2');
switch($transaction_status) {
	case		'capture': 
		$status = 'Menunggu konfirmasi/approval dari bank';
		break;
	case		'settlement': 
		$status = 'Berhasil';
		break;
	default		:
		$status = '...';
		break;
}
?>
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div><h1>STATUS PEMESANAN</h1></div>
		<div>
			<p>ID Transaksi anda: <?php echo $code?></p>
			<p>Kode Status Transaksi anda: <?php echo $trx_code;?></p>
			<p>Status Transaksi anda: <?php echo $status;?></p>
			<hr />
			<p>Apabila pembayaran anda telah dikonfirmasi, anda akan menerima email dari kami mengenai status 
				transaksi anda. Terima kasih.</p>
		</div>
		<div style="height: 120px; content:'&nbsp;'"></div>
	</div>
</div>
<?php $this->load->view('vendor/general/footer2');