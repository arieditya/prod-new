<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 2/6/15
 * Time: 11:17 AM
 * Proj: prod-new
 */

if ($this->session->flashdata('f_class')): ?>
	<div class="msg msg-ok boxwidth">
		<p><strong><?php echo $this->session->flashdata('f_class'); ?></strong></p>
	</div>
<?php endif; ?>
<!-- Box -->
<script type="application/javascript" src="<?php echo base_url();?>js/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/jquery.fancybox.css" media="screen" />
<script type="application/javascript" src="<?php echo base_url();?>js/jquery.fancybox-media.js?v=1.0.6"></script>
<script type="application/javascript">
	var base_url = "<?php echo base_url()?>";
</script>

<div class="box">
	<!-- Box Head -->
	<div class="box-head">
		<h2 class="left">Class Management</h2>
		<div class="right">
			<form action="<?php echo base_url();?>admin/teacher_driven/class_search" method="post">
				<label>search class by name</label>
				<input type="text" class="field small-field" name="class_name" placeholder="search all words" />
				<input type="submit" class="button" value="search" />
			</form>
		</div>
	</div>
	<!-- End Box Head -->
	<div class="table">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<thead>
			<tr>
				<th>Class ID</th>
				<th>Min Attendance</th>
				<th>Max Attendance</th>
				<th>Register</th>
				<th>Paid</th>
				<th class="center">Action</th>
			</tr>
			</thead>
			<tbody>
<?php
	foreach($class as $c):
?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
<?php
	endforeach;
?>
			</tbody>
		</table>
	</div>
</div>