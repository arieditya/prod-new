<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 4/9/15
 * Time: 2:28 PM
 * Proj: prod-new
 */
$this->load->view('vendor/general/header2');
?>
<script src="<?php echo base_url()?>assets/js/jquery.raty-fa.js" type="application/javascript"></script>
<div class="row">
	<div class="col-sm-8 col-sm-offset-2">
	<h1>Feedback</h1>
	<h3>Dari <?php echo $from['name'];?> (<?php echo $from['type'];?>)</h3>
	<h3>Untuk <?php echo $to;?> (<?php echo $type;?>)</h3>
<?php 
	foreach($question as $q):
?>
	<h4><?php echo $q->title?></h4>
	<p><?php echo $q->question?></p>
<?php 
		if($q->type == 'text' || $q->type == 'both' ):
?>
	<input type="text" placeholder="Subject / Judul" name="answer_title" style="width: 500px;" /><br />
	<textarea placeholder="Komentar / Tanggapan" name="answer_desc" rows="7" style="width: 500px;" ></textarea><br />
<?php 
		endif;
		if($q->type == 'rate' || $q->type == 'both' ):
?>
	<div>
		Penilaian: 
		<div class="rates"></div>
	</div>
<?php 
		endif;
?>
<?php 
	endforeach;
?>

	</div>
</div>
<script type="application/javascript">
	$(document).ready(function(){
		$('.rates').raty({'size': 20});
	});
</script>	
<?
$this->load->view('vendor/general/footer2');
