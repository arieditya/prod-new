<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 11/12/14
 * Time: 3:19 PM
 * Proj: private-development
 */
$this->load->view('general/header-bootstrap');
?>
	<div class="panel panel-default">
		<div class="panel-heading">
<style>
	.breadcrumb.steps>li+li:before {
		font-family: FontAwesome;
		content: "\00a0\0f054\00a0";
	}
</style>
			<ol class="breadcrumb steps">
<?php
	if(empty($step)) $step = 1;
	$steps = array('Pemesanan','Tagihan','Pembayaran','Konfirmasi');
	for($i=0;$i<count($steps);$i++):
		if($i<$step-1) $class = 'fa-circle';
		elseif($i==$step-1) $class = 'fa-circle-o-notch fa-spin';
		else $class = 'fa-circle-o';
?>
				<li class="<?php if($i>$step-1) echo "active"; ?>">
					<?php if($i<$step-1): ?><a href="#"><?php endif;?>
						<span class="fa-stack fa-lg">
							<i class="fa <?php echo $class;?> fa-stack-2x"></i>
							<i class="fa fa-stack-1x <?php echo $i<$step-1?'fa-inverse':''?>"><?php echo $i+1; ?></i>
						</span>
						<span><?php echo $steps[$i];?></span>
					<?php if($i<$step-1): ?></a><?php endif;?>
				</li>
<?php
	endfor;
?>
			</ol>
		</div>
		<div class="panel-body" style="text-align: left;">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-10">
<?php echo $template; ?>
					<p>Untuk melanjutkan transaksi ini, anda wajib untuk membaca dan menyetujui <a href="#">Persyaratan</a> dan <a href="#">Aturan</a> yang telah ditetapkan oleh ruangguru.com<br />
						<input type="checkbox" name="agree" id="iamagree" value="agree" /> <small>Ya, saya telah membaca dan menyetujui Persyaratan dan Aturan <br />yang telah ditetapkan oleh ruangguru.com dan terikat dengannya.</small>
					</p>
					<a href="javascript:window.history.back();">Kembali</a>&nbsp;&nbsp;<button type="button" class="btn btn-info" disabled="disabled" id="proceed">Lanjut</button>
				</div>
			</div>
		</div>
	</div>
<script type="application/javascript">
	$(document).ready(function(){
		$('#iamagree').click(function(){
			if($(this).is(':checked')){
				$('#proceed').removeAttr('disabled');
			} else {
				$('#proceed').attr({'disabled':'disabled'});
			}
		});
	});
</script>
<?php
$this->load->view('general/footer');
