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
		if($q->type == 'rate' || $q->type == 'both' ):
?>
	Rate: <select name="answer_rate_value">
		<option>-- Pilih --</option>
		<option value="1">Buruk</option>
		<option value="2">Kurang</option>
		<option value="3">Netral</option>
		<option value="4">Baik</option>
		<option value="5">Perfecto!</option>
	</select>
<?php 
		endif;
		if($q->type == 'text' || $q->type == 'both' ):
?>
	<input type="text" placeholder="Subject / Judul" name="answer_title" style="width: 500px;" /><br />
	<textarea placeholder="Komentar / Tanggapan" name="answer_desc" rows="7" style="width: 500px;" ></textarea><br />
<?php 
		endif;
?>
<?php 
	endforeach;
?>

	</div>
</div>
	
<?
$this->load->view('vendor/general/header2');
