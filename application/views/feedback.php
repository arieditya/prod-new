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
	<div class="col-sm-8 col-sm-offset-2" style="margin-bottom: 20px;">
		<h1>Feedback</h1>
		<h3>Dari <strong><?php echo $from['name'];?> (<em><?php echo $from['type'];?></em>)</strong></h3>
		<h3>Untuk <strong><?php echo $to;?> (<em><?php echo $type;?></em>)</strong></h3>
		<hr />
		<form action="<?php echo base_url()?>feedback/<?php echo $code ;?>/answer" method="post" enctype="application/x-www-form-urlencoded">
<?php
	foreach($question as $q):

?>
			<input type="hidden" name="question_id[]" value="<?php echo $q->id?>" />
			<input type="hidden" name="type[<?php echo $q->id?>]" value="<?php echo $q->type?>" />
			<h4><?php echo strtoupper($q->title);?></h4>
			<p><?php echo $q->question?></p>
<?php 
		if($q->type == 'text' || $q->type == 'both' ):
?>
			<input type="text" placeholder="Subject / Judul" name="answer_title[<?php echo $q->id;?>]" style="width: 500px;" /><br />
			<textarea placeholder="Komentar / Tanggapan" name="answer_desc[<?php echo $q->id;?>]" rows="7" style="width: 500px;" ></textarea><br />
<?php 
		endif;
		if($q->type == 'rate' || $q->type == 'both' ):
?>
			<div>
				Penilaian: 
				<div class="rates" data-id="<?php echo $q->id; ?>" style="color: #d5df26;"></div>
				<input type="hidden" id="r_<?php echo $q->id ?>" name="answer_rate[<?php echo $q->id ?>]" />
			</div>
<?php 
		endif;
?>
			<hr />
<?php 
	endforeach;
?>
			<button class="btn btn-orange-o" type="submit">Submit</button>
		</form>
	</div>
</div>
<script type="application/javascript">
	$(document).ready(function(){
		$('.rates').raty({
			'size'		: 20,
			'click'		: function(score) {
				var id = $(this).data('id');
				$('#r_'+id).val(score);
			}
		});
	});
</script>
<?php $this->load->view('vendor/general/footer2');