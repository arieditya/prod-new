<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 12/1/14
 * Time: 3:30 PM
 * Proj: private-development
 */
$this->load->view('general/header-bootstrap');
?>
<<<<<<< .mine
<link href="<?php echo base_url();?>/assets/css/payment-transfer.css" type="text/css" rel="stylesheet">
<div class="main-content">
	<div class="row graybar bottom-30">
		<div class="col-md-8 col-md-offset-2">
			<div class="class-step bold">
				<p><span>1</span> <i>Galeri Kelas</i></p>
				<p><span>2</span> <i>Kelas Pilihan</i></p>
				<p><span>3</span> <em class="pinkfont"><i>Pembayaran</i></em></p>
			</div>
		</div>
	</div>
<script type="application/javascript" src="<?php echo base_url();?>assets/js/moment.min.js" ></script>
<script type="application/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js" ></script>
<div class="row">
	<div class="col-md-8 col-md-offset-2" style="text-align: justify;">
<?php 
	if($status):
?>
		<div class=""><?php echo $message; ?></div>
<?php 
	endif;
?>
		<form role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label><h2 class="pinkfont">Konfirmasi Transfer Pembayaran</h2></label>
				<div class="bigbox">
					<div class="row">
						<div class="col-md-8">
							<p>
								Silahkan isi data berikut untuk konfirmasi pembayaran yang sudah Anda lakukan. Proses konfirmasi akan memakan waktu maksimal 1 hari kerja. Jika konfirmasi Anda telah diverifikasi, Anda akan memperolah email notifikasi dari kami.
							</p>
							<p>
								Jika anda ada pertanyaan, Anda dapat menghubungi kami melalui <a href="mailto:bayar@ruangguru.com" class="pinkfont">bayar@ruangguru.com</a> atau telepon ke <span class="pinkfont">021-9200-3040</span>
							</p>
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
								<label class="control-label col-md-4">Upload bukti transfer<br />(Max. 2MB)</label>
								<div class="col-md-8">
									<input type="file" name="bukti_transfer" class="form-control" />
								</div>
							</div>
							<div class="col-md-4 col-md-offset-4">
								<button type="submit" id="btn_kirim" class="btn-orange" style="color: #333;">Kirim</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
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
$this->load->view('vendor/general/footer');