<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 12/1/14
 * Time: 3:30 PM
 * Proj: private-development
 */
$this->load->view('vendor/general/header2');
?>
<link href="<?php echo base_url();?>/assets/css/payment-transfer.css" type="text/css" rel="stylesheet">
<script type="application/javascript" src="<?php echo base_url();?>assets/js/moment.min.js" ></script>
<script type="application/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js" ></script>
<div class="container content">
	<div class="row">
		<div class="col-md-8">
<?php 
	if($status):
?>
			<div class="message-status true">
				<span><b>Pesan : </b><?php echo $message; ?></span>
			</div>
<?php 
	elseif($status===FALSE):
?>
			<div class="message-status false">
				<span><b>Pesan : </b><?php echo $message; ?></span>
			</div>
<?php 
	endif;
?>
		<div class="panel panel-default">
			<div class="panel-heading heading-label">Konfirmasi Transfer</div>
			<div class="panel-body">
			<p>
				Silahkan isi data berikut untuk konfirmasi pembayaran yang sudah Anda lakukan. Proses konfirmasi akan memakan waktu maksimal 1 hari kerja. Jika konfirmasi Anda telah diverifikasi, Anda akan memperolah email notifikasi dari kami.
			</p>
			<form role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label class="control-label col-md-4">Kode pemesanan</label>
					<div class="col-md-8">
						<input type="text" name="code" class="form-control" required="required" placeholder="Masukan Kode Invoice Anda" value="<?php echo $code;?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4">Rekening Bank Anda</label>
					<div class="col-md-8">
						<select class="form-control" name="transfer_from" id="transfer_from" required="required" >
							<option value="">- PILIH BANK -</option>
<?php 
	foreach($bank_list as $bank):
?>
							<option value="<?php echo $bank->bank_id?>|<?php echo $bank->bank_title?>"><?php echo $bank->bank_title?></option>
<?php 
	endforeach;
?>
							<option value="0">Bank lainnya</option>
						</select>
					</div>
				</div>
				<div class="form-group hidden" id="transfer_from_block">
					<div class="col-md-8 col-md-offset-4">
						<input type="text" class="form-control" name="transfer_from_other" placeholder="Masukan nama bank anda" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4">Rekening Bank Ruangguru</label>
					<div class="col-md-8">
						<select class="form-control" name="transfer_to" required="required" >
							<option value="">- PILIH BANK -</option>
							<option value="1">BANK CENTRAL ASIA Tbk</option>
							<option value="2">BANK MANDIRI Tbk</option>
							<option value="3">BANK NEGARA INDONESIA Tbk</option>
							<option value="4">BANK RAKYAT INDONESIA Tbk</option>
							<option value="18">BANK PERMATA Tbk</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4">Tanggal Transfer</label>
					<div class="col-md-8">
						<input type="text" class="form-control transfer-date" data-date-format="YYYY-MM-DD" name="transfer_date" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4">Upload bukti transfer</label>
					<div class="col-md-8">
						<input type="file" name="bukti_transfer" class="form-control" required="required" />
						<i>(Max. 2MB)</i>
					</div>
				</div>
				<div class="col-md-4 col-md-offset-4">
					<button type="submit" id="btn_kirim" class="btn-orange">
						<i class="fa fa-upload"></i>
						Kirim
					</button>
				</div>
			</form>
			</div> <!-- end panel-body -->
		</div> <!-- end panel -->
		</div> <!-- end col-md-8 -->
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading heading-label text-center">
					<i class="fa fa-question-circle" data-original-title="" title=""></i>
					Butuh Bantuan ?
				</div>
				<div class="panel-body">
					<p>
						Jika anda ada pertanyaan tentang pembayaran, Anda dapat menghubungi kami melalui
					</p>
					<h5 class="support">
						<a href="tel:+622192003040">
							<i class="fa fa-phone-square"></i>021-9200-3040
						</a>
					</h5>
					<h5 class="support">
						<a href="mailto:bayar@ruangguru.com">
							<i class="fa fa-envelope"></i>bayar@ruangguru.com
						</a>
					</h5>
				</div>
			</div>
		</div>
	</div> <!-- end row -->
</div> <!-- end container -->
<script type="application/javascript">
	function addZero(numb) {
		numb = parseInt(numb);
		numb = numb<10?'0'+numb:numb.toString();
		return numb;
	}
	var twoDays = 1000*60*60*24*2;
	var d = new Date();
	
	var yesterday = new Date(d-twoDays)
	var today = {
		'year'	: yesterday.getFullYear(),
		'month'	: addZero(yesterday.getMonth()+1),
		'date'	: addZero(yesterday.getDate()),
		'hour'	: addZero(yesterday.getHours()),
		'minute': addZero(yesterday.getMinutes()),
		'second': addZero(yesterday.getSeconds())
	};
	$('.transfer-date').datetimepicker({
		pickTime		: false,
		minDate			: today.year+'-'+today.month+'-'+today.date,
		showToday		: true
	});
	$('#transfer_from').change(function(){
		if($(this).val() == '0'){
			$('#transfer_from_block').removeClass('hidden');
		} else {
			$('#transfer_from_block').addClass('hidden');
		}
	});
</script>
<?php 
$this->load->view('vendor/general/footer2');